<?php 
    require '../mysql.php';
    require 'auth.php';
    require 'header.php';
?>
<div class="container" style="margin: 8px;">
    <h2>Slot Search</h2>
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#arr">Search by Arrival</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#airline">Search by Airline</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#all">View All Slots</a>
    </li>
    </ul>
    <div class="tab-content">
    <div class="tab-pane container active" id="arr">
        <form action="slotsearch.php" method="get">
            <input hidden name="action" value="search">
            <input hidden name="searchby" value="arr">
            <b>Arrival</b>
            <input type="text" class="form-control" name="arrairport" placeholder="ICAO">
            <input type="submit" class="btn btn-primary" value="Search">
        </form>
    </div>
    <div class="tab-pane container fade" id="airline">
        <form action="slotsearch.php" method="get">
            <input hidden name="action" value="search">
            <input hidden name="searchby" value="airline">
            <b>Airline</b><br />
            <input type="text" class="form-control" name="airline" placeholder="Airline Name">
            <input type="submit" class="btn btn-primary" value="Search">
        </form>
    </div>
    <div class="tab-pane container fade" id="all">
        <a style="margin-top 8px;" href="slotsearch.php" class="btn btn-primary">View All Slots</a>
    </div>
    </div>
    <hr />
    <?php
        if ($_GET["action"] == 'search' && isset($_GET["searchby"])) {
            if ($_GET["searchby"] == 'dep') {
                $ret = selectMultiple('SELECT * FROM slots WHERE booked=0 AND dep="'.$_GET["depairport"].'";');
                if ($ret === FALSE) {
                    echo '<p class="text-danger">Error: No Slots Found</p>';
                    echo file_get_contents('../footer.html');
                    die();
                }
                echo '<table class="table-striped" width="100%"><thead><tr><th>Arrival</th><th>Airline</th><th>Aircraft</th><th>Slot</th><th>Book Slot</th></tr></thead><tbody id="tablebody">';
                while ($item = $ret->fetch_assoc()) {
                    
                    echo '<tr><td>'.$item["arr"].'</td><td>'.$item["airline"].'</td><td>'.$item["aircraft"].'</td><td>'.$item["dep_slot"].'</td><td><a href="?action=bookslot&slotid='.$item["id"].'" class="btn btn-primary">Book Slot</a></td></tr>';
                }
            } elseif ($_GET["searchby"] == 'arr') {
                $ret = selectMultiple('SELECT * FROM slots WHERE booked=0 AND arr="'.$_GET["arrairport"].'";');
                if ($ret === FALSE) {
                    echo '<p class="text-danger">Error: No Slots Found</p>';
                    echo file_get_contents('../footer.html');
                    die();
                }
                echo '<table class="table-striped" width="100%"><thead><tr><th>Arrival</th><th>Airline</th><th>Aircraft</th><th>Slot</th><th>Book Slot</th></tr></thead><tbody id="tablebody">';
                while ($item = $ret->fetch_assoc()) {
                    echo '<tr><td>'.$item["arr"].'</td><td>'.$item["airline"].'</td><td>'.$item["aircraft"].'</td><td>'.$item["dep_slot"].'</td><td><a href="?action=bookslot&slotid='.$item["id"].'" class="btn btn-primary">Book Slot</a></td></tr>';
                }
            } elseif ($_GET["searchby"] == 'airline') {
                $ret = selectMultiple('SELECT * FROM slots WHERE booked=0 AND airline="'.$_GET["airline"].'";');
                if ($ret === FALSE) {
                    echo '<p class="text-danger">Error: No Slots Found</p>';
                    echo file_get_contents('../footer.html');
                    die();
                }
                echo '<table class="table-striped" width="100%"><thead><tr><th>Arrival</th><th>Airline</th><th>Aircraft</th><th>Slot</th><th>Book Slot</th></tr></thead><tbody id="tablebody">';
                while ($item = $ret->fetch_assoc()) {
                    
                    echo '<tr><td>'.$item["arr"].'</td><td>'.$item["airline"].'</td><td>'.$item["aircraft"].'</td><td>'.$item["dep_slot"].'</td><td><a href="?action=bookslot&slotid='.$item["id"].'" class="btn btn-primary">Book Slot</a></td></tr>';
                }
            } elseif ($_GET["searchby"] == 'route') {
                $ret = selectMultiple('SELECT * FROM slots WHERE booked=0 AND dep="'.$_GET["depairport"].'" AND arr="'.$_GET["arrairport"].'";');
                if ($ret === FALSE) {
                    echo '<p class="text-danger">Error: No Slots Found</p>';
                    echo file_get_contents('../footer.html');
                    die();
                }
                echo '<table class="table-striped" width="100%"><thead><tr><th>Arrival</th><th>Airline</th><th>Aircraft</th><th>Slot</th><th>Book Slot</th></tr></thead><tbody id="tablebody">';
                while ($item = $ret->fetch_assoc()) {
                    echo '<tr><td>'.$item["arr"].'</td><td>'.$item["airline"].'</td><td>'.$item["aircraft"].'</td><td>'.$item["dep_slot"].'</td><td><a href="?action=bookslot&slotid='.$item["id"].'" class="btn btn-primary">Book Slot</a></td></tr>';
                }
            } else {
                echo '<p class="text-danger">Error: Invalid Search Type</p>';
                echo file_get_contents('../footer.html');
                die();
            }
        } elseif ($_GET["action"] == 'bookslot') {
            //
            if (!isset($_GET["slotid"])) {
                echo '<p class="text-danger">Error: Slot ID is required</p>';
                echo file_get_contents('../footer.html');
                die();
            }
            $que = 'UPDATE slots SET booked=1, pilot='.$pilotdata["id"].' WHERE id='.$_GET["slotid"].' AND booked=0;';
            $ret1 = runQ($que);
            if ($ret1 != TRUE) {
                echo '<p class="text-danger">Booking Error: SQL Query Failed - '.$ret1.'</p>';
                echo file_get_contents('../footer.html');
                die();
            } else {
                $name = getConfig()["name"]l
                echo '<p class="text-success">Signup Successful! On behalf of the '.$name.' Team, thank you for coming!</p>';
            }
        } else {
            $ret = selectMultiple('SELECT * FROM slots WHERE booked=0;');
            if ($ret === FALSE) {
                echo '<p class="text-danger">Error: No Slots Found</p>';
                echo file_get_contents('../footer.html');
                die();
            }
            echo '<table class="table-striped" width="100%"><thead><tr><th>Arrival</th><th>Airline</th><th>Aircraft</th><th>Slot</th><th>Book Slot</th></tr></thead><tbody id="tablebody">';
            while ($item = $ret->fetch_assoc()) {
                echo '<tr><td>'.$item["arr"].'</td><td>'.$item["airline"].'</td><td>'.$item["aircraft"].'</td><td>'.$item["dep_slot"].'</td><td><a href="?action=bookslot&slotid='.$item["id"].'" class="btn btn-primary">Book Slot</a></td></tr>';
            }
        }
    ?>
    </tbody></table>
</div>
<?php echo file_get_contents('../footer.html'); ?>