<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Incidencias", "");

	$super = $_SESSION["userSuper"];
    if ($super != 1)
		$app->navIncidencias();
	else
		$app->navSuper();
    
	date_default_timezone_set("UTC");

    $incidencias = $app->getDao()->getIncidenciasFecha(date("Y-m-d"));

    if (!$incidencias) {
      	echo "<p>".$app->getDao()->error."</p>";
    } else if (count($incidencias) == 0) {
      	echo "<p>No hay productos</p>";
    } else {
      	foreach ($incidencias as $row) {
        	$username = $app->getDao()->getUsername($row[1]);
        	$tipoIncidencia = $app->getDao()->getTipoIncidencia($row[2]);

        	echo "
        	<div class='bs-callout bs-callout-primary'>
          		<h4>$tipoIncidencia[0]</h4>
          		<p>($username[0] - $row[4])</p>
          		$row[3]<br><br>";

			if ($super == 1) {
        		echo "
					<a href='editIncidencia.php?editId=$row[0]'><i class='material-icons' style='font-size:36px'>mode_edit</i></a>
					<a href='deleteIncidencia.php?editId=$row[0]'><i class='material-icons' style='font-size:36px'>delete</i></a>
        		</div>";
			} else if ($row[1] == $_SESSION["userId"]) {
        		echo "
					<a href='editIncidencia.php?editId=$row[0]'><i class='material-icons' style='font-size:36px'>mode_edit</i></a>
        		</div>";
			} else {
				echo "</div>";
			}
    	}
	}

	$app->footer();
?>