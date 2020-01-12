<?php 
    require '../mysql.php';
    require 'auth.php';
    require 'header.php';
?>
<div class="jumbotron text-center"><h2>Welcome to the Pilot Area <?php echo $pilotdata["ifcname"]; ?></h2><p>Select an option to get started.</p></div>
<?php echo file_get_contents('../footer.html'); ?>