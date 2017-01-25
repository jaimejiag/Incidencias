<?php
    define('DATABASE', "incidenciasDB");

    define('MYSQL_HOST', "mysql:dbname=".DATABASE.";host=localhost");
    //define('MYSQL_USER', "jaime");
    //define('MYSQL_PASSWORD', "usuario");
    define('MYSQL_USER', "root");
    define('MYSQL_PASSWORD', "123");

    define('TABLE_USER', "user");
    define('TABLE_TIPO', "tipoIncidencia");
    define('TABLE_INCIDENCIA', "incidencia");

    define('USER_ID', "id");
    define('USER_NAME', "username");
    define('USER_PASSWORD', "password");
    define('USER_SUPER', "super");
    define('TIPO_ID', "id");
    define('TIPO_TIPO', "tipo");
    define('INCIDENCIA_ID', "id");
    define('INCIDENCIA_IDUSUARIO', "idUsuario");
    define('INCIDENCIA_IDTIPO', "idTipo");
    define('INCIDENCIA_COMENTARIO', "comentario");
    define('INCIDENCIA_FECHA', "fecha");


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


        function executeSelect($sql) {
            $result = $this->conn->query($sql);

            if (!$result) {
                $this->error = "Error en la consulta de datos";
            }

            return $result;
        }
        

        function getIncidencias() {
            $sql = "SELECT * FROM ".TABLE_INCIDENCIA;
            $statement = $this->conn->query($sql);
            
            if (!$statement) {
                $this->error = "Error en la consulta de datos";
                $result = $statement;
            } else
                $result = $statement->fetchAll();

            return $result;
        }


        function getUsername($id) {
            $sql = "SELECT ".USER_NAME." FROM ".TABLE_USER." WHERE id=$id";
            $statement = $this->conn->query($sql);
            $result = $statement->fetch();

            return $result;
        }


        function getUserId($name) {
            $sql = "SELECT ".USER_ID." FROM ".TABLE_USER." WHERE username='$name'";
            echo $sql;
            $statement = $this->conn->query($sql);
            $result =$statement->fetch();

            return $result;
        }


        function getTipoIncidencia($id) {
            $sql = "SELECT ".TIPO_TIPO." FROM ".TABLE_TIPO." WHERE id=$id";
            $statement = $this->conn->query($sql);
            $result = $statement->fetch();

            return $result;
        }


        function getAllTipoIncidencia() {
            $sql = "SELECT * FROM ".TABLE_TIPO;
            $statement = $this->conn->query($sql);
            $result = $statement->fetchAll();

            return $result;
        }


        function insertIncidencia($usuario, $tipo, $comentario, $fecha) {
            $sql = "INSERT INTO ".TABLE_INCIDENCIA." (".INCIDENCIA_IDUSUARIO.",".INCIDENCIA_IDTIPO.",".INCIDENCIA_COMENTARIO.
            ",".INCIDENCIA_FECHA.") VALUES (:idUsuario, :idTipo, :comentario, :fecha)";

            $statement = $this->conn->prepare($sql);
            $statement->bindParam(":idUsuario", $usuario);
            $statement->bindParam(":idTipo", $tipo);
            $statement->bindParam(":comentario", $comentario);
            $statement->bindParam(":fecha", $fecha);

            return $statement->execute();
        }
    }
?>