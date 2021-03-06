<?php
trait PersistentProperties
{
    /**
     * @var string Name of the autologin cookie
     */
    protected $cookie = 'cookie_name';

    /**
    * @var string Name of database table that stores user credentials
    */
    protected $table_users = 'table_users';

    /**
     * @var string Default table where session data is stored
     */
    protected $table_sess = 'sessions';

    /**
     * @var string Name of database table that stores autologin details
     */
    protected $table_autologin = 'autologin';

    /**
     * @var string Default column for session ID
     */
    protected $col_sid = 'sid';

    /**
     * @var string Default column for expiry timestamp
     */
    protected $col_expiry = 'expiry';

    /**
     * @var string Name of table column that stores the user's username
     */
    protected $col_name = 'email';

    /**
     * @var string Default column for session data
     */
    protected $col_data = 'data';

    /**
     * @var string Name of table column that stores the user key
     */
    protected $col_ukey = 'id';

    protected $col_akey = 'user_key';

    /**
     * @var string Name of table column that stores 32-character single-use tokens
     */
    protected $col_token = 'token';

    /**
     * @var string Name of table column that stores when the record was created as a MySQL timestamp
     */
    protected $col_created = 'created_at';

    /**
     * @var string Name of table column that stores a Boolean recording whether the token has been used
     */
    protected $col_used = 'used';

    /**
     * @var string Session variable that persists data
     */
    protected $sess_persist = 'remember';

    /**
     * @var string Session variable that stores the username
     */
    protected $sess_uname = 'user';

    /**
     * @var string Session name that indicates user has been authenticated
     */
    protected $sess_auth = 'authenticated';

    /**
     * @var string Session name that indicates user has been revalidated
     */
    protected $sess_revalid = 'revalidated';

    /**
     * @var string Session variable that stores the user key
     */
    protected $sess_ukey ='user_key';

}
