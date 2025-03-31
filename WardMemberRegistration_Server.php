<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "villagelogins"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique 10-digit ID
function generateUniqueID($conn) {
    do {
        $unique_id = rand(1000000000, 9999999999); // Generate a random 10-digit number
        $query = "SELECT * FROM admindetails WHERE ID = '$unique_id'";
        $result = $conn->query($query);
    } while ($result->num_rows > 0); // Repeat until a unique ID is found

    return $unique_id;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['Name'];
    $aadhar_number = $_POST['Aadhar_number'];
    $ward_number = $_POST['Ward_Number'];
    $joining_date = $_POST['Joining_date'];
    $ending_date = $_POST['ending_date'];
    $village = $_POST['Village'];
    $mandal = $_POST['Mandal'];
    $district = $_POST['District'];
    $phone_number = $_POST['Number'];
    $email = $_POST['mail-id'];
    $password = $_POST['Password'];

    // Check if the Aadhaar number already exists
    $checkQuery = "SELECT * FROM wardmemberdetails WHERE Aadhar_number = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $aadhar_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Aadhaar number already exists
        echo "Ward Member already registered with this Aadhaar number.";
    } else {
        // Check if the Mail ID already exists
        $checkQuery = "SELECT * FROM wardmemberdetails WHERE Gmail = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email ID already exists
            echo "Ward Member already registered with this Mail ID.";
        } else {
            // Check if the Phone number already exists
            $checkQuery = "SELECT * FROM wardmemberdetails WHERE Number = ?";
            $stmt = $conn->prepare($checkQuery);
            $stmt->bind_param("s", $phone_number);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Phone number already exists
                echo "Ward Member already registered with this Phone Number.";
            } else {
                // Generate a unique 10-digit ID for the ward member
                $admin_id = generateUniqueID($conn);

                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO wardmemberdetails (ID, Name, Aadhar_number, Ward_Number, Joining_date, ending_date, Village, Mandal, District, Number, Gmail, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssssssss", $admin_id, $name, $aadhar_number, $ward_number, $joining_date, $ending_date, $village, $mandal, $district, $phone_number, $email, $password);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "Ward Member registered successfully. Your Ward Member ID is: " . $admin_id;
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        }
    }

    echo '<br>Click here to go back to <a href="Admin_Profile.php">Profile page</a>';

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
