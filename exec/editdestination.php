<?php
$config = include('db_config.php');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destinationID = intval($_POST['destinationID']);
    $destinationName = $conn->real_escape_string($_POST['destinationName']);
    $dateOfBirth = $_POST['dateofbirth'];
    $iata = $conn->real_escape_string($_POST['iata']);
    $countryID = intval($_POST['countryid']);
    $stateID = intval($_POST['stateid']);
    echo "<script type='text/javascript'>alert('IATA Value: \"$iata\"');</script>";

    $query = "UPDATE CITIES SET IDENTIFIER=?, STARTDATE=?, IATA=?, COUNTRYID=?, STATEID=? WHERE CITYID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssiii", $destinationName, $dateOfBirth, $iata, $countryID, $stateID, $destinationID);

    if ($stmt->execute()) {
        header("Location: https://slopetravel.com/admindestinations.php");
        exit;
    } else {
        echo "Error updating destination: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
