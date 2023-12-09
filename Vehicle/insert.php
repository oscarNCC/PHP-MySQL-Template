<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h2>Add a New Vehicle</h2>
    <form action="insert.php" method="post">
        <label for="make">Make:<ble:</label>
    
        <input type="text" name="make" size="9" required><br><br>
        <label for="model">Model:<ble:</label>
        <input type="text" name="model" size="9" required><br><br>

        <label for="year">Year:</label>
        <input type="text" name="year" size="9" required ><br><br>

        <label for="Licenseplate">License Plate:</label>
        <input type="text" name="LicensePlate" size="9"required ><br><br>

        <label for="Mileage">Mileage:</label>
        <input type="text" name="Mileage" size="9"><br><br>

      
        <label for="RentalRate">Rental Rate:</label>
        <input type="text" name="RentalRate" size="9" required><br><br>

        <label for="CurrentLocation">Current Location:</label>
        <input type="text" name="CurrentLocation" size="9" required><br><br>
        <label for="AvailabilityStatus">Availability Status:</label>
        <select name="AvailabilityStatus" id="cars">
            <option value="available">Available</option>
            <option value="rented">Rented</option>
            <option value="under maintenance">Under maintenance</option>          
        </select><br><br>
        
        <input type="submit" name="submit" value="Add New Car">
        <p><a href='http://vlamp.cs.uleth.ca/~chao3660/main.php'>Back to the main page</a></p>
        <p><a href='http://vlamp.cs.uleth.ca/~chao3660/Vehicle/gen_dumbData.php'>Generate Dumb data</a></p>
 
    </form>
</body>
</html>

<?php

$server = "vlamp.cs.uleth.ca";
$dbUsername = "chao3660";
$dbPassword = "ne2iMeThai";
$database = "chao3660";

$conn = new mysqli($server, $dbUsername, $dbPassword, $database);


if ($conn->connect_error) {
    echo"Connection Error";
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $make = $_POST["make"];
    $model = $_POST["model"];
    $year = $_POST["year"];
    $LicensePlate = $_POST["LicensePlate"];
    $Mileage = $_POST["Mileage"];
    $AvailabilityStatus = $_POST["AvailabilityStatus"];
    $RentalRate = $_POST["RentalRate"];
    $CurrentLocation = $_POST["CurrentLocation"];

    $sql = "INSERT INTO Vehicle (Make, Model,Year,LicensePlate,Mileage,AvailabilityStatus,RentalRate,CurrentLocation) VALUES (?, ?,?,?,?,?,?,?)";

 
    try {
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssisisds", $make, $model,$year, $LicensePlate,$Mileage, $AvailabilityStatus,$RentalRate,$CurrentLocation);
    
            if ($stmt->execute()) {
                echo "Data inserted successfully.";
          
                
             
            } else {
                echo "Error executing query: " . $stmt->error;
            }
              
            $stmt->close();
        } else {
            echo "<Exception>";
            throw new Exception("Error preparing SQL statement: " . $conn->error);
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
    
}

$conn->close();
?>
