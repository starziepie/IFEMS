<?php 
    require 'mysql.php';
    echo file_get_contents('header.html');
?>
<div class="container-fluid text-center">
<h2>Apply</h2>
<?php
    if ($_GET["action"] == 'signup' && $_POST) {
        if ($_POST["password"] != $_POST["conf-password"]) {
            echo '<p class="text-danger">The passwords do not match.</p>';
            die();
        }

        $encpass = password_hash($_POST["password"], PASSWORD_BCRYPT);
        if ($encpass === FALSE) {
            echo '<p class="text-danger">Registration Error: Password Encryption Failed</p>';
            die();
        }
        $current = selectMultiple('SELECT * FROM pilots');
        if ($current === FALSE) {
            $query = 'INSERT INTO pilots (email, pass, ifcname, admin) VALUES ("'.$_POST["email"].'", "'.$encpass.'", "'.$_POST["ifcname"].'", 1);';
        } else { 
            $query = 'INSERT INTO pilots (email, pass, ifcname) VALUES ("'.$_POST["email"].'", "'.$encpass.'", "'.$_POST["ifcname"].'");';
        }
        $ret =  runQ($query);
        if ($ret === TRUE) {
            echo '<p class="text-success">Registration Successful. An admin now needs to approve your account, you will receive an email once this has been done.</p>';
        } else {
            echo '<p class="text-danger">Registration Error: SQL Query Failed - '.$ret.'</p>';
        }
    }
?>
<form method="post" action="apply.php?action=signup">
    <input required style="width: 40%; display: block; margin-left: auto; margin-right: auto;" <?php if($_POST["ifcname"]) {echo 'value="'.$_POST["ifcname"].'"';} ?> type="text" class="form-control" name="ifcname" placeholder="IFC Name">
    <input required style="width: 40%; display: block; margin-left: auto; margin-right: auto;" <?php if($_POST["email"]) {echo 'value="'.$_POST["email"].'"';} ?> type="email" class="form-control" name="email" placeholder="Email">
    <input required style="width: 40%; display: block; margin-left: auto; margin-right: auto;" type="password" class="form-control" name="password" placeholder="Password">
    <input required style="width: 40%; display: block; margin-left: auto; margin-right: auto;" type="password" class="form-control" name="conf-password" placeholder="Confirm Password"><br />
    <input type="submit" value="Apply" class="btn btn-primary">
</form>
</div>
<?php echo file_get_contents('footer.html') ?>