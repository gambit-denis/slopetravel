<?php
// Get the airline ID from the URL
if (isset($_GET['airlineid'])) {
    $airlineid = filter_var($_GET['airlineid'], FILTER_SANITIZE_NUMBER_INT);

    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Update query
    $query = "UPDATE AIRLINES SET ISDELETED = 1, DELETEDATE = NOW() WHERE AIRLINEID = ?";


    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $airlineid); // "i" for integer

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the customer list page after successful deletion
            header("Location: https://slopetravel.com/adminairlines.php");
            exit;
        } else {
            echo "Error deleting airline: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    echo "No airline ID provided.";
}
?>
