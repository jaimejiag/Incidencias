<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Añadir", "Añadir");
    $app->nav();

    echo "
    <form method='POST' action=".$_SERVER['PHP_SELF'].">
        <select name='tipoIncidencia'>";
    $tiposIncidencia = $app->getDao()->getAllTipoIncidencia();

    foreach ($tiposIncidencia as $row)
        echo "<option value=".$row[0].">".$row[1]."</option>";

    echo "
        </select>
        <textarea id='content' placeholder='Describa la incidencia' name='comentario'></textarea>
        <button type='submit' class='btn btn-primary btn-block btn-larg'>Añadir Incidencia</button>
    </form>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tipo = $_POST['tipoIncidencia'];
        $comentario = $_POST['comentario'];
        $idUser = $_SESSION["userId"];
        $fecha = date('Y-m-d');
        
        $result = $app->getDao()->insertIncidencia($idUser, $tipo, $comentario, $fecha);

        if (!$result)
            echo "<p>Ha ocurrido un error al añadir la incidencia</p>";
        else
            echo "<script language='javascript'>window.location.href='incidencias.php'</script>";
    }

    $app->footer();
?>