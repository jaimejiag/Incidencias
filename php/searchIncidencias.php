<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Buscar", "");
    $app->navAdd();
    date_default_timezone_set("UTC");

    echo "
    <form class='main' method='POST' action=".$_SERVER['PHP_SELF'].">
        <input class='main' type='text' name='fecha' placeholder='Fecha' required='required' />
        <button type='submit' class='btn btn-primary btn-block btn-larg'>Buscar</button>
    </form>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fecha = $_POST["fecha"];
        $incidencias = $app->getDao()->getIncidenciasFecha($fecha);

        if (!$incidencias) {
            echo "<p>Error al obtener las incidencias. Las fechas deben de tener el siguiente formato: AAAA-MM-DD</p>";
        } else if (count($incidencias) == 0) {
            echo "<p>No hay incidencias en la fecha seleccionada</p>";
        } else {
            foreach ($incidencias as $row) {
                $username = $app->getDao()->getUsername($row[1]);
                $tipoIncidencia = $app->getDao()->getTipoIncidencia($row[2]);

                echo "
                <div class='bs-callout bs-callout-primary'>
                    <h4>$tipoIncidencia[0]</h4>
                    <p>($username[0] - $row[4])</p>
                    $row[3]<br><br>
                </div>";
            }
        }
    }

    $app->footer();
?>