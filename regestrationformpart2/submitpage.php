<html>
<head></head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $aname     = $_POST["aname"];
    $fh_name   = $_POST["fh_name"];
    $nationality = $_POST["nationality"];
    $gender    = $_POST["gender"];
    $dob       = $_POST["dob"];
    $mnumber   = $_POST["mnumber"];
    $nidnum    = $_POST["nidnum"];
    $password  = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $address   = $_POST["address"];
    $other     = $_POST["other_info"];

    $error = 0;

    // 1. Check all fields are filled
    if ($aname == "" || $fh_name == "" || $nationality == "" || $gender == "" || $dob == "" || $mnumber == "" || $nidnum == "" || $password == "" || $cpassword == "" || $address == "" || $other == "") {
        echo "<h3>All fields are required.</h3>";
        $error = 1;
    }

    // 2. Check password has 6 characters
    $pcount = 0;
    for ($i = 0; isset($password[$i]); $i++) {
        $pcount++;
    }
    if ($pcount != 6) {
        echo "<h3>Password must be exactly 6 characters.</h3>";
        $error = 1;
    }

    // 3. Check mobile number is digits
    for ($i = 0; isset($mnumber[$i]); $i++) {
        if ($mnumber[$i] < '0' || $mnumber[$i] > '9') {
            echo "<h3>Mobile number must contain only digits.</h3>";
            $error = 1;
            break;
        }
    }

    // 4. Check NID number is digits
    for ($i = 0; isset($nidnum[$i]); $i++) {
        if ($nidnum[$i] < '0' || $nidnum[$i] > '9') {
            echo "<h3>NID number must contain only digits.</h3>";
            $error = 1;
            break;
        }
    }

    // 5. Check password match
    if ($password != $cpassword) {
        echo "<h3>Passwords do not match.</h3>";
        $error = 1;
    }

    // Final success
    if ($error == 0) {
        echo "<h1>Your data has been submitted successfully.</h1>";
    }

}

?>

</body>
</html>
