<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlopeTravel Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .dashboard {
            display: flex;
            width: 100%;
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
            width: 80%;
            padding: 20px;
            overflow-y: auto;
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container form input,
        .form-container form select,
        .form-container form button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container form button {
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-container form button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
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
        
        .web-btn{
            background-color: #2980b9;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            border: none;
            transition: background-color 0.3s ease-in-out;
        }

        .add-btn:hover {
            background-color: #2980b9;
        }

        .add-btn i {
            margin-right: 8px;
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
            <div style="display: inline; justify-content:left; align-items: center; margin-bottom: 10px;">
            <i class="fa fa-plane-departure"></i> 
            <h3>Menaxhimi i Fluturimeve</h3>
            </div>
            <button class="add-btn" onclick="window.location.href='adminflights_new.php';"><i class="fa fa-plus"></i> Shto Fluturim</button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nr.Fluturimit</th>
                        <th>Linja</th>
                        <th>Qytetet</th>
                        <th>Aeroport (Nisja)</th>
                        <th>Data & Ora (Nisja)</th>
                        <th>Aeroport (Mbërritja)</th>
                        <th>Data & Ora (Mbërritja)</th>
                        <th>Ndryshimi i fundit</th>
                        <th>Qmimi Aktual</th>
                        <th>Komandat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // PHP code to fetch and display destinations data
                        ini_set('display_errors', 1);
                        error_reporting(E_ALL);

                        $config = include('exec/db_config.php');
                        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

                        if ($conn->connect_error) {
                            error_log("Connection failed: " . $conn->connect_error);
                            die("Connection failed: " . htmlspecialchars($conn->connect_error));
                        } else {
                            $sql = "
                                SELECT f.FLIGHTID, f.FLIGHTNUMBER, al.AIRLINENAME, CONCAT(dc.IDENTIFIER,' - ',ac.IDENTIFIER) as DEPARTURECITY, 
                                CONCAT(' (', depair.IATA, ') ', depair.AIRPORTNAME) as DEPARTUREAIRPORT,
                                DATE_FORMAT(CONCAT(f.DEPARTUREFLIGHTDATE, ' ', f.DEPARTUREFLIGHTTIME), '%d.%m.%Y %H:%i') as DEPARTURETIME, 
                                CONCAT(' (', arrair.IATA, ') ', arrair.AIRPORTNAME) as ARRIVALAIRPORT, 
                                DATE_FORMAT(CONCAT(f.ARRIVALFLIGHTDATE, ' ', f.ARRIVALFLIGHTTIME), '%d.%m.%Y %H:%i') as ARRIVALTIME,
                                 f.LASTUPDATE, f.ACTUALPRICE, f.WEBSITE FROM FLIGHTS f join AIRPORTS depair on depair.AIRPORTID = f.DEPARTUREAIRPORTID 
                                 join AIRPORTS arrair on arrair.AIRPORTID = f.ARRIVALAIRPORTID 
                                 join CITIES dc on dc.CITYID = depair.CITYID 
                                 join CITIES ac on ac.CITYID = arrair.CITYID 
                                 join AIRLINES al on al.AIRLINEID = f.AIRLINEID where f.ISDELETED = 0 AND f.DEPARTUREFLIGHTDATE > NOW() ORDER BY f.DEPARTUREFLIGHTDATE, f.DEPARTUREFLIGHTTIME;";

                            error_log("SQL Query: " . $sql);
                            $result = $conn->query($sql);

                            if ($result === false) {
                                error_log("Error in query: " . $conn->error);
                                echo "Error executing query.";
                            } else {
                                error_log("Query executed successfully.");
                                echo "Nr. Fluturimeve: " . $result->num_rows . "<br>";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['FLIGHTID']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['FLIGHTNUMBER']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['AIRLINENAME']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['DEPARTURECITY']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['DEPARTUREAIRPORT']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['DEPARTURETIME']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['ARRIVALAIRPORT']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['ARRIVALTIME']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['LASTUPDATE']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['ACTUALPRICE']) . "</td>";
                                        echo "<td class='action-btns'>
                                        <a href='adminflights_edit.php?flightid=" . urlencode($row['FLIGHTID']) . "' class='edit-btn'>
                                            <i class='fa fa-edit'></i>
                                        </a>
                                        <button class='delete-btn' onclick='deleteFlight(" . $row['FLIGHTID'] . ")'>
                                            <i class='fa fa-trash-alt'></i>
                                        </button>
                                         <button class='web-btn' onclick='showFlight(\"" . htmlspecialchars($row["WEBSITE"], ENT_QUOTES, "UTF-8") . "\")'>
                <i class='fa fa-globe'></i>
            </button>
                                      </td>";
                                                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>Nuk u gjet asnje fluturim!</td></tr>";
                                }
                            }
                            $conn->close();
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function deleteFlight(flightid) {
    if (confirm("Jeni te sigurt qe deshironi te stornoni kete fluturim?")) {
        window.location.href = 'exec/deleteflight.php?flightid=' + flightid;
    }
}
    </script>
    <script>
        function showFlight(websiteURL) {
            if (websiteURL) {
                window.open(websiteURL, '_blank');
            } else {
                alert("Faqja nuk eshte e disponueshme!");
            }
        }
    </script>
</body>
</html>
