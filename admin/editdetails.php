<?php require 'header.php'; ?>
    <?php 
        if (isset($_GET["action"]) && $_GET["action"] == 'update') {
            if (isset($_POST["partners"]) && $_POST["partners"] != '') {
                $query = 'UPDATE config SET name="'.$_POST["name"].'", datetime="'.$_POST["datetime"].'", airport="'.$_POST["airport"].'", partners="'.$_POST["partners"].'" WHERE id=1;';
            } else {
                $query = 'UPDATE config SET name="'.$_POST["name"].'", datetime="'.$_POST["datetime"].'", airport="'.$_POST["airport"].'" WHERE id=1;';
            }
            $ret = runQ($query);
            if ($ret === TRUE) {
                echo '<p class="text-success">Success!</p>';
            } else {
                echo '<p class="text-danger">Error Updating SQL Row: '.$ret.'</p>';
            }
        }
        $configData = getConfig();
    ?>
    <h4>Edit Event Details</h4>
    <form action="editdetails.php?action=update" method="post">
        <div class="form-group">
        <label for="name">Event Name</label>
        <input required id="name" name="name" type="text" class="form-control" placeholder="My Great Event" value="<?php echo $configData["name"] ?>">
        </div>
        <div class="form-group">
        <label for="datetime">Event DateTime<br /><small><i>This should be in the standard IFC format of DDTTTTZMMMYY (eg. 011800ZJAN20)</i></small></label>
        <input required id="datetime" name="datetime" type="text" class="form-control" placeholder="DDTTTTZMMMYY" value="<?php echo $configData["datetime"] ?>">
        </div>
        <div class="form-group">
        <label for="airport">Event Airport/s ICAO</label>
        <input required id="airport" name="airport" type="text" class="form-control" placeholder="XXXX" value="<?php echo $configData["airport"] ?>">
        </div>
        <div class="form-group">
        <label for="partners">Partners<br /><small>If Applicable</small></label>
        <input id="partners" name="partners" type="text" class="form-control" placeholder="The Best VA, The Best VO" value="<?php echo $configData["partners"] ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="Update Details">
    </form>

<?php require 'footer.php'; ?>