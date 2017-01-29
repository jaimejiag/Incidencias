<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Eliminar", "");
    $app->navAdd();

    if (!empty($_GET['editId']))
        $_SESSION["idUser"] = $_GET["editId"];

    $editId = $_SESSION["idUser"];
    $result = $app->getDao()->deleteUser($editId);

    echo "<script language='javascript'>window.location.href='users.php'</script>";

    $app->footer();
?>