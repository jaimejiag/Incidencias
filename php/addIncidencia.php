<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Añadir", "");
    $app->nav();

    echo "
    <form>
        <input  type='text' id='title' placeholder='type Title'>
        <input type='text' id='desc' placeholder='type Description'>
        <textarea id='content' placeholder='type Content'></textarea>
        <input type='text' id='mobile' placeholder='type Mobile Number'>
        <input type='text' id='address' placeholder='type Address'>
    </form>";
?>