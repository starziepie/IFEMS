<?php require 'header.php' ?>

<h4>Users</h4>
<table class="table table-striped"><thead><tr><th>IFC Name</th><th>Email</th><th>Slots Booked</th></tr></thead><tbody>
<?php
    $users = selectMultiple('SELECT * FROM pilots');
    while ($row = $users->fetch_assoc()) {
        $ret1 = selectMultiple('SELECT * FROM slots WHERE pilot='.$row["id"].';');
        $slotsBooked = $ret1["num_rows"];
        if (!isset($slotsBooked)) {
            $slotsBooked = 0;
        }
        echo '<tr><td>';
        echo $row["ifcname"];
        echo '</td><td>';
        echo $row["email"];
        echo '</td><td>';
        echo $slotsBooked;
        echo '</td></tr>';
    }
?>
</tbody>
</table>

<?php require 'footer.php' ?>