<?php 
    require '../mysql.php';
    require 'auth.php';
    require 'header.php';
    $config = getConfig();
?>
<h2 style="margin: 8px;" class="text-center">Event Briefing</h2>
<?php
$bookedslot = select('SELECT * FROM slots WHERE pilot='.$pilotdata["id"].';');
if ($bookedslot === FALSE) {
    echo '<div class="jumbotron text-center"><h2>Looks Like You Havent Booked Any Slots Yet</h2><p>Go to the <a href="slotsearch.php">Slot Search</a> to reserve your spot now!</p></div>';
    echo file_get_contents('../footer.html');
    die(); 
}
?>
<div style="margin: 8px;">
<p class="text-center">
    <b>Thank you for booking a slot for <?php echo $config["name"] ?>. Please see below for the details.</b><br />
    <table class="table">
    <tr><th>Arrival Airport</th><td><?php echo $bookedslot["arr"] ?></td></tr>
    <tr><th>Aircraft</th><td><?php echo $bookedslot["aircraft"] ?></td></tr>
    <tr><th>Airline</th><td><?php echo $bookedslot["airline"] ?></td></tr>
    <tr><th>Departure Slot (Takeoff Time)</th><td><?php echo $bookedslot["dep_slot"] ?></td></tr>
    <tr><th>On Stand Time</th><td>20 Minutes prior to Takeoff Time</td></tr>
    </table>
</p>  
</div>
<?php echo file_get_contents('../footer.html'); ?>