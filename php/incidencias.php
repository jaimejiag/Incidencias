<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Incidencias", "");
    $app->nav();

    $incidencias = $app->getDao()->getIncidencias();

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
          $row[3]<br><br>
          <a href='#'><i class='material-icons' style='font-size:36px'>visibility</i></a>
          <a href='#'><i class='material-icons' style='font-size:36px'>mode_edit</i></a>
        </div>";
      }
  }
?>