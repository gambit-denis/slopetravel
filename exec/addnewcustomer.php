<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = include('db_config.php');

// Establish the database connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form inputs
$firstname = $conn->real_escape_string($_POST['firstname']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$dateofbirth = $conn->real_escape_string($_POST['dateofbirth']);
$identitynumber = $conn->real_escape_string($_POST['identitynumber']);
$countryid = $conn->real_escape_string($_POST['countryid']);
$cityid = $conn->real_escape_string($_POST['cityid']);
$contact = $conn->real_escape_string($_POST['contact']);
$stateid = $conn->real_escape_string($_POST['stateid']);
$email = $conn->real_escape_string($_POST['email']);
$genderid = $conn->real_escape_string($_POST['genderid']);


// Insert query
$query = "INSERT INTO CUSTOMER (FIRSTNAME, LASTNAME, DATEOFBIRTH, IDENTITYNUMBER, COUNTRYID, CITYID, CONTACT, EMAIL, GENDERID, STATEID)
          VALUES ('$firstname', '$lastname', '$dateofbirth', '$identitynumber', '$countryid', '$cityid', '$contact', '$email', '$genderid', '$stateid')";

if ($conn->query($query) === TRUE) {
    // Success message or redirect
    echo "Klienti u regjistrua me sukses.";
    // Redirect to the customer list
    header("Location: https://slopetravel.com/admincustomers.php");
    exit;
} else {
    // Error handling
    echo "Gabim: " . $query . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
