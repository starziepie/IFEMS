<?php require 'header.php' ?>

<h4>Add Slot</h4>

<?php 
    if (isset($_GET["action"]) && $_GET["action"] == 'add') {
        $query = 'INSERT INTO slots (gate, slottime) VALUES ("'.$_POST["gate"].'", "'.$_POST["slottime"].'");';
        $ret = runQ($query);
        if ($ret === TRUE) {
            echo '<p class="text-success">Success!</p><script>window.location.href="manageslots.php"</script>';
        } else {
            echo '<p class="text-danger">Unable to Add Slot. SQL Error: '.$ret.'</p>';
        }
    }
?>

<form action="addslot.php?action=add" method="post">
<input required class="form-control" type="text" placeholder="Gate Name" name="gate">
<input required class="form-control" type="text" placeholder="Slot Time" name="slottime">
<input type="submit" class="btn btn-primary" value="Add Slot">
</form>

<?php require 'footer.php' ?>