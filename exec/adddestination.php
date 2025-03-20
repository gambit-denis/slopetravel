<?php
// Include database configuration
$config = include('db_config.php');

// Establish a connection to the database
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $countryId = $conn->real_escape_string($_POST['countryid']);
    $startDate = $conn->real_escape_string($_POST['dateofbirth']);
    $iata = $conn->real_escape_string($_POST['iata']);
    $identifier = $conn->real_escape_string($_POST['destinationName']);
    $stateId = $conn->real_escape_string($_POST['stateid']);

    // Prepare and execute the SQL query
    $sql = "INSERT INTO SlopeTravelDB.CITIES (COUNTRYID, STARTDATE, IATA, IDENTIFIER, STATEID) VALUES (?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("isssi", $countryId, $startDate, $iata, $identifier, $stateId);
        if ($stmt->execute()) {
            echo "<script>alert('Destinacioni u shtua me sukses!');</script>";
            header("Location: https://slopetravel.com/admindestinations.php");
             exit;
        } else {
            echo "<script>alert('Gabim gjate shtimit: " . $stmt->error . "'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Gabim gjate pergatitjes se pyetjes: " . $conn->error . "'); window.history.back();</script>";
    }
}

$conn->close();
?>
