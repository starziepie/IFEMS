<?php 
session_start();
if (!isset($_SESSION["admin"])) {
    echo '<script>window.location.href = "../pilotarea"</script>';   
}

require '../mysql.php';
require 'signups-api.php';
require '../pilotarea/auth.php'
?>
<!DOCTYPE html>
<html>
<head>
<title>InfiniteVMS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="text-center">
</div>
    <div class="row" style="margin: 8px;">
        <div class="col-4">
        <h4>Menu</h4>
        <button type="button" class="btn btn-primary" onclick="window.location.href = '/admin';" style="width: 100%; text-align: left;">Dashboard</button>
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#management" style="width: 100%; text-align: left;">Event Management</button>
        <div id="management" class="collapse show">
            <ul class="list-group">
                <li class="list-group-item"><a href="manageslots.php">Manage Slots</a></li>
                <li class="list-group-item"><a href="editdetails.php">Edit Details</a></li>
            </ul>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#signups" style="width: 100%; text-align: left;">Signup Management</button>
        <div id="signups" class="collapse show">
            <ul class="list-group">
                <li class="list-group-item"><a href="manageslots.php">View Signups</a></li>
                <li class="list-group-item"><a href="/admin">View Stats</a></li>
            </ul>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#users" style="width: 100%; text-align: left;">User Management</button>
        <div id="users" class="collapse show">
            <ul class="list-group">
                <li class="list-group-item"><a href="users.php">View All Users</a></li>
                <?php if (isset($_SESSION["admin"])) { ?>
                <li class="list-group-item"><a href="manageaccess.php">Manage Access</a></li>
                <?php } ?>
            </ul>
        </div>
        <button type="button" class="btn btn-info" onclick="window.location.href='../pilotarea'" style="width: 100%; text-align: left;">Back to Main Site</button>
        </div>
        <div class="col-8">