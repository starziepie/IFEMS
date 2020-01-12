<?php 
    require '../mysql.php';
    require 'auth.php';
    require 'header.php';
?>
<div class="container" style="margin: 8px;">
    <h2>Slot Search</h2>
    <?php
        if ($_GET["action"] == 'bookslot') {
            //
            if (!isset($_GET["slotid"])) {
                echo '<p class="text-danger">Error: Slot ID is required</p>';
                echo file_get_contents('../footer.html');
                die();
            }
            $que = 'UPDATE slots SET booked=1, pilot='.$pilotdata["id"].' WHERE id='.$_GET["slotid"].';';
            $ret1 = runQ($que);
            if ($ret1 != TRUE) {
                echo '<p class="text-danger">Booking Error: SQL Query Failed - '.$ret1.'</p>';
                echo file_get_contents('../footer.html');
                die();
            } else {
                $name = getConfig()["name"];
                echo "<p class=\"text-success\">Signup Successful! On behalf of the {$name} Team, thank you for coming!</p>";
            }
        } else {
            $ret = selectMultiple('SELECT * FROM slots WHERE booked=0;');
            if ($ret === FALSE) {
                echo '<p class="text-danger">Error: No Slots Found</p>';
                echo file_get_contents('../footer.html');
                die();
            }
            echo '<table class="table-striped" width="100%"><thead><tr><th>Gate</th><th>Slot</th><th>Book Slot</th></tr></thead><tbody id="tablebody">';
            while ($item = $ret->fetch_assoc()) {
                echo '<tr><td>'.$item["gate"].'</td><td>'.$item["slottime"].'</td><td><a class="btn btn-primary" href="?action=bookslot&slotid='.$item["id"].'">Book Slot</a></td></tr>';
            }
        }
    ?>
    </tbody></table>
</div>
<?php echo file_get_contents('../footer.html'); ?>