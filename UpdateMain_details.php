<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Main Details</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-image: url("http://localhost/Mini_Project/Images/Emblem%20of%20Telengana.jpg");
        background-size: 70% 100%;
        /* Set width to 100px and height to 200px */
        background-repeat: no-repeat;
        /* Prevents the image from repeating */
        background-position: center;
        /* Centers the background image */
        background-attachment: fixed;
        /* Keeps the image fixed when scrolling */
        /* height: 100vh; Full viewport height */
    }

    .form-container {
        max-width: 600px;
        margin: auto;
        background: rgba(209, 206, 206, 0.30);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        margin-top: 0;
    }

    .form-container label {
        display: block;
        margin-top: 10px;
    }

    .form-container input[type="text"],
    .form-container input[type="date"],
    .form-container select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-container button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-container button:hover {
        background-color: green;

    }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Update Main Details</h2>
        <h4>Authentication Id cannot be changed </h4>
        <?php
    session_start(); // Start the session

    // Check if the employeeId is set in the session
    if (!isset($_SESSION['Authentication_id'])) {
        echo "<p>Error: User not logged in.</p>";
        exit();
    }

    $ID = $_SESSION['Authentication_id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "superior";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch MRO details based on employee ID
    $sql = "SELECT * FROM mainlogindetails WHERE Authentication_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $main_datails = $result->fetch_assoc();

    if ($main_datails) {
        ?>
        <form action="updateMain_details2.php" method="POST">
            <b><label for="admin_id">Authentication ID</label>
                <input type="text" name="Authentication_id" value="<?php echo htmlspecialchars($ID); ?>">

                <label for="Name">Name:</label>
                <input type="text" id="Name" name="Name" value="<?php echo htmlspecialchars($main_datails['Name']); ?>"
                    required>

                <label for="Name">Number:</label>
                <input type="text" id="Number" name="Number"
                    value="<?php echo htmlspecialchars($main_datails['Number']); ?>" required>

                <label for="Name">Mail id:</label>
                <input type="text" id="Mail_id" name="Mail_id"
                    value="<?php echo htmlspecialchars($main_datails['Mail_id']); ?>" required>

                <label for="Password">Password:</label>
                <input type="text" id="Password" name="Password"
                    value="<?php echo htmlspecialchars($main_datails['Password']); ?>" required>



                <button type="submit">Update Details</button></b>
        </form>
        <?php
    } else {
        echo "<p>Main details not found. <a href='Main_Profile.php'>Click here to go back</a></p>";

        
    }

    $stmt->close();
    $conn->close();
    ?>
    </div>

</body>

</html>