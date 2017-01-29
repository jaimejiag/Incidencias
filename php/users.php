<?php
    include_once('app.php');
    global $app;

    $app = new App();
    $app->start_session();
    $app->head("Usuarios", "");
	$app->navAdd();
	date_default_timezone_set("UTC");

    $users = $app->getDao()->getAllUsers();

    if (!$users) {
      	echo "<p>".$app->getDao()->error."</p>";
    } else if (count($users) <= 1) {
      	echo "<p>No hay usuarios</p>";
    } else {
      	foreach ($users as $row) {
            if($row[3] != 1) {
        	    echo "
        	    <div class='bs-callout bs-callout-primary'>
          		    <h4>$row[1]</h4>
                    <a href='editUser.php?editId=$row[0]'><i class='material-icons' style='font-size:36px'>mode_edit</i></a>
		  			<a href='deleteUser.php'><i class='material-icons' style='font-size:36px'>delete</i></a>
        		</div>";
            }
    	}
	}

    $app->footer();
?>