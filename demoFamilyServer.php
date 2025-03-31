<?php
// Database connection details
$host = 'localhost';
$dbname = 'user';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Head of Family details
    $fcs = $_POST['FCS'];
    $headAadhaar = $_POST['headAadhar'];
    $nameOfHead = $_POST['NameOfHead'];
    $dob = $_POST['DOB'];
    $voters = $_POST['Voters'];
    $education = $_POST['Education'];
    $village = $_POST['Village'];
    $mandal = $_POST['Mandal'];
    $district = $_POST['District'];
    $Number = $_POST['Number'];
    $Mail_id = $_POST['Mail_id'];

    // Check if the FCS number already exists in the database
    $checkSql = "SELECT COUNT(*) FROM authenticationdetails WHERE FCS = :FCS";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->execute([':FCS' => $fcs]);
    $fcsExists = $checkStmt->fetchColumn();

    if ($fcsExists > 0) {
        echo "Family has been already registered! <a href='Family_Registration.html'>Go back to Family Registration</a>";
    } else {
        // Family Members details
        $aadhaar = isset($_POST['aadhaar']) ? $_POST['aadhaar'] : [];
        $names = isset($_POST['name']) ? $_POST['name'] : [];
        $dobs = isset($_POST['dob']) ? $_POST['dob'] : [];
        $relations = isset($_POST['relation']) ? $_POST['relation'] : [];

        // Convert family members data into JSON
        $familyData = [];
        for ($i = 0; $i < count($aadhaar); $i++) {
            $familyData[] = [
                'aadhaar' => $aadhaar[$i],
                'name' => $names[$i],
                'dob' => $dobs[$i],
                'relation' => $relations[$i]
            ];
        }
        $familyJson = json_encode($familyData);

        // Insert the data into the database
        $sql = "INSERT INTO authenticationdetails (FCS, headAadhar, NameOfHead, DOB, Voters, Education, Village, Mandal, District, Phone_number, Mail_id, FamilyMembers) 
                VALUES (:FCS, :headAadhar, :NameOfHead, :DOB, :Voters, :Education, :Village, :Mandal, :District, :Phone_number, :Mail_id, :FamilyMembers)";
        $stmt = $conn->prepare($sql);

        try {
            // Execute the statement
            $stmt->execute([
                ':FCS' => $fcs,
                ':headAadhar' => $headAadhaar,
                ':NameOfHead' => $nameOfHead,
                ':DOB' => $dob,
                ':Voters' => $voters,
                ':Education' => $education,
                ':Village' => $village,
                ':Mandal' => $mandal,
                ':District' => $district,
                ':Phone_number' => $Number,
                ':Mail_id' => $Mail_id,
                ':FamilyMembers' => $familyJson
            ]);

            echo "Family has been successfully registered! <a href='Family_Registration.html'>Go back to Family Registration</a>";
        } catch (PDOException $e) {
            // Handle insertion error
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
