<?php
// Include database configuration
$config = include('db_config.php');

// Create a new database connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accommodationid = $_POST['accommodationid'];
    $identifier = $_POST['identifier'];
    $accommodationtypeid = $_POST['accommodationtypeid'];
    $cityid = $_POST['cityid'];
    $address = $_POST['address'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $distance = $_POST['distance'];
    $description = $_POST['description'];
    $stateid = $_POST['stateid'];
    $accommodationlink = $_POST['accommodationlink'];

    // Validate input data (optional: add your own validation here)
    if (empty($identifier) || empty($address) || empty($latitude) || empty($longitude) || empty($distance) || empty($description) || empty($stateid)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare and bind the update query
    $query = "UPDATE ACCOMMODATIONS SET IDENTIFIER=?, ACCOMMODATIONTYPEID=?, CITYID=?, ADDRESS=?, LATITUDE=?, LONGITUDE=?, DISTANCE=?, DESCRIPTION=?, STATEID=?, WEBSITE=? WHERE ACCOMMODATIONID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siisssdsisi", $identifier, $accommodationtypeid, $cityid, $address, $latitude, $longitude, $distance, $description, $stateid, $accommodationlink, $accommodationid);

    // Execute the query and check if the update was successful
    if ($stmt->execute()) {
        header("Location: https://slopetravel.com/adminhotels.php");
        exit;
    } else {
        echo "Error updating accommodation: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close database connection
$conn->close();
?>
