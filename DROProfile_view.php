<?php
// Start the session if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Name=$_SESSION['Name'];
$Employee_Id=$_SESSION['Employee_Id'];
$Village=$_SESSION['Village'];
$Mandal=$_SESSION['Mandal'];
$District=$_SESSION['District'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <style>
    /* Your existing CSS styles */
    body {
        margin: 0;
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

    .profile-container {
        max-width: 600px;
        padding-top: 100px;
        margin: auto;
        padding: 20px;
        background-color: white;
        background-image: url("http://localhost/Mini_Project/Images/T10.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-container h2 {
        margin-top: 5px;
        text-align: center;
        color: white;
    }

    .profile-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        /* background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg"); */
    }

    .profile-table th,
    .profile-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg");
    }

    .profile-table th {
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
        background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg");
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
                <h1>Government of Telangana</h1>
                <h2>Welcome <?php echo "$Name"; ?></php> DRO of <?php echo "$District"; ?></php>
                </h2>
            </div>
            <img src="http://localhost/Mini_Project/Images/Emblem%20of%20Telengana%20(1).jpg" width="120" height="120"
                alt="Telangana logo">
        </div>
    </div>

    <!-- Links Section -->
    <div class="links">
        <a href="Home_Page.html">
            <img src="http://localhost/Mini_Project/Images/HSymbol.jpg" width="25" height="25" alt="Home">
        </a>
        <a href="DROProfile_view.php">View Profile</a>
        <a href="UpdateDRO_details.php">Update Profile</a>

        <div class="dropdown">
            <a href="#" class="dropbtn">DRO Services</a>
            <div class="dropdown-content">
                <a href="MRO_Registration.html">Add MRO</a>
                <a href="MROdeletion_DRO.php">Remove MRO</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#" class="dropbtn">Registration Details</a>
            <div class="dropdown-content">
                <a href="DistrictCountdata_DRO.php">View Registration Count</a>
                <a href="Workerdata_DRO.php">Gram-Panchayat Workers data</a>
            </div>
        </div>

        <a href="Problemdata_DRO.php">View Problems</a>
        <a href="Userdata_DRO.php">User Details</a>
        <a href="familydata_DRO.php">family Details</a>
        <a href="Schemes_DRO.php">Schemes</a>

        <div class="dropdown">
            <a href="#" class="dropbtn">Members data</a>
            <div class="dropdown-content">
                <a href="SROdata_DRO.php">SRO's data</a>
                <a href="StateManagerdata_DRO.php">StateManager data</a>
                <a href="DROdata_DRO.php">DRO's data</a>
                <a href="MROdata_DRO.php">MRO's data</a>
                <a href="Serpanchdata_DRO.php">Serpanch data</a>
                <a href="Admindata_DRO.php">Admin data
                    <a href="WardMemberdata_DRO.php">Ward Member's data</a>

            </div>
        </div>
    </div>



    <div class="profile-container">
        <h2>District Revenue Officer(DRO) Profile of <?php echo "$Name" ?></h2>
        <?php
        // Check if the Authentication_id is set in the session
        if (!isset($_SESSION['Employee_Id'])) {
            echo "<p>Error: User not logged in.</p>";
            exit();
        }

        // $Authentication_id = $_SESSION['Authentication_id'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "revenuelogindetails";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch main login details based on Authentication_id
        $sql = "SELECT * FROM dro_details WHERE Employee_Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $Employee_Id);
        $stmt->execute();
        $result = $stmt->get_result();
        $DRO_details = $result->fetch_assoc();

        if ($DRO_details) {
            ?>
        <table class="profile-table">
            <tr>
                <th>Authentication ID</th>
                <td><?php echo htmlspecialchars($DRO_details['Employee_Id']); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($DRO_details['Name']); ?></td>
            </tr>
            <tr>
                <th>Aadhar Number</th>
                <td><?php echo htmlspecialchars($DRO_details['Aadhar_Number']); ?></td>
            </tr>
            <tr>
                <th>DOB</th>
                <td><?php echo htmlspecialchars($DRO_details['DOB']); ?></td>
            </tr>
            <tr>
                <th>Joining date</th>
                <td><?php echo htmlspecialchars($DRO_details['Joining_date']); ?></td>
            </tr>
            <tr>
                <th>Village</th>
                <td><?php echo htmlspecialchars($DRO_details['Village']); ?></td>
            </tr>
            <tr>
                <th>Mandal</th>
                <td><?php echo htmlspecialchars($DRO_details['Mandal']); ?></td>
            </tr>
            <tr>
                <th>District</th>
                <td><?php echo htmlspecialchars($DRO_details['District']); ?></td>
            </tr>
            <tr>
                <th>Mail ID</th>
                <td><?php echo htmlspecialchars($DRO_details['Gmail']); ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo htmlspecialchars($DRO_details['Password']); ?></td>
            </tr>
        </table>
        <a href="DRO_Profile.php">Go Back</a>
        <?php
        } else {
            echo "<p>DRO not found. <a href='DRO_Profile.php'>Click here to go back</a></p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>

</html>