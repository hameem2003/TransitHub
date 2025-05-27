<?php
class myDB {
    public function openCon() {
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPassword = "";
        $DBName = "admindb";

        $conn = new mysqli($DBHost, $DBUser, $DBPassword, $DBName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function insertData($Name, $email, $password, $userName, $dateOfBirth, $phoneNumber, $adminRole, $location, $profile_Picture, $referenceName, $referenceEmail, $referencePhone, $referenceNameTwo, $referenceEmailTwo, $referencePhoneTwo, $conn) {
        $sql = "INSERT INTO admindata (Name, email, userName, password, DOB, phoneNumber, adminRole, location, picture, referenceName, referenceEmail, referencePhone, referenceNameTwo, referenceEmailTwo, referencePhoneTwo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssss", $Name, $email, $userName, $password, $dateOfBirth, $phoneNumber, $adminRole, $location, $profile_Picture, $referenceName, $referenceEmail, $referencePhone, $referenceNameTwo, $referenceEmailTwo, $referencePhoneTwo);
        if ($stmt->execute()) {
            $stmt->close();
            return 1;
        } else {
            $stmt->close();
            return "Error: " . $stmt->error;
        }
    }

    public function showAll($tableName, $conn) {
        $sql = "SELECT * FROM $tableName";
        $result = $conn->query($sql);
        return $result;
    }

    public function deleteData($id, $tableName, $conn) {
        $sql = "DELETE FROM $tableName WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->close();
            return 1;
        } else {
            $stmt->close();
            return "Error: " . $stmt->error;
        }
    }

    public function updateDataUser($id, $Name, $email, $userName, $password, $dateOfBirth, $phoneNumber, $adminRole, $location, $profile_Picture, $referenceName, $referenceEmail, $referencePhone, $referenceNameTwo, $referenceEmailTwo, $referencePhoneTwo, $tableName, $conn) {
        $sql = "UPDATE $tableName SET Name = ?, email = ?, username = ?, password = ?, DOB = ?, phoneNumber = ?, adminRole = ?, location = ?, picture = ?, referenceName = ?, referenceEmail = ?, referencePhone = ?, referenceNameTwo = ?, referenceEmailTwo = ?, referencePhoneTwo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return "Error preparing statement: " . $conn->error;
        }
        $stmt->bind_param("sssssssssssssssi", $Name, $email, $userName, $password, $dateOfBirth, $phoneNumber, $adminRole, $location, $profile_Picture, $referenceName, $referenceEmail, $referencePhone, $referenceNameTwo, $referenceEmailTwo, $referencePhoneTwo, $id);
        if ($stmt->execute()) {
            $stmt->close();
            return 1;
        } else {
            $error = "Error executing statement: " . $stmt->error;
            $stmt->close();
            return $error;
        }
    }

    public function closeCon($conn) {
        $conn->close();
    }
}
?>
