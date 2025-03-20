<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $config = include('db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the update query
    $query = "UPDATE CUSTOMER SET 
              FIRSTNAME = ?, 
              LASTNAME = ?, 
              DATEOFBIRTH = ?, 
              IDENTITYNUMBER = ?, 
              COUNTRYID = ?, 
              CITYID = ?, 
              GENDERID = ?, 
              STATEID = ?, 
              CONTACT = ?, 
              EMAIL = ? 
              WHERE CUSTOMERID = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssiiiiiis", 
            $_POST['firstname'], 
            $_POST['lastname'], 
            $_POST['dateofbirth'], 
            $_POST['identitynumber'], 
            $_POST['countryid'], 
            $_POST['cityid'], 
            $_POST['genderid'], 
            $_POST['stateid'], 
            $_POST['contact'], 
            $_POST['email'], 
            $_POST['customerid']); 

        if ($stmt->execute()) {
            // Redirect to the customer list page after updating
            header("Location: https://slopetravel.com/admincustomers.php");
            exit;
        } else {
            echo "Error updating customer: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
