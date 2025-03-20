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
         <div class="form-container" id="form-container">
    <div class="dashboard-overview">
        <div style="display: flex; justify-content:left; align-items: center; margin-bottom: 10px;">
        <i class="fa fa-pie-chart"></i>
        <h3>Ballina</h3>
        </div>
        <div class="filters">
            <label for="time-filter">Filtro ne baza:</label>
            <select id="time-filter">
                <option value="daily">Ditore</option>
                <option value="weekly">Javore</option>
                <option value="monthly" selected>Mujore</option>
            </select>
        </div>
        <div class="cards">
            <div class="card">
                <h3>Shitja</h3>
                <p id="sales-value">$0</p>
            </div>
            <div class="card">
                <h3>Klientë të shërbyer</h3>
                <p id="customers-value">0</p>
            </div>
            <div class="card">
                <h3>Incidente</h3>
                <p id="incidents-value">0</p>
            </div>
            <div class="card">
                <h3>Qarkullimi</h3>
                <p id="revenue-value">$0</p>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-overview {
        font-family: Arial, sans-serif;
    }

    .filters {
        margin-bottom: 20px;
    }

    .filters select {
        padding: 5px;
        font-size: 1rem;
    }

    .cards {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 20px;
    }

    .card {
        flex: 1;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .card h3 {
        margin-bottom: 10px;
    }

    .card p {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const timeFilter = document.getElementById('time-filter');
        const salesValue = document.getElementById('sales-value');
        const customersValue = document.getElementById('customers-value');
        const incidentsValue = document.getElementById('incidents-value');
        const revenueValue = document.getElementById('revenue-value');

        function updateDashboardData(timeframe) {
            // Mock data fetching - replace with real API calls
            const mockData = {
                daily: { sales: "$500", customers: "20", incidents: "0", revenue: "$1500" },
                weekly: { sales: "$3500", customers: "150", incidents: "0", revenue: "$10500" },
                monthly: { sales: "$15000", customers: "600", incidents: "0", revenue: "$45000" },
            };

            const data = mockData[timeframe];
            salesValue.textContent = data.sales;
            customersValue.textContent = data.customers;
            incidentsValue.textContent = data.incidents;
            revenueValue.textContent = data.revenue;
        }

        // Update data on filter change
        timeFilter.addEventListener('change', function () {
            updateDashboardData(timeFilter.value);
        });

        // Initial load
        updateDashboardData('monthly');
    });
</script>

        </div>
    </div>
</body>
</html>
