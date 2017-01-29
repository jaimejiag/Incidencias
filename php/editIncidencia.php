<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Editar", "");
    $app->navAdd();

    if (!empty($_GET['editId']))
        $_SESSION["idEdit"] = $_GET["editId"];

    $editId = $_SESSION["idEdit"];

    echo "
    <form method='POST' action=".$_SERVER['PHP_SELF'].">
        <select name='tipoIncidencia'>";
    
    $incidencia = $app->getDao()->getincidencia($editId);
    $tiposIncidencia = $app->getDao()->getAllTipoIncidencia();

    foreach ($tiposIncidencia as $row) {
        if ($row[0] == $incidencia[2])
            echo "<option selected value=".$row[0].">".$row[1]."</option>";
        else
            echo "<option value=".$row[0].">".$row[1]."</option>";
    }

    echo "
        </select>
        <textarea id='content' placeholder='Describa la incidencia' name='comentario'>$incidencia[3]</textarea>
        <button type='submit' class='btn btn-primary btn-block btn-larg'>Actualizar Incidencia</button>
    </form>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        date_default_timezone_set("UTC");
        $tipo = $_POST['tipoIncidencia'];
        $comentario = $_POST['comentario'];
        $result = $app->getDao()->updateIncidencia($editId, $tipo, $comentario);

        if (!$result)
            echo "<p>Ha ocurrido un error al añadir la incidencia. El comentario no puede ser mayor de 255 carácteres</p>";
        else
            echo "<script language='javascript'>window.location.href='incidencias.php'</script>";
    }

    $app->footer();
?>