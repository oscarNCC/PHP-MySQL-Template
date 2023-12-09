<?php
$host = "vlamp.cs.uleth.ca";
$dbname = "chao3660";
$username = "chao3660";
$password = "ne2iMeThai";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Loop and  insert 60 dummy records
    for ($i = 1; $i <= 60; $i++) {
        $make = generateRandomMake();
        $model = generateRandomModel();
        $year = rand(2000, 2023);
        $licensePlate = generateRandomLicensePlate();
        $mileage = rand(0, 200000);
        $availabilityStatus = generateRandomAvailabilityStatus();
        $rentalRate = rand(20, 200);
        $currentLocation = generateRandomLocation();

        $sql = "INSERT INTO Vehicle (Make, Model, Year, LicensePlate, Mileage, AvailabilityStatus, RentalRate, CurrentLocation) 
                VALUES (:make, :model, :year, :licensePlate, :mileage, :availabilityStatus, :rentalRate, :currentLocation)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':make', $make, PDO::PARAM_STR);
        $stmt->bindParam(':model', $model, PDO::PARAM_STR);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':licensePlate', $licensePlate, PDO::PARAM_STR);
        $stmt->bindParam(':mileage', $mileage, PDO::PARAM_INT);
        $stmt->bindParam(':availabilityStatus', $availabilityStatus, PDO::PARAM_STR);
        $stmt->bindParam(':rentalRate', $rentalRate, PDO::PARAM_INT);
        $stmt->bindParam(':currentLocation', $currentLocation, PDO::PARAM_STR);

        $stmt->execute();
    }

    echo "Successfully inserted 60 dummy records.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function generateRandomMake() {
    $makes = ["Toyota", "Honda", "Ford", "Chevrolet", "BMW", "Mercedes", "Nissan","Kia","Porsche","Mini","Lamborghini"];
    return $makes[array_rand($makes)];
}

function generateRandomModel() {
    $models = ["Sedan", "SUV", "Truck", "Convertible", "Coupe", "Hatchback"];
    return $models[array_rand($models)];
}

function generateRandomLicensePlate() {
    return strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3)) . rand(100, 999);
}

function generateRandomAvailabilityStatus() {
    $statuses = ["available", "rented", "under maintenance"];
    return $statuses[array_rand($statuses)];
}

function generateRandomLocation() {
    $locations = ["Parking Lot A", "Parking Lot P", "Parking Lot M", "Parking Lot D", "Parking Lot UG", "Parking Lot A1"];
    return $locations[array_rand($locations)];
}
?>
