<?php
$config = include('db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO ACCOMMODATIONS (IDENTIFIER, INSERTDATE, ACCOMMODATIONTYPEID, CITYID, ADDRESS, LATITUDE, LONGITUDE, DISTANCE, DESCRIPTION, STATEID, WEBSITE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiisssssss", $identifier, $insertdate, $accommodationTypeId, $cityId, $address, $latitude, $longitude, $distance, $description, $stateId, $accommodationLink);

// Set parameters and execute
$identifier = $_POST['identifier'];
$accommodationTypeId = $_POST['accommodationtypeid'];
$insertdate = date('Y-m-d H:i:s'); 
$cityId = $_POST['cityid'];
$address = $_POST['address'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$distance = $_POST['distance'];
$description = $_POST['description'];
$stateId = $_POST['stateid'];
$accommodationLink = $_POST['accommodationlink'];

if ($stmt->execute()) {
    echo "Linja ajrore u regjistrua me sukses.";
    header("Location: https://slopetravel.com/adminhotels.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
