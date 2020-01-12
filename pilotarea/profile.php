<?php 
    require '../mysql.php';
    require 'auth.php';
    require 'header.php';
?>
<div style="margin: 8px;">
<h2>Profile</h2>
<b>IFC Username:</b> <?php echo $pilotdata["ifcname"]; ?><br />
<b>Email:</b> <?php echo $pilotdata["email"]; ?><br />
<?php if($pilotdata["admin"] == '1'){echo '<button class="btn btn-primary" onclick="window.location.href=\'../admin\'" style="cursor: pointer;">Admin Area</button>&nbsp;&nbsp;'; } ?>
<button class="btn btn-primary" onclick="window.location.href='editprofile.php'" style="cursor: pointer;">Edit Profile</button>
</div>
<?php echo file_get_contents('../footer.html'); ?>