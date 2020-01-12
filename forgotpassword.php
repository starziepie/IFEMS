<?php
    session_start();
    require 'mysql.php';
    echo file_get_contents('header.html');
    echo '<div class="container-fluid text-center"><h2>Forgot Password</h2>';
    if ($_GET["action"] == 'reset') {
        if ($_POST["pass"] && $_POST["confpass"] && $_POST["pilotid"]) {
            if ($_POST["pass"] == $_POST["confpass"]) {
                $encpass = password_hash($_POST["pass"], PASSWORD_BCRYPT);
                $qu1 = 'UPDATE pilots SET pass="'.$encpass.'" WHERE id="'.$_POST["pilotid"].'";';
                $ret1 = runQ($qu1);
                if ($ret1 != TRUE) {
                    echo '<p class="text-danger">Error Changing Password: SQL Query 1 Error - '.$ret1;
                    echo file_get_contents('footer.html');
                    die();
                }
                $qu2 = 'DELETE FROM pword_resets WHERE pilotid="'.$_POST["pilotid"].'";';
                $ret2 = runQ($qu2);
                if ($ret2 != TRUE) {
                    echo '<p class="text-danger">Error Changing Password: SQL Query 2 Error - '.$ret2.'.<br /><b>This is a security error! Contact your site admin immediately!</b>';
                    echo file_get_contents('footer.html');
                    die();
                }
                echo '<p class="text-success">Success! You may now log in <a href="login.php">here</a>.</p>';
            } else {
                echo '<p class="text-danger">Error Changing Password: The passwords do not match.</p>';
                echo file_get_contents('footer.html');
                die();
            }
        } else {
            echo '<p class="text-danger">Error Changing Password: All fields are required.</p>';
        }
    } elseif ($_GET["key"] && $_GET["pilotid"]) {
        $query = 'SELECT resetkey FROM pword_resets WHERE pilotid="'.$_GET["pilotid"].'";';
        $ret = select($query);
        $enckey = $ret["resetkey"];
        $deckey = $_GET["key"];
        if (password_verify($deckey, $enckey)) {
            echo '<form action="forgotpassword.php?action=reset" method="post"><input hidden name="pilotid" value="'.$_GET['pilotid'].'"><input required type="password" class="form-control" name="pass" placeholder="New Password" style="width: 40%; display: block; margin-left: auto; margin-right: auto;"><input required type="password" class="form-control" name="confpass" placeholder="Confirm New Password" style="width: 40%; display: block; margin-left: auto; margin-right: auto;"><input type="submit" class="btn btn-primary" value="Reset Password"></form>';
        } else {
            echo '<p class="text-danger">Error Reseting Password: Key is not valid.</p>';
            echo file_get_contents('footer.html');
            die();
        }
    } elseif ($_GET["action"] == 'sendemail') {
        $key = bin2hex(random_bytes(10));
        $pid = select('SELECT id FROM pilots WHERE email="'.$_POST["email"].'";');
        $emlBody = 'Hello,\n\nLooks like you have requested a password reset on a InfiniteVMS Site.\nTo reset your password, go to'.getUrl().'/resetpassword.php?key='.$key.'&pilotid='.$pid.'\nIf you do not do this, no action will be taken.';
        $emlBody = wordwrap($emlBody,70);
        $recipient = $_POST["email"];
        $subject = 'Your InfiniteVMS Password Reset';
        mail($recipient, $subject, $emlBody, 'From: kai@kaimalcolm.rf.gd');
        echo '<p class="text-success">An email has been sent to '.$_POST["email"].'. Please check the email and follow the link to reset your password.</p>';
    }
?>
<p>Please enter your email to get a link to reset your password.</p><br />
<form action="forgotpassword.php?action=sendemail" method="post">
<input required type="email" name="email" class="form-control" placeholder="Email" <?php if ($_POST["email"]){echo 'value="'.$_POST["email"].'"';}?>>
<input type="submit" class="btn btn-primary" value="Send Email">
</form>
</div>
<?php echo file_get_contents('footer.html'); ?>