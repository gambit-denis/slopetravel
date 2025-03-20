<?php
// Get the flight ID from the URL
if (isset($_GET['flightid'])) {
    $flightid = filter_var($_GET['flightid'], FILTER_SANITIZE_NUMBER_INT);

    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     // Update query
     $query = "UPDATE FLIGHTS SET ISDELETED = 1, DELETEDATE = NOW() WHERE FLIGHTID = ?";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $flightid); // "i" for integer

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the customer list page after successful deletion
            header("Location: https://slopetravel.com/adminflights.php");
            exit;
        } else {
            echo "Error deleting flight: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    echo "No flight ID provided.";
}
?>
