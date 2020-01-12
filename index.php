<?php echo file_get_contents('header.html');
require 'mysql.php';
?>
<div class="jumbotron text-center">
<h1>Welcome to the Signup System for <?php echo getConfig()["name"] ?></h1>
<h3>@ <?php echo getConfig()["airport"] ?> - <?php echo getConfig()["datetime"] ?></h3>
<button class="btn btn-primary btn-lg" onclick="window.location.href = 'login.php'">Log In</button>
<button class="btn btn-primary btn-lg" onclick="window.location.href = 'signup.php'">Sign Up</button>
</div>
<?php echo file_get_contents('footer.html') ?>