<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Vehicle</title>
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
            width: 90%;
            padding: 10px 15px;
            border: 3px solid #ccc;
            border-radius: 4px;
            cursor: pointer;test1ver {
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

 <form method="GET" action="">
Brand: <input type="text" name="brand"><br>
 Vehicle ID: <input type="text" name="id"><br>
 Year: <input type="text" name="year"><br>
 License Plate: <input type="text" name="license"><br>
 Mileage (under a number): <input type="text" name="mileage"><br>

 Availability Status: <select name="as" id="as">
            <option value=""></option>
            <option value="available">Available</option>
            <option value="rented">Rented</option>
            <option value="under maintenance">Under maintenance</option>          
        </select><br><br>

 <input type="submit" name="search" value="Search">
 </form>

 <p><a href='http://vlamp.cs.uleth.ca/~chao3660/main.php'>Back to the main page</a></p>
<body>
    
</body>
</html>
<?php
$host = "vlamp.cs.uleth.ca";
$dbname = "chao3660";
$username = "chao3660";
$password = "ne2iMeThai";


if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $display = '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        $sql = "SELECT VehicleID, Make, Model, Year, LicensePlate, Mileage, AvailabilityStatus, RentalRate, CurrentLocation FROM Vehicle WHERE 1"; //alwasy true

        //.= append mean
        if (!empty($_GET['brand'])) {
            $brand = $_GET['brand'];
            //$display .=$brand;
            $sql .= " AND Make = :brand";
        }


        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
           /// $display .="+ $id";
            $sql .= " AND VehicleID = :id";
        }


        if (!empty($_GET['year'])) {
            $year = $_GET['year'];
            $sql .= " AND Year = :year";
        }


        if (!empty($_GET['license'])) {
            $licensePlate = $_GET['license'];
            $sql .= " AND LicensePlate = :license";
        }


        if (!empty($_GET['mileage'])) {
            $mileage = $_GET['mileage'];
            $sql .= " AND Mileage <= :mileage";
        }

        if (!empty($_GET['as'])) {
            $status = $_GET['as']; 
       
            $sql .= " AND AvailabilityStatus = :as"; 
        }
        $stmt = $pdo->prepare($sql);
 
   
        if (!empty($brand)) {
            $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        }

        if (!empty($id)) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }
       
        if (!empty($year)) {
            $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        }
        if (!empty($licensePlate)) {
            $stmt->bindParam(':license', $licensePlate, PDO::PARAM_STR);
        }

        if (!empty($mileage)) {
            $stmt->bindParam(':mileage', $mileage, PDO::PARAM_INT);
        }

        if (!empty($status)) {
            $stmt->bindParam(':as', $status, PDO::PARAM_STR); 
        }
        

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            
            echo '<table border="1" style="border-collapse: collapse; width: 100%;">';
            echo '<tr><th style="b if (!empty(0))ackground-color: #ccc;">Vehicle ID</th><th style="background-color: #ccc;">
            Brand</th><th style="background-coloInvalid parameter number: parameter was not definedr: #ccc;">Model</th><th style="background-color: #ccc;">Year</th><th style="background-color: #ccc;">License Plate</th><th style="background-color: #ccc;">Mileage</th><th style="background-color: #ccc;">Availability Status</th><th style="background-color: #ccc;">Rental Rate</th><th style="background-color: #ccc;">Current Location</th></tr>';

            foreach ($result as $row) {
                $vehicleID = $row['VehicleID'];
                $make = $row['Make'];
                $model = $row['Model'];
                $year = $row['Year'];
                $licensePlate = $row['LicensePlate'];
                $mileage = $row['Mileage'];
                $availabilityStatus = $row['AvailabilityStatus'];
                $rentalRate = $row['RentalRate'];
                $currentLocation = $row['CurrentLocation'];

                echo "<tr><td>$vehicleID</td><td>$make</td><td>$model</td><td>$year</td><td>$licensePlate</td><td>$mileage</td><td>$availabilityStatus</td><td>$rentalRate</td><td>$currentLocation</td></tr>";
            
            }
            
            echo '</table>';
       
            echo "Query...$sql";
        } else {
            echo "No data found for the specified criteria.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>
