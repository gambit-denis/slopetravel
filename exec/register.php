<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = include(__DIR__ . '/db_config.php');

$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $countryid = intval($_POST['countryid']);
    $stateid = 1; 
    $tnc_agree = isset($_POST['tnc_agree']) ? 1 : 0;
    $notify_agree = isset($_POST['notify_agree']) ? 1 : 0;

    $email_check_sql = "SELECT * FROM USERS WHERE EMAIL = '$email'";
    $result = $conn->query($email_check_sql);
    if ($result->num_rows > 0) {
        header("Location: /register.php?error=" . urlencode("Email tashmë ekziston!"));
        exit;
    }

    $username_check_sql = "SELECT * FROM USERS WHERE USERNAME = '$username'";
    $result = $conn->query($username_check_sql);
    if ($result->num_rows > 0) {
        header("Location: /register.php?error=" . urlencode("Përdoruesi tashmë ekziston!"));
        exit;
    }

    if ($password !== $confirm_password) {
        header("Location: /register.php?error=" . urlencode("Fjalëkalimet nuk përputhen!"));
        exit;
    }
    
    if (strlen($password) < 8) {
        header("Location: /register.php?error=" . urlencode("Fjalëkalimi duhet të jetë minimumi 8 karaktere."));
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO USERS (USERNAME, PASSWORD, EMAIL, CONTACT, COUNTRYID, STATEID, TNCAGREEMENT, NOTIFYAGREE) 
            VALUES ('$username', '$hashed_password', '$email', '$contact', $countryid, $stateid, $tnc_agree, $notify_agree)";

    if ($conn->query($sql) === TRUE) {
        $verification_code = rand(100000, 999999);

        $user_id = $conn->insert_id; 
        $conn->query("UPDATE USERS SET VERIFICATION_CODE = '$verification_code' WHERE USERID = $user_id");

       // require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
       // require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';
       // require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';

        //$mail = new \PHPMailer\PHPMailer\PHPMailer(true);

       // try {
           // $mail->isSMTP();
           // $mail->Host = 'smtp.gmail.com';
            //$mail->SMTPAuth = true;
           // $mail->Username = 'denisquka60@gmail.com'; // Your Gmail address
           // $mail->Password = 'exkn zzym pypo zpoi';   // Your Gmail App Password
           // $mail->SMTPSecure = 'ssl'; // Use 'ssl' for port 465, 'tls' for port 587
           // $mail->Port = 465; // SSL port            

           // $mail->setFrom('denisquka69@gmail.com', 'SlopeTravel');
           // $mail->addAddress($email); // Send the verification email to the user

           // $mail->Subject = 'SlopeTravel Email Verification';
           // $mail->Body    = "Dear $username,\n\nThank you for registering with SlopeTravel!\n\nYour verification code is: $verification_code\n\nPlease enter this code to verify your account.";

            // Send the email
           // $mail->send();
            // Redirect to verification page before echoing anything
            header("Location: https://slopetravel.com/login.php");
            //header("Location: https://slopetravel.com/verification.php");
            exit; // Ensure no further code is executed

       // } catch (\PHPMailer\PHPMailer\Exception $e) {
           //echo "Mailer Error: " . $mail->ErrorInfo;
        //}
    } else {
        die("Error: " . $conn->error);
    }

    // Close the connection
    $conn->close();
}
?>
