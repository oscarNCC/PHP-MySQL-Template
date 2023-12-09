<?php

$server = "vlamp.cs.uleth.ca";
$dbUsername = "chao3660";
$dbPassword = "ne2iMeThai";
$database = "chao3660";

try {
    // Create a database connection
    $con = mysqli_connect($server, $dbUsername, $dbPassword, $database);

    if (!$con) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }


	$username = $_POST["username"];
	$password = $_POST["password"];
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($con, $query);
	
    if ($result) {
		
    
        if (mysqli_num_rows($result) > 0) {
          
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
		
           
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, set cookies and redirect to main.php
				
				$query = "UPDATE admin SET last_login_time = NOW() WHERE username = '$username'";
				$result = mysqli_query($con, $query);
                setcookie("username", $username, time() + 3600);
                setcookie("password", $password, time() + 3600);
                header("Location: main.php");
                exit();
            }
        }
    } else {
        throw new Exception("Error executing the query: " . mysqli_error($con));
    }

    // If the script reaches here, the login is unsuccessful
    echo "Username or Password is wrong~~!<br><p><a href='index.php'>Back</a></p>";
    
    // Close the database connection
    mysqli_close($con);

} catch (Exception $e) {
    echo $e->getMessage() . "<br>";
    echo "Username or Password is wrong~~!<br><p><a href='index.php'>Back</a></p>";
}
?>
