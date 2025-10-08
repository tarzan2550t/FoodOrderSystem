<?php
/*
$servername = "localhost";
$username = "pic01";
$password = "pic01@123456";
$dbname = "PICCAFE";

try {
    // Create a PDO instance (connect to the database)
    $conn = new PDO("mysql:host=$servername;port=3306;dbname=PICCAFE", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Message for successful connection
}
catch(PDOException $e) {
    // Catch any connection errors
    echo "Connection failed: " . $e->getMessage();
}
*/
$servername = "localhost";
$username = "root";
$password = "";


try {
    // Create a PDO instance (connect to the database)
    $conn = new PDO("mysql:host=$servername;dbname=piccafe", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Message for successful connection
}
catch(PDOException $e) {
    // Catch any connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>

    