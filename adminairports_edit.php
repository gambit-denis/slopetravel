<?php
// Fetch the airport ID from the URL (passed by the 'airportid' parameter)
if (isset($_GET['airportid'])) {
    $airportid = (int) $_GET['airportid']; // Ensure the ID is an integer

    // Database connection
    $config = include('exec/db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch airport data from the database
    $query = "SELECT * FROM AIRPORTS WHERE AIRPORTID = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $airportid);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $airport = $result->fetch_assoc();
        } else {
            die("Airport not found.");
        }

        $stmt->close();
    } else {
        die("Query preparation failed.");
    }

    // Fetch countries, cities, and states
    $countriesQuery = "SELECT COUNTRYID, IDENTIFIER FROM COUNTRIES ORDER BY IDENTIFIER;";
    $countriesResult = $conn->query($countriesQuery);

    $citiesQuery = "SELECT CITYID, IDENTIFIER FROM CITIES ORDER BY IDENTIFIER;";
    $citiesResult = $conn->query($citiesQuery);

    $statesQuery = "SELECT STATEID, IDENTIFIER FROM STATES WHERE STATEID IN (1, 2) ORDER BY IDENTIFIER;";
    $statesResult = $conn->query($statesQuery);

    $conn->close();
} else {
    die("Airport ID not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlopeTravel - Modifikimi i Aeroportit</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Reusing the same styles from adminairports_new */
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
            <h2>Modifikimi i Aeroportit</h2>
            <form action="exec/editairport.php" method="POST">
                <input type="hidden" id="airportid" name="airportid" value="<?php echo htmlspecialchars($airport['AIRPORTID']); ?>" required>
                
                <div>
                    <label for="airportname">Emri i Aeroportit:</label>
                    <input type="text" id="airportname" name="airportname" value="<?php echo htmlspecialchars($airport['AIRPORTNAME']); ?>" required>
                </div>
                <div>
                    <label for="iata">IATA:</label>
                    <input type="text" id="iata" name="iata" value="<?php echo htmlspecialchars($airport['IATA']); ?>" required maxlength="4">
                </div>
                <div>
                    <label for="icao">ICAO:</label>
                    <input type="text" id="icao" name="icao" value="<?php echo htmlspecialchars($airport['ICAO']); ?>" required maxlength="4">
                </div>
                <div>
                    <label for="countryid">Shteti:</label>
                    <select id="countryid" name="countryid" required>
                        <option value="" disabled>Perzgjedh shtetin</option>
                        <?php while ($row = $countriesResult->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($row['COUNTRYID']); ?>" <?php echo $row['COUNTRYID'] == $airport['COUNTRYID'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['IDENTIFIER']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label for="cityid">Qyteti:</label>
                    <select id="cityid" name="cityid" required>
                        <option value="" disabled>Perzgjedh qytetin</option>
                        <?php while ($row = $citiesResult->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($row['CITYID']); ?>" <?php echo $row['CITYID'] == $airport['CITYID'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['IDENTIFIER']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label for="stateid">Statusi:</label>
                    <select id="stateid" name="stateid" required>
                        <option value="" disabled>Perzgjedh statusin</option>
                        <?php while ($row = $statesResult->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($row['STATEID']); ?>" <?php echo $row['STATEID'] == $airport['STATEID'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['IDENTIFIER']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="add-btn"><i class="fa fa-save"></i> Ruaj</button>
                <button type="button" class="add-btn" onclick="window.location.href='adminairports.php'">
    <i class="fa fa-times"></i> Anulo
</button>
            </form>
        </div>
    </div>
</body>
</html>
