<?php
function getStats() {
    $xyz = selectMultiple('SELECT * FROM slots WHERE booked=1');
    $booked = $xyz->num_rows;
    if (!isset($booked)) {
        $booked = 0;
    }
    $available = selectMultiple('SELECT * FROM slots WHERE booked=0');
    $available = $available->num_rows;
    if (!isset($available)) {
        $available = 0;
    }
    $pilots = selectMultiple('SELECT * FROM pilots');
    $pilots = $pilots->num_rows;
    $ret = array(
        "Booked"=>$booked,
        "Available"=>$available,
        "Pilots"=>$pilots
    );
    return $ret;
}
