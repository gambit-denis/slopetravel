<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destination - SlopeTravel Admin</title>
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

        .menu .logoutbtn {
            color: #e74c3c;
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

        table {
            width:100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            font-size: 1rem;
            color: #2c3e50;
        }

        table th {
            background-color: #3498db;
            color: white;
            font-weight: 700;
        }

        table tr:nth-child(even) {
            background-color: #ecf0f1;
        }

        table tr:hover {
            background-color: #f2f2f2;
        }

        table td {
            border-bottom: 1px solid #ddd;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            background-color: #f39c12;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            border: none;
            transition: background-color 0.3s ease-in-out;
        }

        .edit-btn:hover {
            background-color: #e67e22;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .delete-btn:hover {
            background-color: #c0392b;
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

            table th, table td {
                font-size: 0.9rem;
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
        <div class="form-container">
            <h2>Ndryshimi i Destinacionit</h2>
            <?php
            if (!isset($_GET['cityid'])) {
                echo "<p>Error: No city selected for editing.</p>";
                exit;
            }

            $cityID = intval($_GET['cityid']);
            $config = include('exec/db_config.php');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $query = "SELECT CITYID, IDENTIFIER, STARTDATE, IATA, COUNTRYID, STATEID FROM CITIES WHERE CITYID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $cityID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                echo "<p>Error: Destinacioni not found.</p>";
                exit;
            }

            $destination = $result->fetch_assoc();
            ?>
            <form id="editDestinationForm" action="exec/editdestination.php" method="POST">
                <input type="hidden" name="destinationID" value="<?php echo $destination['CITYID']; ?>">

                <div style="margin-bottom: 15px;">
                    <label for="destinationName">Destinacioni:</label><br>
                    <input type="text" id="destinationName" name="destinationName" value="<?php echo $destination['IDENTIFIER']; ?>" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="dateofbirth">Ne dispozicion prej:</label><br>
                    <input type="date" id="dateofbirth" name="dateofbirth" value="<?php echo $destination['STARTDATE']; ?>" required style="width: 100%; padding: 8px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="iata">IATA:</label><br>
                    <input type="text" id="iata" name="iata" value="<?php echo $destination['IATA']; ?>" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                <div style="margin-bottom: 15px;">
                    <label for="countryid">Shteti:</label><br>
                    <select id="countryid" name="countryid" required style="width: 100%; padding: 8px;">
                        <option value="" disabled>Perzgjedh shtetin</option>
                        <?php
                        $query = "SELECT COUNTRYID, IDENTIFIER FROM COUNTRIES ORDER BY IDENTIFIER;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            $selected = ($row['COUNTRYID'] == $destination['COUNTRYID']) ? "selected" : "";
                            echo "<option value='" . $row['COUNTRYID'] . "' $selected>" . $row['IDENTIFIER'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="stateid">Statusi:</label><br>
                    <select id="stateid" name="stateid" required style="width: 100%; padding: 8px;">
                        <option value="" disabled>Perzgjedh Statusin</option>
                        <?php
                        $query = "SELECT STATEID, IDENTIFIER FROM STATES WHERE STATEID IN (1, 2) ORDER BY IDENTIFIER;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            $selected = ($row['STATEID'] == $destination['STATEID']) ? "selected" : "";
                            echo "<option value='" . $row['STATEID'] . "' $selected>" . $row['IDENTIFIER'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="add-btn">
                    <i class="fa fa-save"></i> Ruaj Ndryshimet
                </button>
                <button type="button" class="add-btn" onclick="window.location.href='admindestinations.php'">
                    <i class="fa fa-times"></i> Anulo
                </button>
            </form>
        </div>
    </div>
</body>
</html>
