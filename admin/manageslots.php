<?php require 'header.php'; ?>
    <h4 class="text-center">Manage Slots</h4>
    <a href="addslot.php" class="btn btn-primary">Add Slot</a>
    <?php
        if (isset($_GET["action"]) && $_GET["action"] == 'delete' && isset($_GET["id"])) {
            $ret = runQ('DELETE FROM slots WHERE id='.$_GET["id"].';');
            if ($ret === TRUE) {
                echo '<p class="text-success">Success.</p>';
            } else {
                echo '<p class="text-danger">SQL Error: '.$ret.'</p>';
            }
        }
    ?>
    <table class="table table-striped">
    <?php
        $allslots = selectMultiple('SELECT * FROM slots');
        if ($allslots === FALSE) {
            echo '<p>There are no slots.</p>';
            die();
        }
        echo '<thead><tr><th>Gate</th><th>Slot Time</th><th>Booking</th><th>Action</th></tr></thead><tbody>';
        while ($row = $allslots->fetch_assoc()) {
            if ($row["booked"] == 0) {
                $booking = 'None';
            } else {
                $pilotbooked = getPilotData($row["pilot"]);
                $booking = $pilotbooked["ifcname"];
            }
            echo '<tr><td>'.$row["gate"].'</td><td>'.$row["slottime"].'</td><td>'.$booking.'</td><td><a href="?action=delete&id='.$row["id"].'" class="btn btn-danger">Delete Slot</a></tr>';
        }
    ?>
    </tbody></table>
<?php require 'footer.php'; ?>