<?php
// Include database configuration
$config = include('db_config.php');

// Establish a database connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accommodationId = $_POST['accommodationid'] ?? null;
    $roomTypeId = $_POST['roomtypeid'] ?? null;
    $guests = $_POST['guests'] ?? null;
    $checkInDate = $_POST['checkindate'] ?? null;
    $checkOutDate = $_POST['checkoutdate'] ?? null;
    $startPrice = $_POST['startprice'] ?? null;
    $taxamount = $_POST['taxamount'] ?? null;
    $registerdate = date('Y-m-d H:i:s');
    $lastupdate = date('Y-m-d H:i:s');
    $stateId = $_POST['stateid'];
    $website = $_POST['website'];

    // Ensure all fields are filled out
    if (!$accommodationId || !$roomTypeId || !$guests || !$checkInDate || !$taxamount || !$checkOutDate || !$startPrice || !$website) {
        die("Please fill out all fields.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO RESERVATIONS (ACCOMMODATIONID, ROOMTYPEID, GUESTS, STARTDATE, ENDDATE, STARTPRICE, ACTUALPRICE, ACCOMODATIONTAX, INSERTDATE, LASTUPDATE, STATEID, WEBSITE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("iidssdddssis", $accommodationId, $roomTypeId, $guests, $checkInDate, $checkOutDate, $startPrice, $startPrice, $taxamount, $registerdate, $lastupdate, $stateId, $website);

    // Execute the query
    if ($stmt->execute()) {
        echo "New reservation has been successfully added.";
        header("Location: https://slopetravel.com/adminbookings.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
