<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Eliminar", "");
    $app->navAdd();

    if (!empty($_GET['editId']))
        $_SESSION["idIncidencia"] = $_GET["editId"];

    $editId = $_SESSION["idIncidencia"];
    $result = $app->getDao()->deleteIncidencia($editId);

    echo "<script language='javascript'>window.location.href='incidencias.php'</script>";

    $app->footer();
?>