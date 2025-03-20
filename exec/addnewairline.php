<?php
// Include the database configuration file
$config = include('db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO AIRLINES (AIRLINENAME, LEGALNAME, IATA, ICAO, WEBSITE, STATEID) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $airportName, $legalname, $iata, $icao, $website, $stateId);

// Set parameters and execute
$airportName = $_POST['airlinename'];
$legalname = $_POST['legalname'];
$iata = $_POST['iata'];
$icao = $_POST['icao'];
$website = $_POST['website'];
$stateId = $_POST['stateid'];

if ($stmt->execute()) {
    echo "Linja ajrore u regjistrua me sukses.";
    // Redirect to the customer list
    header("Location: https://slopetravel.com/adminairlines.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
