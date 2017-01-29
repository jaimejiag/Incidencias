<?php
    include('dao.php');

    class App {
	    protected $dao;
    
	    function __construct() {
		    $this->dao = new Dao();
	    }

        function head($title = "", $h1 = "") {
            echo "
	   	    <!DOCTYPE html>
	   	    <html lang='es'>
  	   	        <head>
    	            <meta charset='utf-8' />
		            <title>$titulo</title>
    		        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    		        <link rel='stylesheet' type='text/css' href='../css/style.css' />
					<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  	    	    </head>

  		        <body style='overflow: auto;'>
    		        <header>
				        <h1>$h1</h1>
                    </header>";
        }

        function navIncidencias() {
            echo "
    			    <nav>
    			        <ul>
    				        <li><a href='searchIncidencias.php'>Buscar incidencia</a></li>
							<li><a href='addIncidencia.php'>Dar de alta una incidencia</a></li>
                            <li><a href='logout.php'>Desconectar</a></li>
    			        </ul>
    			    </nav>
    			    <div id='content'>";
        }


		function navAdd() {
            echo "
    			    <nav>
    			        <ul>
							<li><a href='incidencias.php'>Volver</a></li>
                            <li><a href='logout.php'>Desconectar</a></li>
    			        </ul>
    			    </nav>
    			<div id='content'>";
        }


		function navSuper() {
            echo "
    			    <nav>
    			        <ul>
							<li><a href='searchIncidencias.php'>Buscar incidencia</a></li>
							<li><a href='addIncidencia.php'>Dar de alta una incidencia</a></li>
							<li><a href='users.php'>Ver usuarios</a></li>
							<li><a href='addUser.php'>Dar de alta un usuario</a></li>
                            <li><a href='logout.php'>Desconectar</a></li>
    			        </ul>
    			    </nav>
    			<div id='content'>";
        }


        function footer() {
            echo 
				    "</div>
				    <footer>
    				    <p>Página realizada por: Jaime Jiménez Agudo</p>
   				    </footer>
  			    </body>
		    </html>";
        }


        function showErrorConnection() {
		    echo "<p>".$this->$dao->error."</p>";
	    }


		function init_session($user) {
			if (!isset($_SESSION['user']))
				$_SESSION['user'] = $user;
		}


		function getDao() {
			return $this->dao;
		}


		function start_session() {
			session_start();

			if (!$this->isLogged())
				header("Location:login.php");
		}


		function isLogged(){
			if (!isset($_SESSION['user']) && !isset($_SESSION['password']))
				return false;

			return true;
		}


		function destroy_session() {
			if (!isset($_SESSION['user']))
				unset($_SESSION['user']);
		
			session_destroy();
			header("Location:../index.php");
		}
    }
?>