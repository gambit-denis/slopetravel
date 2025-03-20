<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlopeTravel - Perditesimi i Fluturimit</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Reuse existing styles */
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
        .menu .logoutbtn {
            color: #e74c3c;
        }

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
            <h2>Përditësimi i Fluturimit</h2>
            <?php
            // Connect to the database
            $config = include('exec/db_config.php');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Fetch states
            $statesQuery = "SELECT STATEID, IDENTIFIER FROM STATES where STATEID in (1,2) ORDER BY IDENTIFIER;"; // Adjust as necessary
            $statesResult = $conn->query($statesQuery);
            // Get the flight ID from the query string
            $flightid = $_GET['flightid'];

            // Fetch the flight details from the database
            $query = "SELECT * FROM FLIGHTS WHERE FLIGHTID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $flightid);
            $stmt->execute();
            $result = $stmt->get_result();
            $flight = $result->fetch_assoc();

            if ($flight) {
            ?>
            <form action="exec/editflight.php" method="POST">
                <input type="hidden" name="flightid" value="<?php echo $flight['FLIGHTID']; ?>">
                <div style="display: flex; align-items: center; gap: 20px;">
    <div>
        <label for="flightnumber">Numri i Fluturimit:</label>
        <input type="text" id="flightnumber" name="flightnumber" value="<?php echo $flight['FLIGHTNUMBER']; ?>" required>
    </div>
    <div>
        <label for="airlineid">Linja Ajrore:</label>
        <select id="airlineid" name="airlineid" required>
            <option value="" disabled>Zgjidh Linjën Ajrore</option>
            <?php
            $query = "SELECT AIRLINEID, AIRLINENAME FROM AIRLINES ORDER BY AIRLINENAME;";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                $selected = $row['AIRLINEID'] == $flight['AIRLINEID'] ? 'selected' : '';
                echo "<option value='" . $row['AIRLINEID'] . "' $selected>" . $row['AIRLINENAME'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div>
                    <label for="flightlink">Linku i Fluturimit:</label>
                    <input type="text" id="flightlink" name="flightlink" value="<?php echo $flight['WEBSITE']; ?>" required>
                </div>
</div>

               
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
                    <label for="departureairportid">Aeroporti i Nisjes:</label>
                    <select id="departureairportid" name="departureairportid" required>
                        <option value="" disabled>Zgjidh Aeroportin</option>
                        <?php
                        $query = "SELECT ap.AIRPORTID, CONCAT('(', cc.IDENTIFIER, ') ', ap.AIRPORTNAME) AS AIRPORTNAME FROM AIRPORTS ap JOIN CITIES cc ON cc.CITYID = ap.CITYID ORDER BY 2;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            $selected = $row['AIRPORTID'] == $flight['DEPARTUREAIRPORTID'] ? 'selected' : '';
                            echo "<option value='" . $row['AIRPORTID'] . "' $selected>" . $row['AIRPORTNAME'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
    <div>
        <label for="departureflightdate">Data e Nisjes:</label>
        <input type="date" id="departureflightdate" name="departureflightdate" value="<?php echo date('Y-m-d', strtotime($flight['DEPARTUREFLIGHTDATE'])); ?>" required>
    </div>
    <div>
        <label for="departureflighttime">Ora e Nisjes:</label>
        <input type="time" id="departureflighttime" name="departureflighttime" value="<?php echo date('H:i', strtotime($flight['DEPARTUREFLIGHTTIME'])); ?>" required>
    </div>
</div>


              
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
                    <label for="arrivalairportid">Aeroporti i Mbërritjes:</label>
                    <select id="arrivalairportid" name="arrivalairportid" required>
                        <option value="" disabled>Zgjidh Aeroportin</option>
                        <?php
                        $query = "SELECT ap.AIRPORTID, CONCAT('(', cc.IDENTIFIER, ') ', ap.AIRPORTNAME) AS AIRPORTNAME FROM AIRPORTS ap JOIN CITIES cc ON cc.CITYID = ap.CITYID ORDER BY 2;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            $selected = $row['AIRPORTID'] == $flight['ARRIVALAIRPORTID'] ? 'selected' : '';
                            echo "<option value='" . $row['AIRPORTID'] . "' $selected>" . $row['AIRPORTNAME'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
    <div>
        <label for="arrivalflightdate">Data e Mbërritjes:</label>
        <input type="date" id="arrivalflightdate" name="arrivalflightdate" value="<?php echo date('Y-m-d', strtotime($flight['ARRIVALFLIGHTDATE'])); ?>" required>
    </div>
    <div>
        <label for="arrivalflighttime">Ora e Mbërritjes:</label>
        <input type="time" id="arrivalflighttime" name="arrivalflighttime" value="<?php echo date('H:i', strtotime($flight['ARRIVALFLIGHTTIME'])); ?>" required>
    </div>
</div>
<div style="display: flex; align-items: center; gap: 20px;">
    <div>
        <label for="startprice">Çmimi Fillestar:</label>
        <label for="startprice"><?php echo number_format($flight['STARTPRICE'], 2); ?></label>
    </div>
    <div>
        <label for="actualprice">Çmimi Aktual:</label>
        <input type="number" step="0.01" id="actualprice" name="actualprice" value="<?php echo number_format($flight['ACTUALPRICE'], 2); ?>" required>
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
</div>
<div style="margin-bottom: 10px;">
        <label for="registerdate">Regjistrimi Fillestar:</label>
        <label for="registerdate"><?php echo date('Y-m-d H:i', strtotime($flight['REGISTERDATE'])); ?></label>
    </div>
    <div style="margin-top: 10px; margin-bottom: 10px;">
        <label for="lastupdate">Përditësimi i Fundit:</label>
        <label for="lastupdate"><?php echo date('Y-m-d H:i', strtotime($flight['LASTUPDATE'])); ?></label>
    </div>
                <button type="submit" class="add-btn">
                    <i class="fa fa-save"></i> Ruaj
                </button>
                <button type="button" class="add-btn" onclick="window.location.href='adminflights.php'">
                    <i class="fa fa-times"></i> Anulo
                </button>
            </form>
            <?php
            } else {
                echo "<p>Fluturimi nuk u gjet.</p>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
