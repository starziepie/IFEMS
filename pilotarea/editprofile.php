<?php 
    require '../mysql.php';
    require 'auth.php';
    require 'header.php';
?>
<div style="margin: 8px;">
<h2>Edit Profile</h2>
<?php 
    if ($_GET["action"] == 'edit') {
        $query = 'UPDATE pilots SET email="'.$_POST["email"].'", ifcname="'.$_POST["fname"].'" WHERE id="'.$pilotdata["id"].'";';
        $ret = runQ($query);
        if ($ret == TRUE) {
            echo '<p class="text-success">Your profile has been updated.</p>';
            $pilotdata = getPilotData($_SESSION["pilotid"]);
        } else {
            echo '<p class="text-danger">Error Editing Profile: SQL Query Failed - '.$ret.'</p>';
        }
    }
?>
<form action="editprofile.php?action=edit" method="post">
    <input required style="width: 40%;" type="email" class="form-control" placeholder="Email" value="<?php echo $pilotdata['email']; ?>" name="email">
    <input required style="width: 40%;" type="text" class="form-control" placeholder="IFC Name" value="<?php echo $pilotdata['ifcname']; ?>" name="ifcname">
    <input type="submit" class="btn btn-primary" value="Update Profile">
</form>
</div>
<?php echo file_get_contents('../footer.html'); ?>