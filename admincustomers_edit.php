<?php
// Fetch the customer ID from the URL (passed by the 'customerid' parameter)
if (isset($_GET['customerid'])) {
    $customerid = $_GET['customerid'];

    // Database connection
    $config = include('exec/db_config.php');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch customer data from the database
    $query = "SELECT * FROM CUSTOMER WHERE CUSTOMERID = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $customerid);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $customer = $result->fetch_assoc();
        } else {
            die("Customer not found.");
        }

        $stmt->close();
    }

    // Fetch countries for the select input
    $countriesQuery = "SELECT COUNTRYID, IDENTIFIER FROM COUNTRIES";
    $countriesResult = $conn->query($countriesQuery);

    // Fetch cities for the select input
    $citiesQuery = "SELECT CITYID, IDENTIFIER FROM CITIES";
    $citiesResult = $conn->query($citiesQuery);

    // Fetch genders for the select input
    $gendersQuery = "SELECT GENDERID, GENDERNAME FROM GENDERS";
    $gendersResult = $conn->query($gendersQuery);

    // Fetch states for the select input
    $statesQuery = "SELECT STATEID, IDENTIFIER FROM STATES";
    $statesResult = $conn->query($statesQuery);

    // Close connection after fetching all necessary data
    $conn->close();
} else {
    die("Customer ID not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlopeTravel - Regjistrimi i klientit te ri</title>
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
        <div class="form-container" id="form-container">
            <h2>Perditesimi i te dhenave te Klientit</h2>
            <form action="exec/editcustomer.php" method="POST">
                <input type="hidden" name="customerid" value="<?php echo $customer['CUSTOMERID']; ?>">

                <div style="margin-bottom: 15px;">
                    <label for="firstname">Emri:</label><br>
                    <input type="text" id="firstname" name="firstname" value="<?php echo $customer['FIRSTNAME']; ?>" required style="width: 100%; padding: 8px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="lastname">Mbiemri:</label><br>
                    <input type="text" id="lastname" name="lastname" value="<?php echo $customer['LASTNAME']; ?>" required style="width: 100%; padding: 8px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="dateofbirth">Data e lindjes:</label><br>
                    <input type="date" id="dateofbirth" name="dateofbirth" value="<?php echo $customer['DATEOFBIRTH']; ?>" required style="width: 100%; padding: 8px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="identitynumber">Nr.Identifikues:</label><br>
                    <input type="text" id="identitynumber" name="identitynumber" value="<?php echo $customer['IDENTITYNUMBER']; ?>" required style="width: 100%; padding: 8px;">
                </div>

                <!-- Fetching countries and setting the selected value -->
                <div style="margin-bottom: 15px;">
                    <label for="countryid">Shteti:</label><br>
                    <select id="countryid" name="countryid" required style="width: 100%; padding: 8px;">
                        <option value="" disabled selected>Perzgjedh shtetin</option>
                        <?php while ($row = $countriesResult->fetch_assoc()) {
                            $selected = ($row['COUNTRYID'] == $customer['COUNTRYID']) ? 'selected' : ''; // Check if the country matches the customer's country
                            echo "<option value='" . $row['COUNTRYID'] . "' $selected>" . $row['IDENTIFIER'] . "</option>";
                        } ?>
                    </select>
                </div>

                <!-- Fetching cities and setting the selected value -->
                <div style="margin-bottom: 15px;">
                    <label for="cityid">Qyteti:</label><br>
                    <select id="cityid" name="cityid" required style="width: 100%; padding: 8px;">
                        <option value="" disabled selected>Perzgjedh Qytetin</option>
                        <?php while ($row = $citiesResult->fetch_assoc()) {
                            $selected = ($row['CITYID'] == $customer['CITYID']) ? 'selected' : ''; // Check if the city matches the customer's city
                            echo "<option value='" . $row['CITYID'] . "' $selected>" . $row['IDENTIFIER'] . "</option>";
                        } ?>
                    </select>
                </div>

                <!-- Fetching gender and setting the selected value -->
                <div style="margin-bottom: 15px;">
                    <label for="genderid">Gjinia:</label><br>
                    <select id="genderid" name="genderid" required style="width: 100%; padding: 8px;">
                        <option value="" disabled selected>Perzgjedh Gjinine</option>
                        <?php while ($row = $gendersResult->fetch_assoc()) {
                            $selected = ($row['GENDERID'] == $customer['GENDERID']) ? 'selected' : ''; // Check if the gender matches the customer's gender
                            echo "<option value='" . $row['GENDERID'] . "' $selected>" . $row['GENDERNAME'] . "</option>";
                        } ?>
                    </select>
                </div>

                <!-- Fetching state and setting the selected value -->
                <div style="margin-bottom: 15px;">
                    <label for="stateid">Statusi:</label><br>
                    <select id="stateid" name="stateid" required style="width: 100%; padding: 8px;">
                        <option value="" disabled selected>Perzgjedh Statusin</option>
                        <?php while ($row = $statesResult->fetch_assoc()) {
                            $selected = ($row['STATEID'] == $customer['STATEID']) ? 'selected' : ''; // Check if the state matches the customer's state
                            echo "<option value='" . $row['STATEID'] . "' $selected>" . $row['IDENTIFIER'] . "</option>";
                        } ?>
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="contact">Nr.Kontaktues:</label><br>
                    <input type="text" id="contact" name="contact" value="<?php echo $customer['CONTACT']; ?>" required style="width: 100%; padding: 8px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="email">E-mail:</label><br>
                    <input type="text" id="email" name="email" value="<?php echo $customer['EMAIL']; ?>" required style="width: 100%; padding: 8px;">
                </div>

                <button type="submit" class="add-btn">
                    <i class="fa fa-user-plus"></i> Perditeso te dhenat e klientit
                                </button>
                                <button type="button" class="add-btn" onclick="window.location.href='admincustomers.php'">
    <i class="fa fa-times"></i> Anulo
</button>
            </form>
        </div>
    </div>
</body>
</html>
