<?php

class PDOSessionHandler implements \SessionHandlerInterface
{
  protected $db;
  protected $useTransactions;
  protected $expiry;
  protected $table_sess = 'sessions';
  protected $col_sid = 'sid';
  protected $col_expiry = 'expiry';
  protected $col_data = 'data';
  protected $unlockStatements = [];
  protected $collectGarbage = false;

  public function __construct(\PDO $db, $useTransactions = true)
  {

    $this->db = $db;
    $this->cookie = App::get('config')['auth']['session']['name'];
    $this->table_users = App::get('config')['auth']['model'];
    $this->col_akey = App::get('config')['auth']['session']['key'];
    $this->sess_uname =  App::get('config')['auth']['session']['user'];
    $this->sess_ukey = App::get('config')['auth']['session']['key'];
    if ($this->db->getAttribute(\PDO::ATTR_ERRMODE) !== \PDO::ERRMODE_EXCEPTION) {
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    $this->useTransactions = $useTransactions;
    $this->expiry = time() + (int) ini_get('session.gc_maxlifetime');
  }

  public function open($save_path, $name)
  {
    return true;
  }

  public function read($session_id)
  {
    try {
        if ($this->useTransactions) {
            // MySQL's default isolation, REPEATABLE READ, causes deadlock for different sessions.
            $this->db->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
            $this->db->beginTransaction();
        } else {
            $this->unlockStatements[] = $this->getLock($session_id);
        }
        $sql = "SELECT $this->col_expiry, $this->col_data
                FROM $this->table_sess WHERE $this->col_sid = :sid";
        // When using a transaction, SELECT FOR UPDATE is necessary
        // to avoid deadlock of connection that starts reading
        // before we write.
        if ($this->useTransactions) {
            $sql .= ' FOR UPDATE';
        }
        $selectStmt = $this->db->prepare($sql);
        $selectStmt->bindParam(':sid', $session_id);
        $selectStmt->execute();
        $results = $selectStmt->fetch(\PDO::FETCH_ASSOC);
        if ($results) {
            if ($results[$this->col_expiry] < time()) {
                // Return an empty string if data out of date
                return '';
            }
            return $results[$this->col_data];
        }
        // We'll get this far only if there are no results, which means
        // the session hasn't yet been registered in the database.
        if ($this->useTransactions) {
            $this->initializeRecord($selectStmt);
        }
        // Return an empty string if transactions aren't being used
        // and the session hasn't yet been registered in the database.
        return '';
    } catch (\PDOException $e) {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
        throw $e;
    }
  }

  public function write($session_id, $data)
  {
    try {
      $sql = "INSERT INTO $this->table_sess ($this->col_sid,
              $this->col_expiry, $this->col_data)
              VALUES (:sid, :expiry, :data)
              ON DUPLICATE KEY UPDATE
              $this->col_expiry = :expiry,
              $this->col_data = :data";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':expiry', $this->expiry, \PDO::PARAM_INT);
      $stmt->bindParam(':data', $data);
      $stmt->bindParam(':sid', $session_id);
      $stmt->execute();
      return true;
    } catch (\PDOException $e) {
        if ($this->db->inTransaction()) {
            $this->db->rollback();
        }
        throw $e;
    }
  }

  public function close()
  {
    if ($this->db->inTransaction()) {
        $this->db->commit();
    } elseif ($this->unlockStatements) {
        while ($unlockStmt = array_shift($this->unlockStatements)) {
            $unlockStmt->execute();
        }
    }
    if ($this->collectGarbage) {
        $sql = "DELETE FROM $this->table_sess WHERE $this->col_expiry < :time";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':time', time(), \PDO::PARAM_INT);
        $stmt->execute();
        $this->collectGarbage = false;
    }
    return true;
  }


  public function destroy($session_id)
  {
    $sql = "DELETE FROM $this->table_sess WHERE $this->col_sid = :sid";
    try {
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':sid', $session_id);
        $stmt->execute();
    } catch (\PDOException $e) {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
        throw $e;
    }
    return true;
  }

  public function gc($maxlifetime)
  {
      $this->collectGarbage = true;
      return true;
  }

  protected function getLock($session_id)
  {
      $stmt = $this->db->prepare('SELECT GET_LOCK(:key, 50)');
      $stmt->bindValue(':key', $session_id);
      $stmt->execute();

      $releaseStmt = $this->db->prepare('DO RELEASE_LOCK(:key)');
      $releaseStmt->bindValue(':key', $session_id);

      return $releaseStmt;
  }

  protected function initializeRecord(\PDOStatement $selectStmt)
  {
      try {
          $sql = "INSERT INTO $this->table_sess ($this->col_sid, $this->col_expiry, $this->col_data)
                  VALUES (:sid, :expiry, :data)";
          $insertStmt = $this->db->prepare($sql);
          $insertStmt->bindParam(':sid', $session_id);
          $insertStmt->bindParam(':expiry', $this->expiry, \PDO::PARAM_INT);
          $insertStmt->bindValue(':data', '');
          $insertStmt->execute();
          return '';
      } catch (\PDOException $e) {
          // Catch duplicate key error if the session has already been created.
          if (0 === strpos($e->getCode(), '23')) {
              // Retrieve existing session data written by the current connection.
              $selectStmt->execute();
              $results = $selectStmt->fetch(\PDO::FETCH_ASSOC);
              if ($results) {
                  return $results[$this->col_data];
              }
              return '';
          }
          // Roll back transaction if the error was caused by something else.
          if ($this->db->inTransaction()) {
              $this->db->rollback();
          }
          throw $e;
      }
  }

}

 ?>
