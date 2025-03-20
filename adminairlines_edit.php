<?php
// Start session and initialize error message
session_start();
$error_message = "";
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

// Get airlineid from the query string
$airlineid = isset($_GET['airlineid']) ? intval($_GET['airlineid']) : 0;

// Fetch airline details from the database
$config = include('exec/db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Handle connection errors
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM AIRLINES WHERE AIRLINEID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $airlineid);
$stmt->execute();
$result = $stmt->get_result();
$airline = $result->fetch_assoc();

if (!$airline) {
    die("Airline not found or invalid ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlopeTravel - Përditësimi i Linjes Ajrore</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f7fa;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        body {
    font-family: 'Arial', sans-serif !important;
    background-color: #f5f7fa !important;
}

        .dashboard {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .menu {
            background: #2c3e50;
            padding: 20px;
            width: 20%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: #fff;
            overflow-y: auto;
        }

        .menu h3 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            text-align: center;
        }

        .menu a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #ecf0f1;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #34495e;
        }

        .menu a .fa {
            margin-right: 10px;
        }

        .form-container {
            background-color: #fff;
            flex-grow: 1;
            padding: 30px;
            overflow-y: auto;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container h2 {
            font-size: 1.75rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .add-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
        }

        .add-btn:hover {
            background-color: #2980b9;
        }

        .add-btn i {
            margin-right: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #error-message {
            color: red;
            font-weight: bold;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
                height: auto;
            }

            .menu {
                width: 100%;
                padding: 15px;
            }

            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<p id="error-message"><?php echo htmlspecialchars($error_message); ?></p>
<div class="dashboard">
<div class="menu">
            <h3>Admin Menu</h3>
            <a href="adminhome.php" id="cities-list"><i class="fa fa-pie-chart"></i> Ballina</a>
            <a href="admindestinations.php" id="destinations-list"><i class="fa fa-city"></i> Destinacionet</a>
            <a href="adminairports.php" id="airport-list"><i class="fa fa-map-marker-alt"></i> Aeroportet</a>
            <a href="adminairlines.php" id="airline-list"><i class="fa fa-plane"></i> Linjat ajrore</a>
            <a href="adminflights.php" id="flights-list"><i class="fa fa-plane-departure"></i> Fluturimet</a>
            <a href="adminhotels.php" id="hotel-list"><i class="fa fa-hotel"></i> Akomodimet</a>
            <a href="adminbookings.php" id="bookings-list"><i class="fa fa-book"></i> Rezervimet</a>
            <a href="adminoffers.php" id="offers-list"><i class="fa fa-tags"></i> Ofertat</a>
            <a href="admincustomers.php" id="client-list"><i class="fa fa-users"></i> Klientët</a>
            <a href="admininvoices.php" id="invoice-list"><i class="fa fa-file-invoice"></i> Faturat</a>
            <a href="adminincomes.php"><i class="fa fa-credit-card"></i> Arkëtimet</a>
            <a href="adminpayments.php" id="payment-list"><i class="fa fa-bank"></i> Pagesat</a>
            <a href="adminincident.php" id="incident"><i class="fa fa-exclamation-triangle"></i> Incidentet</a>
            <a href="adminreports.php" id="reports-list"><i class="fa fa-balance-scale"></i> Raportet</a>
            <a href="adminconfigurations.php" id="configurations"><i class="fa fa-cogs"></i> Konfigurime</a>
            <a href="login.php" class="logoutbtn" id="logout"><i class="fa fa-sign-out-alt"></i> Shkyqu</a>
        </div>
    <div class="form-container" id="form-container">
        <h2>Përditësimi i Linjes Ajrore</h2>
        <form action="exec/editairline.php" method="POST">
            <input type="hidden" name="airlineid" value="<?php echo htmlspecialchars($airlineid); ?>">

            <div>
                <label for="airlinename">Emri i Linjes:</label>
                <input type="text" id="airlinename" name="airlinename" required value="<?php echo htmlspecialchars($airline['AIRLINENAME']); ?>">
            </div>
            <div>
                <label for="legalname">Emri Ligjor:</label>
                <input type="text" id="legalname" name="legalname" required value="<?php echo htmlspecialchars($airline['LEGALNAME']); ?>">
            </div>
            <div>
                <label for="iata">IATA:</label>
                <input type="text" id="iata" name="iata" required maxlength="4" value="<?php echo htmlspecialchars($airline['IATA']); ?>">
            </div>
            <div>
                <label for="icao">ICAO:</label>
                <input type="text" id="icao" name="icao" required maxlength="4" value="<?php echo htmlspecialchars($airline['ICAO']); ?>">
            </div>
            <div>
                <label for="website">Website:</label>
                <input type="text" id="website" name="website" required value="<?php echo htmlspecialchars($airline['WEBSITE']); ?>">
            </div>
            <div>
                <label for="stateid">Statusi:</label>
                <select id="stateid" name="stateid" required>
                    <option value="" disabled>Perzgjedh Statusin</option>
                    <?php
                    $query = "SELECT STATEID, IDENTIFIER FROM STATES WHERE STATEID IN (1, 2) ORDER BY 1;";
                    $states_result = $conn->query($query);
                    while ($row = $states_result->fetch_assoc()) {
                        $selected = $row['STATEID'] == $airline['STATEID'] ? "selected" : "";
                        echo "<option value='" . $row['STATEID'] . "' $selected>" . $row['IDENTIFIER'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="add-btn">
                <i class="fa fa-save"></i> Përditëso
            </button>
            <button type="button" class="add-btn" onclick="window.location.href='adminairlines.php'">
                <i class="fa fa-times"></i> Anulo
            </button>
        </form>
    </div>
</div>
</body>
</html>
