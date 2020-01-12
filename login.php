<?php 
    session_start();
    require 'mysql.php';
    echo file_get_contents('header.html');
?>
<div class="text-center">
<h2>Log In</h2>
<?php
    if (isset($_GET["action"]) && $_GET["action"] == 'validate' && $_POST) {
        if (!$_POST["email"] || !$_POST["password"]) {
            echo '<p class="text-danger">An Email and Password is requred.</p>';
        }
        $sel = "SELECT pass, id, admin FROM pilots WHERE email='".$_POST["email"]."'";
        $ret = select($sel);
        if (password_verify($_POST["password"], $ret["pass"])) {
            $_SESSION["pilotid"] = $ret["id"];
            if ($ret["admin"] == 1) {
                $_SESSION["admin"] = 1;
            }
            echo '<p class="text-success">Success!</p>';
        } else {
            echo '<p class="text-danger">Incorrect Username and/or Password.</p>';
            die();
        }
        if ($_SESSION["pilotid"]) {
            echo '<script>window.location.href = "/pilotarea"</script>';
        }
    }
?>
<form method="post" action="login.php?action=validate">
    <input style="width: 40%; display: block; margin-left: auto; margin-right: auto;" <?php if(isset($_POST["email"])) {echo 'value="'.$_POST["email"].'"';} ?> type="text" class="form-control" name="email" placeholder="Email">
    <input style="width: 40%; display: block; margin-left: auto; margin-right: auto;" type="password" class="form-control" name="password" placeholder="Password"><br />
    <input type="submit" value="Log In" class="btn btn-primary">
</form>
</div>
<?php echo file_get_contents('footer.html') ?>