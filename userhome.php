<?php
// Start the session
session_start();

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home - SlopeTravel</title>
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

        .container {
            width: 90%;
            max-width: 800px;
            background-color: white;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .container h1 {
            font-size: 32px;
            color: #333;
        }

        .coming-soon {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .logout-button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4caf50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #388e3c;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to SlopeTravel!</h1>
        <p class="coming-soon">Coming Soon! We're working hard to bring exciting features to you.</p>
        <a href="?logout=true"><button class="logout-button">Logout</button></a>
    </div>
</body>
</html>
