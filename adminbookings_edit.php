<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlopeTravel Admin Dashboard - Hotels</title>
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
        <h2>Përditesimi i Rezervimit</h2>
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
            $reservationid = $_GET['reservationid'];

            // Fetch the flight details from the database
            $query = "SELECT * FROM RESERVATIONS WHERE RESERVATIONID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $reservationid);
            $stmt->execute();
            $result = $stmt->get_result();
            $reservation = $result->fetch_assoc();

            if ($reservation) {
                ?>
        <form action="exec/editreservation.php" method="POST">
        <input type="hidden" name="reservationid" value="<?php echo $reservation['RESERVATIONID']; ?>">
        <div style="display: flex; align-items: center; gap: 20px;">
            
        <div style="display: flex; align-items: center; gap: 20px;">
                <div>
            <label for="accommodationid">Akomodimi:</label>
            <select id="accommodationid" name="accommodationid" required>
                <option value="" disabled>Zgjidh akomodimin</option>
                <?php
               $query = "SELECT ACCOMMODATIONID, IDENTIFIER FROM ACCOMMODATIONS ORDER BY IDENTIFIER;";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    $selected = $row['ACCOMMODATIONID'] == $reservation['ACCOMMODATIONID'] ? 'selected' : '';
                    echo "<option value='" . $row['ACCOMMODATIONID'] . "'>" . $row['IDENTIFIER'] . "</option>";
                }
                ?>
            </select>
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
            <label for="roomtypeid">Lloji i dhomës:</label>
            <select id="roomtypeid" name="roomtypeid" required>
                <option value="" disabled>Zgjidh llojin e dhomës</option>
                <?php
                $query = "SELECT ROOMTYPEID, IDENTIFIER FROM ROOMTYPES ORDER BY IDENTIFIER;";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    $selected = $row['ROOMTYPEID'] == $reservation['ROOMTYPEID'] ? 'selected' : '';
                    echo "<option value='" . $row['ROOMTYPEID'] . "' $selected>" . $row['IDENTIFIER'] . "</option>";
                }
                ?>
            </select>
        </div>
                <div>
            <label for="guests">Nr. Mysafireve:</label>
            <input type="number" id="guests" name="guests" value="<?php echo $reservation['GUESTS']; ?>" required>
        </div>
                </div>
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
                    <label for="startdate">Check-In:</label>
                    <input type="datetime-local" id="startdate" name="startdate" value="<?php echo $reservation['STARTDATE']; ?>" required>
                </div>
                <div>
                    <label for="enddate">Check-Out:</label>
                    <input type="datetime-local" id="enddate" name="enddate" value="<?php echo $reservation['ENDDATE']; ?>" required>
                </div>
                </div>
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
        <label for="startprice">Çmimi Fillestar:</label>
        <label for="startprice"><?php echo number_format($reservation['STARTPRICE'], 2); ?></label>
    </div>
                <div>
                    <label for="actualprice">Çmimi Aktual:</label>
                    <input type="number" step="0.01" id="actualprice" name="actualprice" value="<?php echo $reservation['ACTUALPRICE']; ?>"  required>
                </div>
                <div>
                    <label for="taxamount">Taksa shtese:</label>
                    <input type="number" step="0.01" id="taxamount" name="taxamount" value="<?php echo $reservation['ACCOMODATIONTAX']; ?>" required>
                </div>
                </div>
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
        <label for="stateid">Statusi:</label>
        <select id="stateid" name="stateid" required>
            <option value="" disabled>Perzgjedh statusin</option>
            <?php while ($row = $statesResult->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['STATEID']); ?>" <?php echo $row['STATEID'] == $reservation['STATEID'] ? 'selected' : ''; ?>                >
                    <?php echo htmlspecialchars($row['IDENTIFIER']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
                </div>
                <div>
                    <label for="website">Linku i Akomodimit:</label>
                    <input type="text" id="website" name="website" value="<?php echo $reservation['WEBSITE']; ?>" required>
                </div>
                <button type="submit" class="add-btn">
                    <i class="fa fa-save"></i> Ndrysho
                </button>
                <button type="button" class="add-btn" onclick="window.location.href='adminbookings.php'">
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
