<!DOCTYPE html>
<html>
<head>
    <title>Delete Vehicle</title>
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
    <h2>Delete Vehicle</h2>
    <form method="POST" action="">
        <label for="vehicleID">Vehicle ID:</label>
        <input type="text" name="vehicleID" required><br>
        <input type="submit" name="delete" value="Delete">
 
        <input type="checkbox" value ='Confirm 'required> Confirm
    </form>

    <?php
    $host = "vlamp.cs.uleth.ca";
    $dbname = "chao3660";
    $username = "chao3660";
    $password = "ne2iMeThai";

    if (isset($_POST['delete'])) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $vehicleID = $_POST['vehicleID'];

            $sql = "DELETE FROM Vehicle WHERE VehicleID = :vehicleID";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':vehicleID', $vehicleID, PDO::PARAM_INT);

           
            $stmt->execute();

            echo "Vehicle with VehicleID $vehicleID has been deleted successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
     <p><a href='http://vlamp.cs.uleth.ca/~chao3660/main.php'>Back to the main page</a></p>
</body>
</html>
