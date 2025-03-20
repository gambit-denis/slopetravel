<?php
// Database connection
$config = include('db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize form data
    $airportid = (int)$_POST['airportid'];
    $airportname = $conn->real_escape_string(trim($_POST['airportname']));
    $iata = $conn->real_escape_string(trim($_POST['iata']));
    $icao = $conn->real_escape_string(trim($_POST['icao']));
    $countryid = (int)$_POST['countryid'];
    $cityid = (int)$_POST['cityid'];
    $stateid = (int)$_POST['stateid'];

    // Update airport data in the database
    $updateQuery = "UPDATE AIRPORTS SET 
                        AIRPORTNAME = ?, 
                        IATA = ?, 
                        ICAO = ?, 
                        COUNTRYID = ?, 
                        CITYID = ?, 
                        STATEID = ? 
                    WHERE AIRPORTID = ?";

    if ($stmt = $conn->prepare($updateQuery)) {
        $stmt->bind_param("sssiiii", $airportname, $iata, $icao, $countryid, $cityid, $stateid, $airportid);
        if ($stmt->execute()) {
            header("Location: https://slopetravel.com/adminairports.php");
            exit;
        } else {
            echo "Error updating airport: " . $stmt->error;
        }
        $stmt->close();
    } else {
        die("Query preparation failed: " . $conn->error);
    }
} else {
    die("Invalid request method.");
}

$conn->close();
?>
