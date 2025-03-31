<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user reporting Problem</title>
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
session_start();
// session_unset(); 

// $_SESSION['test'] = 'This is a test';

// Retrieve and display session variables
// echo '<pre>' . print_r($_SESSION, true) . '</pre>';


// Check if the session variables are set
if (isset($_SESSION['user_id'], $_SESSION['Name'], $_SESSION['Aadhar_Number'], $_SESSION['Village'], $_SESSION['Mandal'], $_SESSION['District'], $_SESSION['Mail_id'], $_SESSION['Number'])) {
    // Retrieve session variables
    $Village = $_SESSION['Village'];
    $Mandal = $_SESSION['Mandal'];
    $District=$_SESSION['District'];
    $Name=$_SESSION['Name'];
    $FCS=$_SESSION['FCS'];
    $user_id=$_SESSION['user_id'];
    $Gmail=$_SESSION['Gmail'];
    $Number=$_SESSION['Number'];
    $Aadhar_Number=$_SESSION['Aadhar_Number'];


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
    $sql = "INSERT INTO issues (user_id, Name, Aadhar_Number, Village, Mandal, District, Number, Mail_id, Problem_Type, LevelOfProblem, Description, Date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sssssssssss", $user_id, $Name, $Aadhar_Number, $Village, $Mandal, $District, $Number, $Gmail, $ProblemType, $LevelOfProblem, $Description);

    // Execute the query
    if ($stmt->execute()) {
        echo "Details Recorded successfully!";
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