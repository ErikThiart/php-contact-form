<?php
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_dbname = "youtube";

try {
    $pdo = new PDO("mysql:host=$db_servername;dbname=$db_dbname", $db_username, $db_password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage(); // log this and send a smoke signal
    }
?>