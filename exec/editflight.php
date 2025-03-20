<?php
// Connect to the database
$config = include('db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the submitted form data
$flightid = $_POST['flightid'];
$flightnumber = $_POST['flightnumber'];
$airlineid = $_POST['airlineid'];
$departureairportid = $_POST['departureairportid'];
$departureflightdate = $_POST['departureflightdate'];
$departureflighttime = $_POST['departureflighttime'];
$arrivalairportid = $_POST['arrivalairportid'];
$arrivalflightdate = $_POST['arrivalflightdate'];
$arrivalflighttime = $_POST['arrivalflighttime'];
$actualprice = $_POST['actualprice'];
$stateid = $_POST['stateid'];
$flightlink = $_POST['flightlink'];
$lastupdate = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

// Prepare the SQL statement to update the flight details
$sql = "UPDATE FLIGHTS 
        SET FLIGHTNUMBER = ?, AIRLINEID = ?, DEPARTUREAIRPORTID = ?, DEPARTUREFLIGHTDATE = ?, DEPARTUREFLIGHTTIME = ?, 
            ARRIVALAIRPORTID = ?, ARRIVALFLIGHTDATE = ?, ARRIVALFLIGHTTIME = ?, ACTUALPRICE = ?, STATEID = ?, LASTUPDATE = ?, WEBSITE = ?
        WHERE FLIGHTID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siississdissi", $flightnumber, $airlineid, $departureairportid, $departureflightdate, 
                     $departureflighttime, $arrivalairportid, $arrivalflightdate, $arrivalflighttime, 
                     $actualprice, $stateid, $lastupdate, $flightlink, $flightid);

// Execute the statement
if ($stmt->execute()) {
    header("Location: https://slopetravel.com/adminflights.php");
    exit();
} else {
    // Handle error (e.g., log it and show an error message)
    echo "Error updating record: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
