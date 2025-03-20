<?php
// Get the accommodation ID from the URL
if (isset($_GET['accommodationid'])) {
    $accommodationid = filter_var($_GET['accommodationid'], FILTER_SANITIZE_NUMBER_INT);

    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update query
    $query = "UPDATE ACCOMMODATIONS SET ISDELETED = 1, DELETEDATE = NOW() WHERE ACCOMMODATIONID = ?";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $accommodationid); // "i" for integer

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the customer list page after successful deletion
            header("Location: https://slopetravel.com/adminhotels.php");
            exit;
        } else {
            echo "Error deleting accommodation: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "No accommodation ID provided.";
}
?>
