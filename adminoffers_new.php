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

        #error-message {
    background-color: #ffcccc;
    padding: 10px;
    border: 1px solid red;
    margin-bottom: 15px;
    border-radius: 5px;
}

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
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
        <h2>Regjistrimi i Ofertës së re</h2>
        <div id="error-message" style="color: red; display: none;"></div>
        <form action="exec/addnewaccomodation.php" method="POST" onsubmit="return validateForm()">
        <div style="display: flex; align-items: center; gap: 20px;">
        <div class="checkbox-group">
                    <input type="checkbox" id="roundtrip" name="roundtrip" checked>
                    <label for="roundtrip">Kthyese</label>
                </div>
               <div>
                    <label for="tariffcategoryid">Kategoria:</label>
                    <select id="tariffcategoryid" name="tariffcategoryid" required>
                        <option value="" disabled selected>Zgjidh kategorine</option>
                        <?php
                           $config = include('exec/db_config.php');
                           $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                           $query = "SELECT tariffcategoryid, IDENTIFIER FROM TARIFFCATEGORIES ORDER BY IDENTIFIER;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['tariffcategoryid'] . "'>" . $row['IDENTIFIER'] . "</option>";
                        }
                        ?>
                    </select>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
                    <label for="barcode">Barkodi i ofertës:</label>
                    <input type="text" id="barcode" name="barcode" required>
                </div>
                <div>
                    <label for="description">Përshkrimi i ofertës:</label>
                    <input type="text" id="description" name="description" required>
                </div>
                </div>
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
    <label for="departureid">Fluturimi (Nisje):</label>
    <select id="departureid" name="departureid" onchange="updateDeparture(); updateCostOfSale()" required>
        <option value="" disabled selected>Zgjidh fluturimin</option>
        <?php
        $query = "SELECT f.FLIGHTID, CONCAT(f.DEPARTUREFLIGHTDATE, ' ', dc.IDENTIFIER, ' - ', ac.IDENTIFIER) as IDENTIFIER, f.ACTUALPRICE, CONCAT(
                DATE_FORMAT(f.DEPARTUREFLIGHTDATE, '%d.%m.%Y'), 
                ' ', 
                DATE_FORMAT(f.DEPARTUREFLIGHTTIME, '%H:%i')
            ) AS DEPARTURE_DATETIME 
            FROM FLIGHTS f 
            LEFT JOIN AIRPORTS dap ON dap.AIRPORTID = f.DEPARTUREAIRPORTID 
            LEFT JOIN CITIES dc ON dc.CITYID = dap.CITYID 
            LEFT JOIN AIRPORTS aap ON aap.AIRPORTID = f.ARRIVALAIRPORTID 
            LEFT JOIN CITIES ac ON ac.CITYID = aap.CITYID 
            WHERE f.STATEID = 1 AND f.DEPARTUREFLIGHTDATE > NOW() 
            ORDER BY f.DEPARTUREFLIGHTDATE;";
        
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['FLIGHTID'] . "' departure-data-price='" . $row['ACTUALPRICE'] . "' departure-data-datetime='" . $row['DEPARTURE_DATETIME'] . "'>" . $row['IDENTIFIER'] . "</option>";
        }
        ?>
    </select>
</div>
                <div >
                <label for="departure-price-display">Çmimi i Aktual:</label>
                <label id="departue-price-display"></label>
                </div>
                <div >
                <label for="departure-date-display">Data & Ora e Nisjes:</label>
                <label id="departure-date-display"></label>
                </div>  
                </div>
                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
    <label for="arrivalid">Fluturimi (Kthim):</label>
    <select id="arrivalid" name="arrivalid" onchange="updateReturn(); updateCostOfSale()" required>
        <option value="" disabled selected>Zgjidh fluturimin</option>
        <?php
        $query = "SELECT f.FLIGHTID, CONCAT(f.DEPARTUREFLIGHTDATE, ' ', dc.IDENTIFIER, ' - ', ac.IDENTIFIER) as IDENTIFIER, f.ACTUALPRICE, CONCAT(
               DATE_FORMAT(f.DEPARTUREFLIGHTDATE, '%d.%m.%Y'), 
                ' ', 
               DATE_FORMAT(f.DEPARTUREFLIGHTTIME, '%H:%i')
            ) AS DEPARTURE_DATETIME 
            FROM FLIGHTS f 
            LEFT JOIN AIRPORTS dap ON dap.AIRPORTID = f.DEPARTUREAIRPORTID 
            LEFT JOIN CITIES dc ON dc.CITYID = dap.CITYID 
            LEFT JOIN AIRPORTS aap ON aap.AIRPORTID = f.ARRIVALAIRPORTID 
            LEFT JOIN CITIES ac ON ac.CITYID = aap.CITYID 
            WHERE f.STATEID = 1 AND f.DEPARTUREFLIGHTDATE > NOW() 
            ORDER BY f.DEPARTUREFLIGHTDATE;";
        
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['FLIGHTID'] . "' arrival-data-price='" . $row['ACTUALPRICE'] . "' arrival-data-datetime='" . $row['DEPARTURE_DATETIME'] . "'>" . $row['IDENTIFIER'] . "</option>";
        }
        ?>
    </select>
</div>

                <div>
                <label for="arrival-price-display">Çmimi i Aktual:</label>
                <label id="arrival-price-display"></label>
                </div> 
                <div >
                <label for="arrival-date-display">Data & Ora e Kthimit:</label>
                <label id="arrival-date-display"></label>
                </div> 
                </div>
               
                <div style="display: flex; align-items: center; gap: 20px;"> 

                <div>
    <label for="reservationid">Akomodimi:</label>
    <select id="reservationid" name="reservationid" onchange="updateReservation(); updateCostOFSales()" required>
        <option value="" disabled selected>Zgjidh akomodimin</option>
        <?php
        $query = "SELECT re.RESERVATIONID, CONCAT(DATE_FORMAT(re.STARTDATE, '%d.%m.%Y'),' - ',DATE_FORMAT(re.ENDDATE, '%d.%m.%Y')) as DATES, re.ENDDATE, re.STARTDATE, CONCAT(c.IDENTIFIER,', ',ac.IDENTIFIER,' (',DATE_FORMAT(re.STARTDATE, '%d.%m.%Y'),' ',DATE_FORMAT(re.ENDDATE, '%d.%m.%Y'),')') as IDENTIFIER, re.ACTUALPRICE, re.GUESTS FROM RESERVATIONS re join ACCOMMODATIONS ac on ac.ACCOMMODATIONID = re.ACCOMMODATIONID join CITIES c on c.CITYID = ac.CITYID where re.STATEID = 1 and re.STARTDATE > NOW();";
        
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['RESERVATIONID'] . "' reservation-data-price='" . $row['ACTUALPRICE'] . "' reservation-guests='" . $row['GUESTS'] . "' reservation-data-datetime='" . $row['STARTDATE'] . "' reservation-enddata-datetime='" . $row['ENDDATE'] . "'>" . $row['IDENTIFIER'] . "</option>";
        }
        ?>
    </select>
</div>

<div >
                <label for="reservation-guests-display">Nr. mysafireve:</label>
                <label id="reservation-guests-display"></label>  
                </div> 
                <div>
                <label for="reservation-price-display">Çmimi i Aktual:</label>
                <label id="reservation-price-display"></label>
                </div> 
                <div >
                <label for="reservation-checkin-display">Data & Ora e Hyrjes:</label>
                <label id="reservation-checkin-display"></label>
                </div> 
                <div >
                <label for="reservation-checkout-display">Data & Ora e Daljes:</label>
                <label id="reservation-checkout-display"></label>  
                </div> 
                </div> 

                <div style="display: flex; align-items: center; gap: 20px;">
                <div>
                <label for="cost-of-sale">Kostoja e Shitjes:</label>
                <label id="cost-of-sale">0.00</label>
                </div>
                <div>
                    <label for="startprice">Çmimi i Shitjes:</label>
                    <input type="number" step="0.01" id="startprice" name="startprice" oninput="updateProfit()" required>
                </div>
                <div>
                <label for="profit">Fitimi:</label>
                <label id="profit">0.00</label>
                </div>
                <div>
                    <label for="vatid">Norma e TVSh-së:</label>
                    <select id="vatid" name="vatid" required>
                        <option value="" disabled selected>Zgjidh normën</option>
                        <?php
                        $query = "SELECT VATID, IDENTIFIER FROM VAT ORDER BY IDENTIFIER;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['VATID'] . "'>" . $row['IDENTIFIER'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
                <div style="display: flex; align-items: center; gap: 20px; width: auto;">
                <div>
                    <label for="stateid">Statusi:</label>
                    <select id="stateid" name="stateid" required>
                        <option value="" disabled selected>Zgjidh Statusin</option>
                        <?php
                        $query = "SELECT STATEID, IDENTIFIER FROM STATES WHERE STATEID IN (1,2) ORDER BY IDENTIFIER;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['STATEID'] . "'>" . $row['IDENTIFIER'] . "</option>";
                        }
                        $conn->close(); // Close the database connection
                        ?>
                    </select>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="post" name="post">
                    <label for="post">Posto ne faqe kryesore</label>
                </div>
                </div>
                <div>
                    <label for="image">Ngarko imazhin e ofertës:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="add-btn">
                    <i class="fa fa-tags"></i> Regjistro
                </button>
                <button type="button" class="add-btn" onclick="window.location.href='adminoffers.php'">
                    <i class="fa fa-times"></i> Anulo
                </button>
            </form>
        </div>
    </div>
    <script>
        function updateDeparture() {
            const departureSelect = document.getElementById('departureid');
            const priceDisplay = document.getElementById('departue-price-display');
            const dateDisplay = document.getElementById('departure-date-display');

            const selectedOption = departureSelect.options[departureSelect.selectedIndex];
            const price = selectedOption.getAttribute('departure-data-price');
            const dateTime = selectedOption.getAttribute('departure-data-datetime');

            priceDisplay.textContent = price ? price : 'N/A';
            dateDisplay.textContent = dateTime ? dateTime : 'N/A';
        }

        function updateReturn() {
            const arrivalSelect = document.getElementById('arrivalid');
            const priceDisplay = document.getElementById('arrival-price-display');
            const dateDisplay = document.getElementById('arrival-date-display');

            const selectedOption = arrivalSelect.options[arrivalSelect.selectedIndex];
            const price = selectedOption.getAttribute('arrival-data-price');
            const dateTime = selectedOption.getAttribute('arrival-data-datetime');

            priceDisplay.textContent = price ? price : 'N/A';
            dateDisplay.textContent = dateTime ? dateTime : 'N/A';
        }

        function updateReservation() {
            const reservationSelect = document.getElementById('reservationid');
            const priceDisplay = document.getElementById('reservation-price-display');
            const dateDisplay = document.getElementById('reservation-checkin-display');
            const enddateDisplay = document.getElementById('reservation-checkout-display');
            const guestsDisplay = document.getElementById('reservation-guests-display');

            const selectedOption = reservationSelect.options[reservationSelect.selectedIndex];
            const price = selectedOption.getAttribute('reservation-data-price');
            const dateTime = selectedOption.getAttribute('reservation-data-datetime');
            const enddateTime = selectedOption.getAttribute('reservation-enddata-datetime');
            const guests = selectedOption.getAttribute('reservation-guests');

            priceDisplay.textContent = price ? price : 'N/A';
            dateDisplay.textContent = dateTime ? dateTime : 'N/A';
            enddateDisplay.textContent = enddateTime ? enddateTime : 'N/A';
            guestsDisplay.textContent = guests ? guests : 'N/A';
        }

        function updateCostOfSale() {
        const departureSelect = document.getElementById('departureid');
        const arrivalSelect = document.getElementById('arrivalid');
        const reservationSelect = document.getElementById('reservationid');

        const departurePrice = parseFloat(departureSelect.options[departureSelect.selectedIndex].getAttribute('departure-data-price')) || 0;
        const arrivalPrice = parseFloat(arrivalSelect.options[arrivalSelect.selectedIndex].getAttribute('arrival-data-price')) || 0;
        const reservationPrice = parseFloat(reservationSelect.options[reservationSelect.selectedIndex].getAttribute('reservation-data-price')) || 0;
        const Guests = parseFloat(reservationSelect.options[reservationSelect.selectedIndex].getAttribute('reservation-guests')) || 0;
        const costOfSale = (departurePrice * Guests) + (arrivalPrice * Guests) + reservationPrice;
 
        document.getElementById('cost-of-sale').innerText = costOfSale.toFixed(2);
        updateProfit();
}
function updateProfit() {
        const salePrice = parseFloat(document.getElementById('startprice').value) || 0;
        const costOfSale = parseFloat(document.getElementById('cost-of-sale').innerText) || 0;
        const profit = salePrice - costOfSale;
        document.getElementById('profit').innerText = profit.toFixed(2);
    }
    function validateForm() {
    // Validate Profit
    const profitamount = parseFloat(document.getElementById('profit').textContent);
    const errorMessage = document.getElementById('error-message');

    // Check if profit amount is less than zero
    if (profitamount < 0) {
        errorMessage.textContent = 'Shërbimi duhet të gjenerojë profit.';
        errorMessage.style.display = 'block';
        return false; // Prevent form submission
    }

    // Hide error message if there are no issues with profit
    errorMessage.style.display = 'none';

    // Validate Dates
    const arrivalDateStr = document.getElementById("arrival-date-display").textContent;
    const departureDateStr = document.getElementById("departure-date-display").textContent;

    const [departureDate, departureTime] = departureDateStr.split(' ');
    const [arrivalDate, arrivalTime] = arrivalDateStr.split(' ');

    const departureDateObj = new Date(`${departureDate.split('.').reverse().join('-')}T${departureTime}`);
    const arrivalDateObj = new Date(`${arrivalDate.split('.').reverse().join('-')}T${arrivalTime}`);

    // Check if arrival date is not after departure date
    if (arrivalDateObj <= departureDateObj) {
        errorMessage.textContent = 'Data e kthimit duhet të jetë pas datës së nisjes.';
        errorMessage.style.display = 'block';
        return false; // Prevent form submission
    }

    // Hide error message if there are no issues with dates
    errorMessage.style.display = 'none';
    
    return true; // Allow form submission
}
    </script>
</body>
</html>
