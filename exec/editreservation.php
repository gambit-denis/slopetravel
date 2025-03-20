<?php
// Include the database configuration
$config = include('db_config.php');

// Establish the connection to the database
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $reservationid = $_POST['reservationid'];
    echo "Reservation ID: " . $reservationid . "<br>";  // Debugging line
    $accommodationid = isset($_POST['accommodationid']) ? $_POST['accommodationid'] : null;
    $roomtypeid = isset($_POST['roomtypeid']) ? $_POST['roomtypeid'] : null;
    $guests = isset($_POST['guests']) ? $_POST['guests'] : null;
    $checkindate = isset($_POST['startdate']) ? date('Y-m-d H:i:s', strtotime($_POST['startdate'])) : null;
    $checkoutdate = isset($_POST['enddate']) ? date('Y-m-d H:i:s', strtotime($_POST['enddate'])) : null;    
    $actualprice = isset($_POST['actualprice']) ? $_POST['actualprice'] : null;
    $taxamount = isset($_POST['taxamount']) ? $_POST['taxamount'] : null;
    $stateid = isset($_POST['stateid']) ? $_POST['stateid'] : null;
    $website = isset($_POST['website']) ? $_POST['website'] : null;
    $lastupdate = date('Y-m-d H:i:s');

     // Echo the values to debug
     echo "Accommodation ID: " . $accommodationid . "<br>";
     echo "Room Type ID: " . $roomtypeid . "<br>";
     echo "Guests: " . $guests . "<br>";
     echo "Check-in Date: " . $checkindate . "<br>";
     echo "Check-out Date: " . $checkoutdate . "<br>";
     echo "Actual Price: " . $actualprice . "<br>";
     echo "Tax Amount: " . $taxamount . "<br>";
     echo "State ID: " . $stateid . "<br>";
     echo "Website: " . $website . "<br>";
     echo "Last Update: " . $lastupdate . "<br>";

    if ($accommodationid && $roomtypeid && $guests && $checkindate && $checkoutdate && $actualprice && $taxamount && $stateid && $website) {
        // Proceed with updating the reservation
    } else {
        die("Missing required form data.");
    }

    // Prepare the SQL query to update the reservation
    $query = "UPDATE RESERVATIONS SET 
                ACCOMMODATIONID = ?, 
                ROOMTYPEID = ?, 
                GUESTS = ?, 
                STARTDATE = ?, 
                ENDDATE = ?, 
                ACTUALPRICE = ?, 
                ACCOMODATIONTAX = ?, 
                STATEID = ?, 
                WEBSITE = ?,
                LASTUPDATE = ?
              WHERE RESERVATIONID = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameters to the query
        $stmt->bind_param("iidssddissi", 
            $accommodationid, 
            $roomtypeid, 
            $guests, 
            $checkindate, 
            $checkoutdate, 
            $actualprice, 
            $taxamount, 
            $stateid, 
            $website, 
            $lastupdate,
            $reservationid
            );

        // Execute the query
        if ($stmt->execute()) {
            echo "Reservation has been successfully updated.";
            header("Location: https://slopetravel.com/adminbookings.php");
            exit();
        } else {
            $errorMessage = "Error updating record: " . $stmt->error;
            file_put_contents('error_log.txt', date('Y-m-d H:i:s') . ' - ' . $errorMessage . "\n", FILE_APPEND);
            echo $errorMessage;
        }        
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
