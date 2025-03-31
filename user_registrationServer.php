<?php
// Connect to the database
$host = 'localhost';
$dbname = 'user';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fsc = $_POST['FSC_number'];
    $Name = $_POST['Name'];
    $Aadhar_number = $_POST['Aadhar_number'];
    $Village = $_POST['Village'];
    $Mandal = $_POST['Mandel'];
    $District = $_POST['District'];
    $Number = $_POST['Number'];
    $Gmail = $_POST['mail-id'];
    $Password = $_POST['Password'];
    $confirm_password = $_POST['Conform_Password'];

    // Check if passwords match
    if ($Password !== $confirm_password) {
        die("Passwords do not match!");
    }

    // Function to generate a unique user_id
    function generateUniqueUserId($conn) {
        do {
            $user_id = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $sql_check = "SELECT COUNT(*) AS count FROM user_registration WHERE user_id = ?";
            $stmt = $conn->prepare($sql_check);
            $stmt->bind_param('s', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        } while ($row['count'] > 0); // Loop until a unique user_id is found
        return $user_id;
    }

    $user_id = generateUniqueUserId($conn);

    // Verify the details against the authenticationdetails table
    $authSql = "SELECT COUNT(*) FROM authenticationdetails WHERE FCS = ? AND Village = ? AND Mandal = ? AND District = ? AND Phone_number = ? AND Mail_id = ?";
    $authStmt = $conn->prepare($authSql);
    $authStmt->bind_param('ssssss', $fsc, $Village, $Mandal, $District, $Number, $Gmail);
    $authStmt->execute();
    $authStmt->bind_result($authExists);
    $authStmt->fetch();
    $authStmt->close();

    if ($authExists > 0) {
        // Check if aadhar_number or email already exists
        $sql_check_existing = "SELECT COUNT(*) AS count FROM user_registration WHERE Aadhar_number = ? OR Mail_id = ? OR FSC_number = ?";
        $stmt_check = $conn->prepare($sql_check_existing);
        $stmt_check->bind_param('sss', $Aadhar_number, $Gmail, $fsc);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();
        $stmt_check->close();

        if ($row_check['count'] > 0) {
            echo "Error: Aadhar number or email already exists.";
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO user_registration (user_id, FSC_number, Name, Aadhar_number, Village, Mandal, District, Phone_number, Mail_id, Password)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssssssss', $user_id, $fsc, $Name, $Aadhar_number, $Village, $Mandal, $District, $Number, $Gmail, $Password);

            if ($stmt->execute()) {
                echo "User registered successfully, with user_id: " . $user_id , $Gmail;
                include "user_login.html";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        echo "No matching record found in authenticationdetails.";
    }
}

$conn->close();
?>