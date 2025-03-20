<?php
// Get the customer ID from the URL
if (isset($_GET['customerid'])) {
    $customerid = filter_var($_GET['customerid'], FILTER_SANITIZE_NUMBER_INT);

    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete query
    $query = "DELETE FROM CUSTOMER WHERE CUSTOMERID = ?";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $customerid); // "i" for integer

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the customer list page after successful deletion
            header("Location: https://slopetravel.com/admincustomers.php");
            exit;
        } else {
            echo "Error deleting customer: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    echo "No customer ID provided.";
}
?>
