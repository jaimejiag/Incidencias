<?php
    define('DATABASE', "incidenciasDB");

    define('MYSQL_HOST', "mysql:dbname=".DATABASE.";host=localhost");
    define('MYSQL_USER', "jaime");
    define('MYSQL_PASSWORD', "usuario");

    define('TABLE_USER', "user");

    define('USER_NAME', "username");
    define('USER_PASSWORD', "password");

    class Dao {
        protected $conn;
        public $error;

        function __construct() {
            try {
                $this->conn = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
            } catch (PDPException $e) {
                $this->error = "Error en la conexión: ".$e->getMessage();
                $this->conn = null;
            }
        }

        function __destruct() {
            if ($this->isConnected()) {
                $this->conn = null;
            }
        }

        function isConnected() {
            return ($this->conn == null ? false : true);
        }
        
        function checkUser($username, $password) {
            $sql = "SELECT * FROM ".TABLE_USER." WHERE username='$username' AND password=sha1('$password')";
            echo $sql;
            $statement = $this->conn->query($sql);
            
            if ($statement->rowCount() < 1) {
              return false;
            } else
                return true;
        }
    }
?>