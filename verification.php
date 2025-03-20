<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Validation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4caf50, #81c784);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .validation-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
        }

        .validation-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .validation-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .validation-container button {
            width: 100%;
            padding: 10px;
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .validation-container button:hover {
            background: #388e3c;
        }
    </style>
</head>
<body>
    <h1>Email Verification</h1>
    <form action="verify_code.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="code">Verification Code:</label>
        <input type="text" id="code" name="code" required>
        <br>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
