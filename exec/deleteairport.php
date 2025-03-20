<?php
// Get the airport ID from the URL
if (isset($_GET['airportid'])) {
    $airportid = filter_var($_GET['airportid'], FILTER_SANITIZE_NUMBER_INT);

    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update query
    $query = "UPDATE AIRPORTS SET ISDELETED = 1, DELETEDATE = NOW() WHERE AIRPORTID = ?";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $airportid); // "i" for integer

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the airport list page after successful update
            header("Location: https://slopetravel.com/adminairports.php");
            exit;
        } else {
            echo "Error updating airport: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    echo "No airport ID provided.";
}
?>
