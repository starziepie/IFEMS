<?php
    // IMPORTANT: PUT YOUR CREDS HERE IN BETWEEN THE QUOTES ON EACH ITEM
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'standard-ems';
    
    
    
    
    function runQ($sql) {
        global $server, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($server, $username, $password, $dbname, 3308);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // END CONNECTION

        if ($conn->query($sql) === TRUE) {
            return TRUE;
        } else {
            return mysqli_error($conn);
        }

        $conn->close();
    }

    function getConfig() {
        return select('SELECT * FROM config WHERE id=1;');
    }

    function select($selSql) {
        global $server, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($server, $username, $password, $dbname, 3308);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // END CONNECTION

        $result = $conn->query($selSql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return FALSE;
        }
    }

    function selectMultiple($selSql) {
        global $server, $username, $password, $dbname;
        // Create connection
        $conn = new mysqli($server, $username, $password, $dbname, 3308);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // END CONNECTION

        $result = $conn->query($selSql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function getUrl() {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        return $actual_link;
    }