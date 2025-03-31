<?php
// Start the session if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Authentication_id = $_SESSION['Authentication_id'];
$Name=$_SESSION['Name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Profile</title>
    <style>
    /* Your existing CSS styles */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-image: url("http://localhost/Mini_Project/Images/T21.jpg");
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
        height: auto;
        padding-top: 100px;
        margin: auto;
        padding: 20px;
        background-color: white;
        background-image: url("http://localhost/Mini_Project/Images/T10.jpg");
        background-size: cover;
        /* Ensures the image covers the entire container */
        background-position: center;
        /* Centers the image within the container */
        background-repeat: no-repeat;
        /* Prevents the image from repeating */
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
        color: white;
        /* background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg"); */
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
        /* background-image: url("http://localhost/Mini_Project/Images/BM2.jpeg"); */
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
                <h2>Welcome <?php echo "$Name"; ?></php> Superior Panel
                </h2>
            </div>
            <img src="http://localhost/Mini_Project/Images/Emblem%20of%20Telengana%20(1).jpg" width="120" height="120"
                alt="Telangana logo">
        </div>
    </div>

    <!-- Links Section -->
    <div class="links">
        <!-- <a href="Main_Profile.php"> -->
        <a href="Home_Page.html">LogOut</a>
        <!-- <img src="http://localhost/Mini_Project/Images/HSymbol.jpg" width="25" height="25" alt="Home"> -->
        </a>
        <a href="MainProfile_view.php">View Profile</a>
        <a href="UpdateMain_details.php">Update Profile</a>


        <div class="dropdown">
            <a href="#" class="dropbtn">SRO Services</a>
            <div class="dropdown-content">
                <a href="SRO_Registration.html">Add SRO</a>
                <a href="Manager_Registration.html">Add Manager</a>
                <a href="SROdeletion_Main.php">Remove SRO</a>
                <a href="Managerdeletion_Main.php">Remove Manager</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#" class="dropbtn">Registration Details</a>
            <div class="dropdown-content">
                <a href="StateCount_details.php">View Registration Count</a>
                <a href="Workerdata_Main.php">Gram-Panchayat Workers data</a>
            </div>
        </div>

        <a href="Problemdata_Main.php">View Problems</a>

        <a href="Userdata_Main.php">User Details</a>
        <a href="familydata_Main.php">Family Details</a>
        <a href="Schemes_Main.php">Schemes</a>

        <div class="dropdown">
            <a href="#" class="dropbtn">Members data</a>
            <div class="dropdown-content">
                <a href="Executivedata_Main.php">Executive's data</a>
                <a href="SROdata_Main.php">SRO's data</a>
                <a href="DROdata_Main.php">DRO's data</a>
                <a href="MROdata_Main.php">MRO's data</a>
                <a href="Serpanchdata_Main.php">Serpanch data</a>
                <a href="Admindata_Main.php">Admin data
                    <a href="WardMemberdata_Main.php">Ward Member's data</a>

            </div>
        </div>
    </div>

    <div class="profile-container">
        <h2>Main Profile</h2>
        <?php
        // Check if the Authentication_id is set in the session
        if (!isset($_SESSION['Authentication_id'])) {
            echo "<p>Error: User not logged in.</p>";
            exit();
        }

        $Authentication_id = $_SESSION['Authentication_id'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "superior";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch main login details based on Authentication_id
        $sql = "SELECT * FROM mainlogindetails WHERE Authentication_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $Authentication_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin_details = $result->fetch_assoc();

        if ($admin_details) {
            ?>
        <table class="profile-table">
            <tr>
                <th>Authentication ID</th>
                <td><?php echo htmlspecialchars($admin_details['Authentication_id']); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($admin_details['Name']); ?></td>
            </tr>
            <tr>
                <th>Number</th>
                <td><?php echo htmlspecialchars($admin_details['Number']); ?></td>
            </tr>
            <tr>
                <th>Main ID</th>
                <td><?php echo htmlspecialchars($admin_details['Mail_id']); ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo htmlspecialchars($admin_details['Password']); ?></td>
            </tr>
        </table>
        <a href="Main_Profile.php">Go Back</a>
        <?php
        } else {
            echo "<p>Superior not found. <a href='Main_Profile.php'>Click here to go back</a></p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>

</html>