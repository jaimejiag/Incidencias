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
  	    	    </head>

  		        <body>
    		        <header>
				        <h1>$h1</h1>
                    </header>";
        }

        function nav() {
            echo "
    			    <nav>
    			        <ul>
    				        <li><a href='#'>Buscar incidencia</a></li>
							<li><a href='#'>Dar de alta una incidencia</a></li>
                            <li><a href='#'>Desconectar</a></li>
    			        </ul>
    			    </nav>";
    			    //<div id='content'>";
        }

        function footer() {
            echo 
				    //</div>
				    "<footer>
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
    }
?>