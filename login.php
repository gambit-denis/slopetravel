<?php
// Start the session
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$config_path = __DIR__ . '/exec/db_config.php'; // Update path to the correct location
if (file_exists($config_path)) {
    $config = include($config_path);
} else {
    die("Database config file not found.");
}

// Check if $config is valid
if (!isset($config['servername'], $config['username'], $config['password'], $config['dbname'])) {
    die("Database configuration is incomplete.");
}

// Create a connection using the configuration array
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check the database connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // SQL query to retrieve the user
    $sql = "SELECT * FROM USERS WHERE EMAIL = '$email'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, fetch user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['PASSWORD'])) {
            // Successful login, set session variables
            $_SESSION['userid'] = $user['USERID'];
            $_SESSION['username'] = $user['USERNAME'];

            if ($user['ISADMIN'] == 1) {
                // Redirect to admin home with userid
                header("Location: adminhome.php?userid=" . $user['USERID']);
            } else {
                // Redirect to user home with userid
                header("Location: userhome.php?userid=" . $user['USERID']);
            }            
            exit; // Ensure no further code is executed
        } else {
            // Invalid password
            $error_message = "Fjalëkalim i gabuar!";
        }
    } else {
        // User not found
        $error_message = "Nuk u gjet asnje përdorues me atë email!";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlopeTravel Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #4caf50, #81c784); /* Travel-inspired green gradient */
        }

        .login-container {
            width: 80%;
            max-width: 800px;
            display: flex;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .form-section {
            flex: 1;
            background: #ffffff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-section input[type="email"],
        .form-section input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-section button {
            background: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-section button:hover {
            background: #388e3c;
        }

        .form-section .social-login {
            margin-top: 20px;
            text-align: center;
        }

        .form-section .social-login a {
            margin: 0 10px;
            font-size: 20px;
            color: #555;
            text-decoration: none;
        }

        .info-section {
            flex: 1;
            background: #81c784; /* Soft green */
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .info-section h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .info-section p {
            font-size: 16px;
            line-height: 1.5;
        }

        .info-section a {
            margin-top: 20px;
            display: inline-block;
            color: white;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="form-section">
            <h1>Autentifikimi</h1>
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Fjalëkalimi" required>
                <button type="submit">Kyqu</button>
            </form>

            <?php
            // Display error message if there's an error
            if (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>

            <div class="social-login">
                <p>apo kyqu me</p>
                <a onclick="notifyUnavailable()"><img src="https://img.icons8.com/color/24/google-logo.png" alt="Google"></a>
            </div>
        </div>

        <div class="info-section">
            <h2>Mirësevini!</h2>
            <p>We are thrilled to have you explore the world with us again. Let’s create memories together!</p>
            <a href="register.php">Nuk kam llogari? Regjistrohu.</a>
        </div>
    </div>
    <script>
            function notifyUnavailable() {
              alert("Kjo veçori nuk është ende e disponueshme!");
            }
        </script>
</body>
</html>
