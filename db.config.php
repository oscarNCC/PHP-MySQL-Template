<?php
$server = "vlamp.cs.uleth.ca";
$dbUsername = "chao3660";
$dbPassword = "ne2iMeThai";
$database = "chao3660";


$conn = new mysqli($server, $dbUsername, $dbPassword, $database);

if ($conn->connect_error) {
    echo"error in db.config.php";
    die("Database connection failed: " . $conn->connect_error);
}
?>
