<?php
// Start the session only if it is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$Village = $_SESSION['Village'];
$Mandal = $_SESSION['Mandal'];
$District=$_SESSION['District'];
$Name=$_SESSION['Name'];
$FCS=$_SESSION['FCS'];
$user_id=$_SESSION['user_id'];
$Gmail=$_SESSION['Gmail'];
$Number=$_SESSION['Number'];
$Aadhar_Number=$_SESSION['Aadhar_Number'];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panchayat Raj & Rural Employment</title>
    <style>
    body {
        margin: 0;
        background-color:  white;
        font-family: Arial, sans-serif;
    }

    .header {
        background-color: white;
        padding: 0px;
        text-align: center;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .header-text {
        text-align: center;
        flex-grow: 1;
    }

    .header img {
        padding: 10px;
        width: 100px;
        height: 100px;
    }

    .links {
        text-align: left;
        margin-top: 10px;
        background-color: #f1f1f1;
        padding: 10px;
        border: 5px solid #ccc;
    }

    .links a {
        margin: 0 15px;
        text-decoration: none;
        color: #483D8B;
        font-weight: bold;
    }

    .links a:hover {
        text-decoration: underline;
    }

    /* Scrolling text */
    .scrolling-text {
        margin-top: 10px;
        background-color: #f1f1f1;
        padding: 10px;
        text-align: center;
    }

    .scrolling-text marquee {
        font-weight: bold;
        color: #e90a33;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: #4682B4;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: whitesmoke;
    }

    .login-box {
        width: 380px;
        height: 210px;
        margin: auto;
        border-radius: 3px;
        background-color: white;
        font-size: 15px;
    }

    h1 {
        text-align: center;
        padding-top: 10px;
    }

    form {
        width: 270px;
        height: 350px;
        margin-left: 20px;
    }

    form label {
        display: flex;
        margin-top: 20px;
        font-size: 15px;
    }

    form input {
        width: 120%;
        padding: 8px;
        border: solid;
        border: 2px solid gray;
        outline: none;
    }

    input[type="submit"] {
        width: 320px;
        height: 35px;
        margin-top: 70px;
        border: none;
        background-color: green;
        color: white;
        font-size: 18px;
    }

    p {
        text-align: center;
        padding-top: 30px;
        font-size: 15px;
    }

    .para-2 {
        text-align: center;
        color: black;
        font-size: 16px;
        margin-top: -13px;
    }

    .para-2 a {
        color: blue;
    }

    .info-box {
        flex: 1;
        margin: 0 10px;
    }

    .info-box h3 {
        text-align: center;
        font-family: "Arial";
        font-weight: bold;
        color: black;
    }

    .table-box {
        text-align: center;
        font-family: "Arial";
        font-weight: bold;
        color: white;
    }

    .info-box .stats {
        width: 100%;
        border-collapse: collapse;
        border: 10px solid #ccc;
    }

    <style>

    /* Table styles with modified background and font */
    .stats {
        width: 100%;
        border-collapse: collapse;
        /* Ensures borders are merged together */
        background-color: #f9f9f9;
        /* Light background color for the entire table */
        font-family: "Verdana", sans-serif;
        /* Change font family */
        color: #333;
        /* Text color */

    }

    .stats th {
        background-color: whitesmoke;
        /* Darker background color for table headers */
        color: blueviolet;
        /* White text for table headers */
        font-weight: bold;
        text-align: left;
        padding: 10px;
        /* More padding for table headers */
        /* border: 1px solid black; */
    }

    .stats td {
        background-color: lightblue;
        /* White background color for table data */
        color: blue;
        /*Dark grey text for table data */
        padding: 10px;
        /* Padding for table data cells */
        border: 0px solid black;
        /* Lighter border color */
        font-size: 14px;
        /* Font size for table data */

    }
    </style>


    </style>
</head>

<body>
    <div class="header">
        <div class="header-content">
            <img src="http://localhost/Mini_Project/Images/EPM3.jpg" width="120" height="120" alt="E-Panchayat">
            <div class="header-text">
                <h1>Government of Telangana User Panel</h1>
                <h2>Welcome <?php echo "$Name "; ?></php> User from <?php echo "$Village "; ?></php> Village</h2>
            </div>
            <img src="http://localhost/Mini_Project/Images/Emblem%20of%20Telengana%20(1).jpg" width="120" height="120"
                alt="Telangana logo">
        </div>
    </div>

    <!-- Links Section -->
    <div class="links">
        <a href="User_Profile.php">
            <img src="http://localhost/Mini_Project/Images/HSymbol.jpg" width="25" height="25" alt="Home">
        </a>

        <div class="dropdown">
            <a href="#" class="dropbtn">Profile</a>
            <div class="dropdown-content">
                <a href="UserProfile_View.php">View Profile</a>
                <a href="familydata_User.php">family Details</a>
                <a href="UpdateUser_details.php">Update Details</a>
            </div>
        </div>


        <a href="Family_Registration.html">Family Registration</a>
        <a href="Userdata_User.php">View Users data</a>

        <div class="dropdown">
            <a href="#" class="dropbtn">Registration Details</a>
            <div class="dropdown-content">
                <a href="VillageCountdata_User.php">View Registration Count</a>
                <a href="Workerdata_User.php">Gram-Panchayat Workers data</a>
            </div>
        </div>

        <a href="Problemdata_User.php">View Problems</a>

        <a href="Schemes_User.php">Schemes</a>
        <a href="Problem_User.html">Report a Problem</a>


        <div class="dropdown">
            <a href="#" class="dropbtn">Members data</a>
            <div class="dropdown-content">
                <a href="SROdata_User.php">SRO's data</a>
                <a href="StateManagerdata_User.php">StateManager data</a>
                <a href="DROdata_User.php">DRO's data</a>
                <a href="MROdata_User.php">MRO's data</a>
                <a href="Serpanchdata_User.php">Serpanch data</a>
                <a href="Admindata_User.php">Admin data
                    <a href="WardMemberdata_User.php">Ward Member's data</a>

            </div>
        </div>
    </div>
    </div>











    <!-- Info and Stats Section -->
    <div class="info-and-stats">
        <div class="info-box">
            <h3>State Manager Details</h3>
            <table class="stats">
                <tr>
                    <th>SManager id</th>
                    <th>Name</th>
                    <!-- <th>Aadhar Number</th> -->
                    <th>DOB</th>
                    <th>Joning date</th>
                    <th>Village</th>
                    <th>Mandal</th>
                    <th>District</th>
                    <th>Mail id</th>
                    <!-- <th>Number</th> -->
                    <!-- <th>Password</th> -->
                </tr>
                <!-- PHP code for Ward Member Details -->
                <?php

// Start the session only if it is not already started
if (session_status() == PHP_SESSION_NONE) {
 session_start();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "superior";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data

$sql = "SELECT * FROM statemanager" ;


$result = $conn->query($sql);


if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo "<td>" . $row["SManager_id"] . "</td>";
 echo "<td>" . $row["Name"] . "</td>";
//  echo "<td>" . $row["Aadhar_Number"] . "</td>";
 echo "<td>" . $row["DOB"] . "</td>";
 echo "<td>" . $row["Joining_date"] . "</td>";
 echo "<td>" . $row["Village"] . "</td>";
 echo "<td>" . $row["Mandal"] . "</td>";
 echo "<td>" . $row["District"] . "</td>";
 echo "<td>" . $row["Mail_id"] . "</td>";
//  echo "<td>" . $row["Number"] . "</td>";
//  echo "<td>" . $row["Password"] . "</td>";
echo "</td>";
echo "</tr>";
}
} else {
echo "<tr><td colspan='11'>No data found</td></tr>";
}

// Close connection
$conn->close();
?>
            </table>
        </div>
    </div>

    </div>
</body>

</html>