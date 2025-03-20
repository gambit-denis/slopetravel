<?php
// Get the city ID from the URL
if (isset($_GET['cityid'])) {
    $cityid = filter_var($_GET['cityid'], FILTER_SANITIZE_NUMBER_INT);

    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update query
    $query = "UPDATE CITIES SET ISDELETED = 1, DELETEDATE = NOW() WHERE CITYID = ?";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $cityid); // "i" for integer

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the customer list page after successful update
            header("Location: https://slopetravel.com/admindestinations.php");
            exit;
        } else {
            echo "Error updating destination: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    echo "No city ID provided.";
}
?>
