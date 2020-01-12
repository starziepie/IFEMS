<?php
require 'header.php';
$stats = getStats();
?>
<h4 class="text-center">Dashboard</h4>
<h5 class="text-center"><i>Welcome back <?php echo $pilotdata["ifcname"]; ?></i></h5>
<p class="text-center">
    <b>Slots Booked:</b> <?php echo $stats["Booked"]; ?><br />
    <b>Slots Available:</b> <?php echo $stats["Available"]; ?><br />
    <b>Pilots Registered:</b> <?php echo $stats["Pilots"]; ?><br />
</p>
<?php require 'footer.php'; ?>