<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Incidencias", "");
    $app->nav();

    echo "<div class='bs-callout bs-callout-primary'>
  <h4>Primary Callout</h4>
  This is a primary callout.
</div>";

    echo "<div class='bs-callout bs-callout-primary'>
  <h4>Primary Callout</h4>
  This is a primary callout.
</div>";

    echo "<div class='bs-callout bs-callout-primary'>
  <h4>Primary Callout</h4>
  This is a primary callout.
</div>";
?>