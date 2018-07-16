<?php

class QueryBuilder
{
  protected $pdo;
  protected $table;
  protected $wildcard = '';

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function errorCheck($data)
  {
    $errors = [];
    foreach ($data as $key => $value) {
        if (strlen($value) < 1)
          $errors[] = $key;
    }
    if (count($errors) > 0) {
      printf('Error: Field(s) %s cannot be blank',
        implode(', ', $errors)
      );
      die();
    }
  }

  public function all()
  {
    $query = $this->pdo->prepare("SELECT * FROM $this->table");
    $query->execute();

    return $query->fetchAll(PDO::FETCH_CLASS);
  }


  public function select($table)
  {
    $this->table = $table;
    return $this;
  }

  public function count()
  {
    $query = $this->pdo->prepare("SELECT COUNT(*) FROM $this->table");
    $query->execute();

    return $query->fetchColumn();
  }

  public function where($field, $is, $value)
  {
    $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE $field $is '$value' $this->wildcard");
    $query->execute();
    $this->wildcard = '';

    return $query->fetchAll(PDO::FETCH_CLASS);
  }

  public function migrate($table, $data)
  {
    if ($this->contains($table)) {
      echo "Table $table already exists!<br />";
      return false;
    }
    $columns = '';
    $len = count($data);
    foreach ($data as $field => $type) {
      $columns .= "$field $type";
      if (--$len !== 0) $columns.=', ';
    }
    $query = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS $table ($columns)");
    $query->execute();
    echo "Table $table created!<br />";
  }

  public function getPage($start, $count)
  {
    $query = $this->pdo->prepare("SELECT * FROM $this->table $this->wildcard LIMIT $start, $count");
    $query->execute();
    $this->wildcard = '';

    return $query->fetchAll(PDO::FETCH_CLASS);
  }

  public function orderBy($column, $direction = 'DESC')
  {
    $this->wildcard .= "ORDER BY $column $direction";
    return $this;
  }

  public function insert($object)
  {

    $data = $object->fillable;

    $statement  = sprintf(
      'INSERT INTO %s(%s) VALUES(:%s)',
      $this->table,
      implode(', ', array_keys($data)),
      implode(array_keys($data), ', :')
    );

    $this->attempt($statement, $data);
  }

  public function update($object)
  {
    $data = $object->fillable;

    $statement = "UPDATE $this->table SET ";
    foreach ($data as $key => $value) {
      $value = addslashes($value);
      $statement.= "$key= '$value', ";
    }

    $statement = substr($statement, 0, strlen($statement) -2);

    $this->attempt(
      $statement." WHERE id = '$object->id'",
      $data
    );
  }

  public function destroy($id)
  {
    $statement  = sprintf(
      'DELETE FROM %s WHERE id = %s',
      $this->table, "'" . $id . "'"
    );

    $this->attempt($statement);
  }

  public function destroy_where($col, $compare, $value)
  {
    $statement  = sprintf(
      'DELETE FROM %s WHERE %s %s %s',
      $this->table, $col, $compare, "'$value'"
    );
    $this->attempt($statement);

    return $this;
  }

  private function attempt($statement, $data = [])
  {
    $query = $this->pdo->prepare($statement);

    try {
      $query->execute($data);
    } catch (PDOException $e) {
       die($e->getMessage());
    }
  }

  public function contains($table)
  {
    $query = $this->pdo->prepare("SHOW TABLES LIKE '$table'");
    $query->execute();
    return count($query->fetchAll(PDO::FETCH_COLUMN)) > 0;
  }

}
