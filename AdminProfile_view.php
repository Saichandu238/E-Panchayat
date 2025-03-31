<?php
// Start the session only if it is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$ID=$_SESSION['admin_id'];
$Village = $_SESSION['Village'];
$Mandal = $_SESSION['Mandal'];
$Name=$_SESSION['Name'];
$District=$_SESSION['District'];
$Gmail=$_SESSION['mail_id'];
$Number=$_SESSION['Number'];
$Aadhar_number=$_SESSION['Aadhar_number'];
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
        background-color: white;
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
        background-color: white;
        /* background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg"); */
    }

    .profile-table th {
        background-color: white;
        /* background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg"); */
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
                <h1>Government of Telangana Admin Panel</h1>
                <h2>Welcome <?php echo "$Name"; ?></php>, Admin of <?php echo "$Village "; ?></php> Village</h2>
            </div>
            <img src="http://localhost/Mini_Project/Images/Emblem%20of%20Telengana%20(1).jpg" width="120" height="120"
                alt="Telangana logo">
        </div>
    </div>

    <!-- Links Section -->
    <div class="links">
        <a href="Admin_Profile.php">
            <img src="http://localhost/Mini_Project/Images/HSymbol.jpg" width="25" height="25" alt="Home">
        </a>

        <div class="dropdown">
            <a href="#" class="dropbtn">Profile</a>
            <div class="dropdown-content">
                <a href="AdminProfile_view.php">View Profile</a>
                <a href="updateAdmin_details.php">Update Details</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#" class="dropbtn">Family Services</a>
            <div class="dropdown-content">
                <a href="Family_Registration.html">Family Registration</a>
                <a href="familydata_Admin.php">View family Details</a>
                <a href="Updatefamilydetails_Admin.php">Update Family Details</a>
            </div>
        </div>


        <div class="dropdown">
            <a href="#" class="dropbtn">User Services</a>
            <div class="dropdown-content">
                <a href="Userdeletion_Admin.php">Remove User</a>
                <a href="Userdata_Admin.php">View User Details</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#" class="dropbtn">Registration Details</a>
            <div class="dropdown-content">
                <a href="VillageCountdata_Admin.php">View Registration Count</a>
                <a href="Workerdata_Admin.php">Gram-Panchayat Workers data</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#" class="dropbtn">Ward Services</a>
            <div class="dropdown-content">
                <a href="WardMember_Registration.html">Add WardMember</a>
                <a href="WardMemberdeletion_Admin.php">Remove WardMember</a>
            </div>
        </div>

        <a href="Problem_Admin.html">Report a Problem</a>

        <div class="dropdown">
            <a href="#" class="dropbtn">View Problems</a>
            <div class="dropdown-content">
                <a href="UserReportedProblems_Admin.php">UserReported</a>
                <a href="VillageRepotedPeoblems_Admin.php">EmployeesReported</a>
            </div>
        </div>

        <a href="Schemes_Admin.php">Schemes</a>

        <div class="dropdown">
            <a href="#" class="dropbtn">Members data</a>
            <div class="dropdown-content">
                <a href="SROdata_Admin.php">SRO's data</a>
                <a href="StateManagerdata_Admin.php">StateManager data</a>
                <a href="DROdata_Admin.php">DRO's data</a>
                <a href="MROdata_Admin.php">MRO's data</a>
                <a href="Serpanchdata_Admin.php">Serpanch data</a>
                <a href="Admindata_Admin.php">Admin data
                    <a href="WardMemberdata_Admin.php">Ward Member's data</a>
            </div>
        </div>
    </div>




    <div class="profile-container">
        <h2>Profile of <?php echo "$Name" ?> Admin of <?php echo "$Village" ?></h2>
        <?php
    // session_start(); // Start the session

    // Check if the admin_id is set in the session
    if (!isset($_SESSION['admin_id'])) {
        echo "<p>Error: User not logged in.</p>";
        exit();
    }

    $ID = $_SESSION['admin_id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "villagelogins";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch admin details based on admin ID
    $sql = "SELECT * FROM admindetails WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin) {
        ?>
        <table class="profile-table">
            <tr>
                <th>Admin ID</th>
                <td><?php echo htmlspecialchars($ID); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($admin['Name']); ?></td>
            </tr>
            <tr>
                <th>Aadhar Number</th>
                <td><?php echo htmlspecialchars($admin['Aadhar_Number']); ?></td>
            </tr>
            <tr>
                <th>Date Of Joining</th>
                <td><?php echo htmlspecialchars($admin['Joining_date']); ?></td>
            </tr>
            <tr>
                <th>Date Of Ending</th>
                <td><?php echo htmlspecialchars($admin['ending_date']); ?></td>
            </tr>
            <tr>
                <th>Village of Working</th>
                <td><?php echo htmlspecialchars($admin['Village']); ?></td>
            </tr>
            <tr>
                <th>Mandal of Working</th>
                <td><?php echo htmlspecialchars($admin['Mandal']); ?></td>
            </tr>
            <tr>
                <th>District of Working</th>
                <td><?php echo htmlspecialchars($admin['District']); ?></td>
            </tr>
            <tr>
                <th>Number</th>
                <td><?php echo htmlspecialchars($admin['Number']); ?></td>
            </tr>
            <tr>
                <th>Gmail</th>
                <td><?php echo htmlspecialchars($admin['Gmail']); ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo htmlspecialchars($admin['Password']); ?></td>
            </tr>
        </table>
        <a href="Admin_Profile.php">Go Back</a>
        <?php
    } else {
        echo "<p>Admin not found. <a href='Admin_Profile.php'>Click here to go back</a></p>";
    }

    $stmt->close();
    $conn->close();
    ?>
    </div>

</body>

</html>