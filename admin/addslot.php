<?php require 'header.php' ?>

<h4>Add Slot</h4>

<?php 
    if (isset($_GET["action"]) && $_GET["action"] == 'add') {
        $query = 'INSERT INTO slots (arr, aircraft, airline, dep_slot) VALUES ("'.$_POST["arr"].'", "'.$_POST["aircraft"].'", "'.$_POST["airline"].'", "'.$_POST["dep_slot"].'");';
        $ret = runQ($query);
        if ($ret === TRUE) {
            echo '<p class="text-success">Success!</p><script>window.location.href="manageslots.php"</script>';
        } else {
            echo '<p class="text-danger">Unable to Add Slot. SQL Error: '.$ret.'</p>';
        }
    }
?>

<form action="addslot.php?action=add" method="post">
<input required class="form-control" type="text" placeholder="Arrival ICAO" name="arr">
<input required class="form-control" type="text" placeholder="Aircraft" name="aircraft">
<input required class="form-control" type="text" placeholder="Airline" name="airline">
<input required class="form-control" type="text" placeholder="Departure Slot" name="dep_slot">
<input type="submit" class="btn btn-primary" value="Add Slot">
</form>

<?php require 'footer.php' ?>