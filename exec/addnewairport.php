<?php
// Include the database configuration file
$config = include('db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO AIRPORTS (AIRPORTNAME, IATA, ICAO, COUNTRYID, CITYID, STATEID) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiii", $airportName, $iata, $icao, $countryId, $cityId, $stateId);

// Set parameters and execute
$airportName = $_POST['airportname'];
$iata = $_POST['iata'];
$icao = $_POST['icao'];
$countryId = $_POST['countryid'];
$cityId = $_POST['cityid'];
$stateId = $_POST['stateid'];

if ($stmt->execute()) {
    echo "Aeroporti u regjistrua me sukses.";
    // Redirect to the customer list
    header("Location: https://slopetravel.com/adminairports.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
