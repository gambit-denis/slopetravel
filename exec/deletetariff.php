<?php
// Get the tariff ID from the URL
if (isset($_GET['tariffid'])) {
    $tariffid = filter_var($_GET['tariffid'], FILTER_SANITIZE_NUMBER_INT);

    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update query for soft delete
    $query = "UPDATE TARIFF SET ISDELETED = 1, DELETEDATE = NOW() WHERE TARIFFID = ?";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $tariffid); // "i" for integer

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the customer list page after successful update
            header("Location: https://slopetravel.com/adminoffers.php");
            exit;
        } else {
            echo "Error updating offer: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "No offer ID provided.";
}
?>
