<?php
// Start the session only if it is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$ID = $_SESSION['admin_id'];
$Village = $_SESSION['Village'];
$Mandal = $_SESSION['Mandal'];
$Name = $_SESSION['Name'];
$District = $_SESSION['District'];

// Connect to the database
$host = 'localhost';
$dbname = 'user';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// SQL query to count the number of families registered from a village
$sql = "SELECT COUNT(*) AS totalFamilies FROM family_details WHERE Village = '$Village'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$totalFamilies = $stmt->fetch(PDO::FETCH_ASSOC)['totalFamilies'];

$village = "$Village";

// SQL query to get FamilyMembers count JSON data for the specified village
$sql = "SELECT FamilyMembers FROM family_details WHERE Village = :village";
$stmt = $conn->prepare($sql);
$stmt->execute([':village' => $village]);

$totalFamilyMembers = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $familyMembers = json_decode($row['FamilyMembers'], true);
    $totalFamilyMembers += count($familyMembers) + 1;
}

// SQL query to get the sum of Voters for the specified village
$sql = "SELECT SUM(Voters) AS totalVoters FROM family_details WHERE Village = :village";
$stmt = $conn->prepare($sql);
$stmt->execute([':village' => $village]);
$totalVoters = $stmt->fetch(PDO::FETCH_ASSOC)['totalVoters'];

// SQL query to get the sum of educated people for the specified village
$sql = "SELECT SUM(Education) AS totalLiterature FROM family_details WHERE Village = :village";
$stmt = $conn->prepare($sql);
$stmt->execute([':village' => $village]);
$totalLiterature = $stmt->fetch(PDO::FETCH_ASSOC)['totalLiterature'];

$LiteracyRate = ($totalLiterature / $totalFamilyMembers) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Village Data</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        caption {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<table>
    <caption>Village Data for <?php echo $Village; ?></caption>
    <tr>
        <th>Metric</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>Total Number of Families Registered</td>
        <td><?php echo $totalFamilies; ?></td>
    </tr>
    <tr>
        <td>Village Population</td>
        <td><?php echo $totalFamilyMembers; ?></td>
    </tr>
    <tr>
        <td>Total Number of Voters</td>
        <td><?php echo $totalVoters; ?></td>
    </tr>
    <tr>
        <td>Total Number of Educated People</td>
        <td><?php echo $totalLiterature; ?></td>
    </tr>
    <tr>
        <td>Literacy Rate</td>
        <td><?php echo number_format($LiteracyRate, 2); ?>%</td>
    </tr>
</table>

</body>
</html>
