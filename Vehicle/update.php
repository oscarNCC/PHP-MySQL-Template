<?php
$host = "vlamp.cs.uleth.ca";
$dbname = "chao3660";
$username = "chao3660";
$password = "ne2iMeThai";

if (isset($_POST['update'])) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     
        $sql = "UPDATE Vehicle SET ";      

        if (!empty($_POST['make'])) {
            $sql .= "Make = :make, ";
        }

        if (!empty($_POST['model'])) {
            $sql .= "Model = :model, ";
        }

        if (!empty($_POST['year'])) {
            $sql .= "Year = :year, ";
        }

        if (!empty($_POST['license'])) {
            $sql .= "LicensePlate = :license, ";
        }

        if (!empty($_POST['mileage'])) {
            $sql .= "Mileage = :mileage, ";
        }

        if (!empty($_POST['availability'])) {
            $sql .= "AvailabilityStatus = :availability, ";
        }

        if (!empty($_POST['rate'])) {
            $sql .= "RentalRate = :rate, ";
        }

        if (!empty($_POST['location'])) {
            $sql .= "CurrentLocation = :location, ";
        }

     
        $sql = rtrim($sql, ', ');

  
        $sql .= " WHERE VehicleID = :id";

      
        $stmt = $pdo->prepare($sql);

     
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

        if (!empty($_POST['make'])) {
            $stmt->bindParam(':make', $_POST['make'], PDO::PARAM_STR);
        }

        if (!empty($_POST['model'])) {
            $stmt->bindParam(':model', $_POST['model'], PDO::PARAM_STR);
        }

        if (!empty($_POST['year'])) {
            $stmt->bindParam(':year', $_POST['year'], PDO::PARAM_INT);
        }

        if (!empty($_POST['license'])) {
            $stmt->bindParam(':license', $_POST['license'], PDO::PARAM_STR);
        }

        if (!empty($_POST['mileage'])) {
            $stmt->bindParam(':mileage', $_POST['mileage'], PDO::PARAM_INT);
        }

        if (!empty($_POST['availability'])) {
            $stmt->bindParam(':availability', $_POST['availability'], PDO::PARAM_STR);
        }

        if (!empty($_POST['rate'])) {
            $stmt->bindParam(':rate', $_POST['rate'], PDO::PARAM_INT);
        }

        if (!empty($_POST['location'])) {
            $stmt->bindParam(':location', $_POST['location'], PDO::PARAM_STR);
        }


        $stmt->execute();

        echo "Car with VehicleID " . $_POST['id'] . " updated successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Car</title>
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
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
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
    
    <form method="POST" action="">
    <h2>Update Car Information</h2>
        Vehicle ID: <input type="text" name="id" required><br>
        Make: <input type="text" name="make"><br>
        Model: <input type="text" name="model"><br>
        Year: <input type="text" name="year"><br>
        License Plate: <input type="text" name="license"><br>
        Mileage: <input type="text" name="mileage"><br>
        Availability Status: <select name="availability" id="availability">
            <option value=""></option>
            <option value="available">Available</option>
            <option value="rented">Rented</option>
            <option value="under maintenance">Under maintenance</option>          
        </select><br><br>
        Rental Rate: <input type="text" name="rate"><br>
        Current Location: <input type="text" name="location"><br>
        <input type="submit" name="update" value="Update">
        <p><a href='http://vlamp.cs.uleth.ca/~chao3660/main.php'>Back to the main page</a></p>
    </form>
   
</body>
</html>
