<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Añadir", "");
    $app->navAdd();

    echo "
    <div class='login'>
        <form class='main' method='POST' action=".$_SERVER['PHP_SELF'].">
    	    <input class='main' type='text' name='user' placeholder='Nombre usuario' required='required' />
            <input class='main' type='password' name='password' placeholder='Contraseña' required='required' />
            <button type='submit' class='btn btn-primary btn-block btn-larg'>Crear Usuario</button>
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
            $result = $app->getDao()->insertUser($user, $password);

            if (!$result)
                echo "<p>Ha ocurrido un error al añadir al usuario</p>";
            else
                echo "<script language='javascript'>window.location.href='users.php'</script>";
        }
    }

    $app->footer();
?>