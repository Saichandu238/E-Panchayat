<?php
// Start the session only if it is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Employee_ID=$_SESSION['Employee_ID'];
$Village = $_SESSION['Village'];
$Mandal = $_SESSION['Mandal'];
$Name=$_SESSION['Name'];
$District=$_SESSION['District'];


// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "villagelogins";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Message to display after deletion attempt
$deletion_message = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the Employee ID from the form
    $employee_id = $_POST['Admin_id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM admindetails WHERE Id = ? and Mandal= '$Mandal'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employee_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $deletion_message = "Admin details with Employee ID $employee_id have been successfully deleted.";
        } else {
            $deletion_message = "No Admin found with Employee ID $employee_id.";
        }
    } else {
        $deletion_message = "Error deleting MRO details: " . $conn->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Admin Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .delete-sro-box {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .delete-sro-box h3 {
            text-align: center;
            color: #333;
        }

        .delete-sro-box form {
            display: flex;
            flex-direction: column;
        }

        .delete-sro-box label {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }

        .delete-sro-box input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .delete-sro-box input[type="submit"] {
            padding: 10px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .delete-sro-box input[type="submit"]:hover {
            background-color: #c0392b;
        }

        .message {
            text-align: center;
            font-size: 16px;
            color: green;
            margin-top: 20px;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>

<div class="delete-sro-box">
    <h3>Delete Admin Details</h3>
    <form method="POST" action="">
        <label for="Admin_id">Enter Admin ID:</label>
        <input type="text" id="Admin_id" name="Admin_id" required>
        <input type="submit" value="Delete Admin">
    </form>
    
    <!-- Display the deletion message -->
    <?php if (!empty($deletion_message)): ?>
        <p class="message <?php echo strpos($deletion_message, 'Error') !== false ? 'error-message' : ''; ?>">
            <?php echo $deletion_message; ?>
        </p>
    <?php endif; ?>
</div>

</body>
</html>
