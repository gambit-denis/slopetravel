<?php
// Include database configuration
$config = include('db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $flightNumber = $_POST['flightnumber'];
    $airlineId = $_POST['airlineid'];
    $departureAirportId = $_POST['departureairportid'];
    $departureDate = $_POST['departureflightdate'];
    $departureTime = $_POST['departureflighttime'];
    $arrivalAirportId = $_POST['arrivalairportid'];
    $arrivalDate = $_POST['arrivalflightdate'];
    $arrivalTime = $_POST['arrivalflighttime'];
    $startPrice = $_POST['startprice'];
    $stateId = $_POST['stateid'];
    $flightlink = $_POST['flightlink'];
    $registerdate = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS
    $lastupdate = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

    $stmt = $conn->prepare("INSERT INTO FLIGHTS (FLIGHTNUMBER, AIRLINEID, DEPARTUREAIRPORTID, DEPARTUREFLIGHTDATE, DEPARTUREFLIGHTTIME, ARRIVALAIRPORTID, ARRIVALFLIGHTDATE, ARRIVALFLIGHTTIME, REGISTERDATE, LASTUPDATE, STARTPRICE, ACTUALPRICE, STATEID, WEBSITE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisssssssddis", $flightNumber, $airlineId, $departureAirportId, $departureDate, $departureTime, $arrivalAirportId, $arrivalDate,  $arrivalTime,  $registerdate, $lastupdate, $startPrice, $startPrice, $stateId, $flightlink);

    // Execute the query
    if ($stmt->execute()) {
        echo "Linja ajrore u regjistrua me sukses.";
        header("Location: https://slopetravel.com/adminflights.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
