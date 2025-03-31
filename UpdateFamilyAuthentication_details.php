<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Family Authentication Details</title>
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
        <h2>Update Family Authentication Details</h2>

        <!-- Form to input FSC number -->
        <form method="POST" action="">
            <label for="FSC">Enter FSC Number</label>
            <input type="text" name="FSC" required>
            <button type="submit">Search</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get FSC number from the form
            $FCS = $_POST['FSC'];

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "user";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch MRO details based on FSC number
            $sql = "SELECT * FROM authenticationdetails WHERE FCS = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $FCS);
            $stmt->execute();
            $result = $stmt->get_result();
            $mro = $result->fetch_assoc();

            if ($mro) {
                // Display form for editing head details
        ?>
        <form action="" method="POST">
            <label for="FSC">Enter FSC Number</label>
            <input type="text" name="FSC" value="<?php echo htmlspecialchars($mro['FCS']); ?>" required>

            <label for="Aadhar Number">Head Aadhar Number:</label>
            <input type="text" id="Aadhar Number" name="Aadhar_Number"
                value="<?php echo htmlspecialchars($mro['headAadhar']); ?>" required>

            <label for="name">Name Of Head:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($mro['NameOfHead']); ?>"
                required>

            <label for="DOB">Date Of Birth</label>
            <input type="date" id="DOB" name="DOB" value="<?php echo htmlspecialchars($mro['DOB']); ?>" required>

            <label for="Voters">Number Of Voters</label>
            <input type="text" id="Voters" name="Voters" value="<?php echo htmlspecialchars($mro['Voters']); ?>"
                required>

            <label for="Education">Number Of Educated People</label>
            <input type="text" id="Education" name="Education"
                value="<?php echo htmlspecialchars($mro['Education']); ?>" required>

            <label for="village">Village</label>
            <input type="text" id="village" name="Village" value="<?php echo htmlspecialchars($mro['Village']); ?>"
                required>

            <label for="Mandal">Mandal</label>
            <input type="text" id="Mandal" name="Mandal" value="<?php echo htmlspecialchars($mro['Mandal']); ?>"
                required>

            <label for="District">District</label>
            <input type="text" id="District" name="District" value="<?php echo htmlspecialchars($mro['District']); ?>"
                required>

            <label for="Phone_number">Phone Number</label>
            <input type="text" id="Phone_number" name="Phone_number"
                value="<?php echo htmlspecialchars($mro['Phone_number']); ?>" required>

            <label for="Mail_id">Mail ID</label>
            <input type="text" id="Mail_id" name="Mail_id" value="<?php echo htmlspecialchars($mro['Mail_id']); ?>"
                required>

            <h3>Family Members</h3>

            <?php
                // Fetch and display family members details from the JSON stored in the table
                $familyMembersJson = $mro['familyMembers'];
                $familyMembers = json_decode($familyMembersJson, true);

                if ($familyMembers) {
                    foreach ($familyMembers as $index => $member) {
                        ?>
            <h4>Family Member <?php echo $index + 1; ?></h4>
            <label for="aadhaar_<?php echo $index; ?>">Aadhar Number:</label>
            <input type="text" name="family[<?php echo $index; ?>][aadhaar]"
                value="<?php echo htmlspecialchars($member['aadhaar']); ?>" required>

            <label for="name_<?php echo $index; ?>">Name:</label>
            <input type="text" name="family[<?php echo $index; ?>][name]"
                value="<?php echo htmlspecialchars($member['name']); ?>" required>

            <label for="dob_<?php echo $index; ?>">Date of Birth:</label>
            <input type="date" name="family[<?php echo $index; ?>][dob]"
                value="<?php echo htmlspecialchars($member['dob']); ?>" required>

            <label for="relation_<?php echo $index; ?>">Relation with Head:</label>
            <input type="text" name="family[<?php echo $index; ?>][relation]"
                value="<?php echo htmlspecialchars($member['relation']); ?>" required>
            <?php
                    }
                } else {
                    echo "<p>No family members found.</p>";
                }
            ?>

            <button type="submit" name="update">Update Details</button>
        </form>

        <?php
            } else {
                echo "<p>Family details not found for FSC number: " . htmlspecialchars($FCS) . ". <a href='MRO_Profile.php'>Click here to go back</a></p>";
            }

            $stmt->close();
            $conn->close();
        }

        // If the form is submitted, process the update
        if (isset($_POST['update'])) {
            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Update head details
            $FCS = $_POST['FSC'];
            $headAadhar = $_POST['Aadhar_Number'];
            $name = $_POST['name'];
            $DOB = $_POST['DOB'];
            $Voters = $_POST['Voters'];
            $Education = $_POST['Education'];
            $Village = $_POST['Village'];
            $Mandal = $_POST['Mandal'];
            $District = $_POST['District'];
            $Phone_number = $_POST['Phone_number'];
            $Mail_id = $_POST['Mail_id'];

            // Convert family members' details back to JSON
            $familyMembers = json_encode($_POST['family']);

            // Update the database with the new details
            $sql = "UPDATE authenticationdetails SET headAadhar = ?, NameOfHead = ?, DOB = ?, Voters = ?, Education = ?, Village = ?, Mandal = ?, District = ?, Phone_number = ?, Mail_id = ?, familyMembers = ? WHERE FCS = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssssss", $headAadhar, $name, $DOB, $Voters, $Education, $Village, $Mandal, $District, $Phone_number, $Mail_id, $familyMembers, $FCS);

            if ($stmt->execute()) {
                echo "<p>Family details updated successfully.</p>";
            } else {
                echo "<p>Error updating details: " . $conn->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>

</body>

</html>