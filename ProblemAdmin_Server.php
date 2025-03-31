<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem Submission</title>
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
        background-color: #45a049;
    }
    </style>
</head>

<body>

    <div class="form-container">
        <?php
session_start(); // Start the session

// Check if the session variables are set
if (isset($_SESSION['admin_id'], $_SESSION['Name'], $_SESSION['Aadhar_number'], $_SESSION['Village'], $_SESSION['Mandal'], $_SESSION['District'], $_SESSION['mail_id'], $_SESSION['Number'])) {
    // Retrieve session variables
    $ID=$_SESSION['admin_id'];
    $Village = $_SESSION['Village'];
    $Mandal = $_SESSION['Mandal'];
    $Name=$_SESSION['Name'];
    $District=$_SESSION['District'];
    $Gmail=$_SESSION['mail_id'];
    $Number=$_SESSION['Number'];
    $Aadhar_number=$_SESSION['Aadhar_number'];


    // Retrieve POST data
    $ProblemType = $_POST['Problem_Type'] ?? '';
    $Description = $_POST['Description'] ?? '';
    $LevelOfProblem = $_POST['LevelOfProblem'] ?? '';

    // Validate POST data
    if (empty($ProblemType) || empty($Description) || empty($LevelOfProblem)) {
        die("Error: Missing required POST data.");
    }

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "problems";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL insertion query
    $sql = "INSERT INTO problem (ID, Name, Aadhar_Number, Village, Mandal, District, Number, Mail_id, ProblemType, Description, LevelOfProblem, Date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sssssssssss", $ID, $Name, $Aadhar_number, $Village, $Mandal, $District, $Number, $Gmail, $ProblemType, $Description, $LevelOfProblem);

    // Execute the query
    if ($stmt->execute()) {
        echo "Details inserted successfully! <a href="Admin_Profile.php"> click here to go back</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Session values are not set.";
}

?>



    </div>

</body>

</html>