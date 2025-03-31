<?php
// Connect to the database
$host = 'localhost';
$dbname = 'user';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        $mail_id = $_POST['mail_id'];
        $Number = $_POST['Number'];

        // Check if the FCS number already exists in the database
        $checkSql = "SELECT COUNT(*) FROM authenticationdetails WHERE FCS = :FCS";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute([':FCS' => $fcs]);
        $fcsExists = $checkStmt->fetchColumn();

        if ($fcsExists > 0) {
            echo "Family has been already registered! <a href='Family_Registration.html'>Go back to Family Registration</a>";
        } else {
            // Family members details
            $aadhaar = isset($_POST['familyMembers']) ? array_column($_POST['familyMembers'], 'aadhaar') : [];
            $names = isset($_POST['familyMembers']) ? array_column($_POST['familyMembers'], 'name') : [];
            $dobs = isset($_POST['familyMembers']) ? array_column($_POST['familyMembers'], 'dob') : [];
            $relations = isset($_POST['familyMembers']) ? array_column($_POST['familyMembers'], 'relation') : [];

            // Prepare family members data as a JSON string
            $familyData = [];
            if (count($aadhaar) > 0 && count($names) > 0 && count($dobs) > 0 && count($relations) > 0) {
                for ($i = 0; $i < count($aadhaar); $i++) {
                    if (!empty($aadhaar[$i]) && !empty($names[$i]) && !empty($dobs[$i]) && !empty($relations[$i])) {
                        $familyData[] = [
                            'aadhaar' => $aadhaar[$i],
                            'name' => $names[$i],
                            'dob' => $dobs[$i],
                            'relation' => $relations[$i]
                        ];
                    }
                }
            }

            // Convert family data array to JSON
            $familyJson = !empty($familyData) ? json_encode($familyData) : null;

            // Insert data into the database
            $sql = "INSERT INTO authenticationdetails (FCS, headAadhar, NameOfHead, DOB, Voters, Education, Village, Mandal, District, Phone_number, Mail_id, familyMembers) 
                    VALUES (:FCS, :headAadhar, :NameOfHead, :DOB, :Voters, :Education, :Village, :Mandal, :District, :Phone_number, :Mail_id, :familyMembers)";
            $stmt = $conn->prepare($sql);
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
                ':Mail_id' => $mail_id,
                ':familyMembers' => $familyJson
            ]);

            echo "Family has been successfully registered! <a href='Family_AuthenticationDetails.html'>Go back to Family Registration</a>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
