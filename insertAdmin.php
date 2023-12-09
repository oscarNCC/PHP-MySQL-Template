<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$hostname = "vlamp.cs.uleth.ca";
$dbUsername = "chao3660"; // Database username
$dbPassword = "ne2iMeThai"; // Database password
$dbname = "chao3660";

// Admin information
$adminUsername = $_POST['username'];
$plainPassword = $_POST['password']; 
$adminName = $_POST['name'];


$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);


$conn = new mysqli($hostname, $dbUsername, $dbPassword, $dbname);


if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO admin (username, password,name) VALUES (?, ?,?)";

$stmt = $conn->prepare($sql);
 

$stmt->bind_param("sss", $adminUsername, $hashedPassword,$adminName);


if ($stmt->execute()) {
    echo "Admin inserted successfully.";
} else {
    echo "Error inserting admin: " . $stmt->error;
}

$stmt->close();
$conn->close();
echo "<br><p><a href='main.php'>Back</a></p>";
?>
