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
    $airlineid = (int)$_POST['airlineid'];
    $airlinename = $conn->real_escape_string(trim($_POST['airlinename']));
    $legalname = $conn->real_escape_string(trim($_POST['legalname']));
    $iata = $conn->real_escape_string(trim($_POST['iata']));
    $icao = $conn->real_escape_string(trim($_POST['icao']));
    $website = $conn->real_escape_string(trim($_POST['website']));
    $stateid = (int)$_POST['stateid'];

    // Update airline data in the database
    $updateQuery = "UPDATE AIRLINES SET 
                        AIRLINENAME = ?, 
                        LEGALNAME = ?, 
                        IATA = ?, 
                        ICAO = ?, 
                        WEBSITE = ?, 
                        STATEID = ? 
                    WHERE AIRLINEID = ?";

    if ($stmt = $conn->prepare($updateQuery)) {
        $stmt->bind_param("ssssssi", $airlinename, $legalname, $iata, $icao, $website, $stateid, $airlineid);
        if ($stmt->execute()) {
            // Redirect to the admin airlines page on success
            header("Location: https://slopetravel.com/adminairlines.php");
            exit;
        } else {
            echo "Error updating airline: " . $stmt->error;
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
