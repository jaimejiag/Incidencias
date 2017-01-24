<?php
    include_once('app.php');
    session_start();
    global $app;
    $app = new App();

    $app->head("Inicio de sesión", " ");

    echo "
    <div class='login'>
	    <h1>Login</h1>
        <form class='main' method='POST' action=".$_SERVER['PHP_SELF'].">
    	    <input class='main' type='text' name='user' placeholder='Nombre usuario' required='required' />
            <input class='main' type='password' name='password' placeholder='Contraseña' required='required' />
            <button type='submit' class='btn btn-primary btn-block btn-larg'>Entrar</button>
        </form>
    </div>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['user'];
        $password = $_POST['password'];

        if (empty($user)) {
            echo "Debe introducir un nombre";
        } else if (empty($password)) {
            echo "Debe introducir una contraseña";
        } else {
            if (!$app->getDao()->isConnected())
			    $app->showErrorConnection();
            else {
                if ($app->getDao()->checkUser($user, $password)){
                    $app->init_session($user);
                    echo "<script language='javascript'>window.location.href='incidencias.php'</script>";
                } else 
                    echo "<p>Credenciales no exiten</p>";
            }
        }
    }

    $app->footer();
?>