<?php
// Include the database configuration file
$config = include(__DIR__ . '/db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $email = $conn->real_escape_string($_POST['email']);
    $code = intval($_POST['code']);

    // Check if the verification code matches
    $sql = "SELECT * FROM USERS WHERE EMAIL = '$email' AND VERIFICATION_CODE = $code";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update the VERIFIED column to 1
        $update = "UPDATE USERS SET VERIFIED = 1 WHERE EMAIL = '$email'";
        if ($conn->query($update) === TRUE) {
            echo "Verification successful! Your account is now verified.";
            header("Location: https://slopetravel.com/login.php");
        } else {
            echo "Error updating verification status: " . $conn->error;
        }
    } else {
        echo "Invalid verification code or email.";
    }
}

$conn->close();
?>
