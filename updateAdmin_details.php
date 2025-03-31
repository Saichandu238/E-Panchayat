<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Update Admin Details</h2>
    <h4>Admin Id cannot be changed </h4>
    <?php
    session_start(); // Start the session

    // Check if the employeeId is set in the session
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

    // Fetch MRO details based on employee ID
    $sql = "SELECT * FROM admindetails WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $mro = $result->fetch_assoc();

    if ($mro) {
        ?>
        <form action="updateAdmin_details2.php" method="POST">
            <label for="admin_id">Admin ID</label>
            <input type="text" name="admin_Id" value="<?php echo htmlspecialchars($ID); ?>">
            
            <label for="Name">Name:</label>
            <input type="text" id="Name" name="Name" value="<?php echo htmlspecialchars($mro['Name']); ?>" required>

            <label for="Aadhar Number">Aadhar Number:</label>
            <input type="text" id="Aadhar Number" name="Aadhar_Number" value="<?php echo htmlspecialchars($mro['Aadhar_number']); ?>" required>

            <!-- <label for="DOB">Date Of Birth</label>
            <input type="date" id="DOB" name="DOB" value="<?php echo htmlspecialchars($mro['DOB']); ?>" required> -->

            <label for="Date Of Joining">Date Of Joining</label>
            <input type="date" id="JoiningDate" name="Joining_date" value="<?php echo htmlspecialchars($mro['Joining_date']); ?>" required>

            <label for="Date Of Ending">Date Of Ending</label>
            <input type="date" id="EndingDate" name="ending_date" value="<?php echo htmlspecialchars($mro['ending_date']); ?>" required>

            <label for="village">Village of Working</label>
            <input type="text" id="village" name="Village" value="<?php echo htmlspecialchars($mro['Village']); ?>" required>

            <label for="Mandal">Mandal of Working</label>
            <input type="text" id="Mandal" name="Mandal" value="<?php echo htmlspecialchars($mro['Mandal']); ?>" required>

            <label for="District">District of Working</label>
            <input type="text" id="District" name="District" value="<?php echo htmlspecialchars($mro['District']); ?>" required>

            <label for="Number">Number</label>
            <input type="text" id="Number" name="Number" value="<?php echo htmlspecialchars($mro['Number']); ?>" required>

            <label for="Gmail">Gmail</label>
            <input type="text" id="Gmail" name="Gmail" value="<?php echo htmlspecialchars($mro['Gmail']); ?>" required>

            <label for="Password">Password</label>
            <input type="text" id="Password" name="Password" value="<?php echo htmlspecialchars($mro['Password']); ?>" required>

            <!-- <label for="village">Village:</label>
            <input type="text" id="village" name="village" value="<?php echo htmlspecialchars($mro['Password']); ?>" required> -->

            <button type="submit">Update Details</button>
        </form>
        <?php
    } else {
        echo "<p>MRO not found. <a href='Admin_Profile.php'>Click here to go back</a></p>";

        
    }

    $stmt->close();
    $conn->close();
    ?>
</div>

</body>
</html>
