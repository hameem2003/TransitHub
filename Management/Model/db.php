<?php
class mydb {

    // 1) Open connection
    function openCon() {
        $dbhost    = "localhost";
        $dbusername= "root";
        $dbpassword= "";
        $dbname    = "transithub_db";  

        $connobject = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
        if ($connobject->connect_error) {
            die("Connection failed: " . $connobject->connect_error);
        }
        return $connobject;
    }

    // 2) Add a new admin (or customer)
    function addAdmin($table, $name, $email, $phone, $location, $password, $dob, $photoPath, $connobject) {
        $sql = "INSERT INTO $table
          (name, email, phone, location, password, dob, photo)
         VALUES
          ('$name', '$email', '$phone', '$location', '$password', '$dob', '$photoPath')";
        return $connobject->query($sql);
    }

    // 3) Authenticate user (admin or customer)
    function login($table, $email, $password, $connobject) {
        $sql = "SELECT * FROM $table
                WHERE email='$email' AND password='$password'";
        return $connobject->query($sql);
    }

    // 4) Fetch all users from a table
    function showAllUsers($table, $connobject) {
        $sql = "SELECT * FROM $table";
        return $connobject->query($sql);
    }

    // 5) Fetch a single user by ID
    function searchUserByID($table, $connobject, $id) {
        $sql = "SELECT * FROM $table WHERE id='$id'";
        return $connobject->query($sql);
    }

    // 6) Update user by ID
    function updateUserByID($table, $connobject, $id,
                             $name, $email, $phone, $location,
                             $password, $dob, $photoPath) {
        $sql = "UPDATE $table SET
                  name='$name',
                  email='$email',
                  phone='$phone',
                  location='$location',
                  password='$password',
                  dob='$dob',
                  photo='$photoPath'
                WHERE id='$id'";
        return $connobject->query($sql);
    }

    // 7) Delete user by ID
    function deleteUserByID($table, $connobject, $id) {
        $sql = "DELETE FROM $table WHERE id='$id'";
        return $connobject->query($sql);
    }

    // 8) Check for duplicate email
    function checkEmailExists($table, $email, $connobject) {
        $sql = "SELECT id FROM $table WHERE email='$email'";
        $res = $connobject->query($sql);
        return ($res && $res->num_rows > 0);
    }
}
?>
