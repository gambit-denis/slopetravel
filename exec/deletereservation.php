<?php
// Get the reservation ID from the URL
if (isset($_GET['reservationid'])) {
    $reservationid = filter_var($_GET['reservationid'], FILTER_SANITIZE_NUMBER_INT);

    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update query
    $query = "UPDATE RESERVATIONS SET ISDELETED = ?, DELETEDATE = ? WHERE reservationid = ?";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($query)) {
        $isDelete = 1; // Set ISDELETE to 1 for deletion
        $deleteDate = date('Y-m-d H:i:s'); // Current date and time
        $stmt->bind_param("isi", $isDelete, $deleteDate, $reservationid); // "i" for integer, "s" for string

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the customer list page after successful update
            header("Location: https://slopetravel.com/adminbookings.php");
            exit;
        } else {
            echo "Error updating reservation: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    echo "No reservation ID provided.";
}
?>
