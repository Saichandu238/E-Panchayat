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

        // Verify the details against the authenticationdetails table
        $authSql = "SELECT COUNT(*) FROM authenticationdetails WHERE FCS = :FCS AND headAadhar = :headAadhar AND NameOfHead = :NameOfHead AND Voters = :Voters AND Education = :Education AND Village = :Village AND Mandal = :Mandal AND District = :District";
        $authStmt = $conn->prepare($authSql);
        $authStmt->execute([
            ':FCS' => $fcs,
            ':headAadhar' => $headAadhaar,
            ':NameOfHead' => $nameOfHead,
            ':Voters' => $voters,
            ':Education' => $education,
            ':Village' => $village,
            ':Mandal' => $mandal,
            ':District' => $district
        ]);
        $authExists = $authStmt->fetchColumn();

        if ($authExists > 0) {
            // Check if the FCS number already exists in the family_details table
            $checkSql = "SELECT COUNT(*) FROM family_details WHERE FCS = :FCS";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->execute([':FCS' => $fcs]);
            $fcsExists = $checkStmt->fetchColumn();

            if ($fcsExists > 0) {
                echo "Family has already been registered! <a href='Family_Registration.html'>Go back to Family Registration</a>";
            } else {
                // Ensure these fields are set and not empty
                $aadhaar = isset($_POST['familyMembers']) ? array_column($_POST['familyMembers'], 'aadhaar') : [];
                $names = isset($_POST['familyMembers']) ? array_column($_POST['familyMembers'], 'name') : [];
                $dobs = isset($_POST['familyMembers']) ? array_column($_POST['familyMembers'], 'dob') : [];
                $relations = isset($_POST['familyMembers']) ? array_column($_POST['familyMembers'], 'relation') : [];

                // Check if arrays are properly populated
                if (count($aadhaar) > 0 && count($names) > 0 && count($dobs) > 0 && count($relations) > 0) {
                    $familyData = [];
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

                    // Encode family data into JSON format
                    $familyJson = json_encode($familyData);

                    // Insert the data into the database
                    $insertSql = "INSERT INTO family_details (FCS, headAadhar, NameOfHead, DOB, Voters, Education, Village, Mandal, District, familyMembers) 
                                  VALUES (:FCS, :headAadhar, :NameOfHead, :DOB, :Voters, :Education, :Village, :Mandal, :District, :familyMembers)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->execute([
                        ':FCS' => $fcs,
                        ':headAadhar' => $headAadhaar,
                        ':NameOfHead' => $nameOfHead,
                        ':DOB' => $dob,
                        ':Voters' => $voters,
                        ':Education' => $education,
                        ':Village' => $village,
                        ':Mandal' => $mandal,
                        ':District' => $district,
                        ':familyMembers' => $familyJson
                    ]);

                    echo "Family has been successfully registered! <a href='Family_Registration.html'>Go back to Family Registration</a>";
                } else {
                    echo "No family members data submitted.";
                }
            }
        } else {
            // Family details not found in authenticationdetails table
            echo "No family registration record found with the provided details.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>