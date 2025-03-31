<?php
// Start the session only if it is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$ID = $_SESSION['Serpanch_id'];
$Village = $_SESSION['Village'];
$Mandal = $_SESSION['Mandal'];
$District=$_SESSION['District'];
$Name=$_SESSION['Name'];


// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

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
    $user_id = $_POST['user_id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM user_registration WHERE user_id = ? and Village= '$Village'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $deletion_message = "user details with user ID $user_id have been successfully deleted.";
        } else {
            $deletion_message = "No user  found with Employee ID $user_id.";
        }
    } else {
        $deletion_message = "Error deleting user details: " . $conn->error;
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
    <title>Delete user Details</title>
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
    <h3>Delete User Details</h3>
    <form method="POST" action="">
        <label for="user_id">Enter user ID:</label>
        <input type="text" id="user_id" name="user_id" required>
        <input type="submit" value="Delete User">
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
