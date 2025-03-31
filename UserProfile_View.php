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
    <title>Admin Profile</title>
    <style>
    body {
        margin: 0;
        /* background-color:  white; */
        font-family: Arial, sans-serif;

        background-image: url("http://localhost/Mini_Project/Images/T2.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
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

    .profile-container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(10, 10, 10, 10.1);
    }

    .profile-container h2 {
        margin-top: 5px;
        text-align: center;
    }

    .profile-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .profile-table th,
    .profile-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg");
    }

    .profile-table th {
        background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg");
        font-weight: bold;
    }

    .profile-container a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        text-align: center;
    }

    .profile-container a:hover {
        background-color: #45a049;
    }
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






    <div class="profile-container">
        <h2>Profile of <?php echo "$Name"; ?></php>
        </h2>
        <?php
    // session_start(); // Start the session

    // Check if the admin_id is set in the session
    if (!isset($_SESSION['user_id'])) {
        echo "<p>Error: User not logged in.</p>";
        exit();
    }

    

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch admin details based on admin ID
    $sql = "SELECT * FROM user_registration WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        ?>
        <table class="profile-table">
            <tr>
                <th>User Id</th>
                <td><?php echo htmlspecialchars($user_id); ?></td>
            </tr>
            <tr>
                <th>FSC Number</th>
                <td><?php echo htmlspecialchars($user['FSC_number']); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($user['Name']); ?></td>
            </tr>
            <tr>
                <th>Aadhar Number</th>
                <td><?php echo htmlspecialchars($user['Aadhar_number']); ?></td>
            </tr>
            <tr>
                <th>Village</th>
                <td><?php echo htmlspecialchars($user['Village']); ?></td>
            </tr>
            <tr>
                <th>Mandal</th>
                <td><?php echo htmlspecialchars($user['Mandal']); ?></td>
            </tr>
            <tr>
                <th>District</th>
                <td><?php echo htmlspecialchars($user['District']); ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo htmlspecialchars($user['Phone_number']); ?></td>
            </tr>
            <tr>
                <th>Mail id</th>
                <td><?php echo htmlspecialchars($user['Mail_id']); ?></td>
            </tr>
            <tr>
            <tr>
                <th>Password</th>
                <td><?php echo htmlspecialchars($user['Password']); ?></td>
            </tr>


            </td>
            </tr>
        </table>
        <a href="User_Profile.php">Go Back</a>
        <?php
    } else {
        echo "<p>user not found. <a href='User_Profile.php'>Click here to go back</a></p>";
    }

    $stmt->close();
    $conn->close();
    ?>
    </div>

</body>

</html>