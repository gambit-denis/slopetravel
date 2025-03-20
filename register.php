<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlopeTravel Register</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #4caf50, #81c784);
        }

        .register-container {
            width: 90%;
            max-width: 600px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background: white;
            display: flex;
            flex-direction: column;
        }

        .form-section {
            padding: 40px;
        }

        .form-section h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-section input[type="text"],
        .form-section input[type="email"],
        .form-section input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
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

        .info-section {
            background: #81c784;
            color: white;
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

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .tnc_agree {
            display: inline-block;
        }

        .notify_agree{
            display: inline-block;
        }

        .error-message {
        background: #ffdddd;
        border: 1px solid #ff5c5c;
        color: #d8000c;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 4px;
    }

        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="form-section">
            <form action="exec/register.php" method="POST">
            <h1>Krijo llogari</h1>
             <!-- Display the error message if provided -->
             <?php if (isset($_GET['error'])): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars(urldecode($_GET['error'])); ?>
                    </div>
                <?php endif; ?>
            <input type="text" name="username" placeholder="Përdoruesi" required>
            <input type="password" name="password" placeholder="Fjalëkalimi" required>
            <input type="password" name="confirm_password" placeholder="Konfirmo fjalëkalimin" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="contact" placeholder="Kontakti" required>
            <div>
                <select id="countryid" name="countryid" required>
                    <option value="" disabled selected>Perzgjedh shtetin</option>
                    <?php
                    $config = include('exec/db_config.php');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                    $query = "SELECT COUNTRYID, IDENTIFIER FROM COUNTRIES";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['COUNTRYID'] . "'>" . $row['IDENTIFIER'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <label>
                <input type="checkbox" name="tnc_agree" value="1" required> Pranoj Termat dhe Kushtet
            </label>
            <label>
                <input type="checkbox" name="notify_agree" value="1"> Dëshiroj të marr njoftime
            </label>
            <button type="submit">Abonohu</button>
        </div>
    </form>
        <div class="info-section">
            <h2>Udhëto nga sot me SlopeTravel!</h2>
            <p>Filloni udhëtimin tuaj me ne dhe eksploroni botën. Aventura juaj e ardhshme është vetëm një klik larg!</p>
            <a href="login.php">Tashmë kam llogari? Kyqu.</a>
        </div>
    </div>
</body>
</html>
