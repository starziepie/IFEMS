<?php
if (substr($_SERVER["REQUEST_URI"], 0, 6) != '/admin') {
    session_start();
}
if (!isset($_SESSION["pilotid"])) {
    echo '<script>window.location.href = "../login.php"</script>';   
}

function getPilotData($id) {
    return select('SELECT * FROM pilots WHERE id='.$id);
}

$pilotdata = getPilotData($_SESSION["pilotid"]);