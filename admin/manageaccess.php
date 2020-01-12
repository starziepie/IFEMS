<?php require 'header.php' ?>

<h3>Manage Admin Access</h3>
<?php
    if (!isset($_SESSION["admin"])) {
        echo '<script>window.location.href = "/pilotarea"</script>';
    }
    if (isset($_GET["action"])) {
        if ($_GET["action"] == 'removeadmin' && $pilotdata["id"] == 1) {
            $query = 'UPDATE pilots SET admin=0 WHERE id='.$_GET["id"].';';
            $ret = runQ($query);
            if ($ret === TRUE) {
                echo '<p class="text-success">Success.</p>';
            } else {
                echo '<p class="text-danger">Error Updating Database: '.$ret.'</p>';
            }
        } elseif ($_GET["action"] == 'giveadmin' && $pilotdata["id"] == 1) {
            $query = 'UPDATE pilots SET admin=1 WHERE id='.$_GET["id"].';';
            $ret = runQ($query);
            if ($ret === TRUE) {
                echo '<p class="text-success">Success.</p>';
            } else {
                echo '<p class="text-danger">Error Updating Database: '.$ret.'</p>';
            }
        }
    }
?>
<table class="table table-striped"><thead><tr><th>IFC Name</th><th>Action</th></tr></thead><tbody>
<?php
    $allpilots = selectMultiple('SELECT * FROM pilots');
    if ($pilotdata["id"] == 1) {
        while ($row = $allpilots->fetch_assoc()) {
            echo '<tr><td>'.$row["ifcname"].'</td><td>';
            if ($row["admin"] == 1) {
                echo '<a href="?action=removeadmin&id='.$row["id"].'" class="btn btn-danger">Remove Admin Access</a>&nbsp;&nbsp;';
            } else {
                echo '<a href="?action=giveadmin&id='.$row["id"].'" class="btn btn-primary">Give Admin Access</a>&nbsp;&nbsp;';
            }
            echo '</td></tr>';
        }
    }
?>
</tbody></table>

<?php require 'footer.php' ?>