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
    <nav class="navbar navbar-expand-md bg-primary navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="/pilotarea"><b>Pilot Area</b></a>
      
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <?php $bookedslot = select('SELECT * FROM slots WHERE pilot='.$pilotdata["id"].';');
                  if ($bookedslot === FALSE) {
                    ?>
                    <a class="nav-link text-white" href="slotsearch.php">Search Slots</a>
                  <?php } ?>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                  <a style="cursor: pointer;" class="nav-link text-white dropdown-toggle" data-toggle="dropdown">
                  Profile
                  </a>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="profile.php">View My Profile</a>
                  <a class="dropdown-item" href="editprofile.php">Edit Profile</a>
                  <a class="dropdown-item text-danger" href="logout.php">Log Out</a>
                  </div>
              </div>
            </li>
            <?php 
              if ($_SESSION["admin"] == '1') {
                  echo '<li class="nav-item"><a class="nav-link text-white" href="../admin">Admin Center</a></li>';
              }
          ?>
          </ul>
        </div>
      </nav>