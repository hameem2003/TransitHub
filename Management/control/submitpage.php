<?php
$nameerror = $fherror = $nationerror = $gendererror = $doberror = "";
$mobileerror = $niderror = $passerror = $cpasserror = $addresserror = $othererror = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["aname"])||!is_numeric($_POST["aname"])) {
        $nameerror = "Name is required. and Name cannot be a number.";
    }

    if (empty($_POST["fh_name"])) {
        $fherror = "Father's name is required.";
    }

    if (empty($_POST["nationality"])) {
        $nationerror = "Nationality is required.";
    }

    if (empty($_POST["gender"])) {
        $gendererror = "Gender is required.";
    }

    if (empty($_POST["dob"])) {
        $doberror = "Date of Birth is required.";
    }

    if (empty($_POST["mnumber"])) {
        $mobileerror = "Mobile number is required.";
    } elseif (!is_numeric($_POST["mnumber"])) {
        $mobileerror = "Mobile number must be numeric.";
    }

    if (empty($_POST["nidnum"])) {
        $niderror = "NID number is required.";
    } elseif (!is_numeric($_POST["nidnum"])) {
        $niderror = "NID number must be numeric.";
    }

    if (empty($_POST["password"])) {
        $passerror = "Password is required.";
    } elseif (isset($_POST["password"]) && strlen($_POST["password"]) != 6) {
        $passerror = "Password must be exactly 6 characters.";
    }

    if (empty($_POST["cpassword"])) {
        $cpasserror = "Confirm password is required.";
    } elseif ($_POST["password"] !== $_POST["cpassword"]) {
        $cpasserror = "Passwords do not match.";
    }

    if (empty($_POST["address"])) {
        $addresserror = "Address is required.";
    }

    if (empty($_POST["other_info"])) {
        $othererror = "Other information is required.";
    }

    if (
        $nameerror == "" && $fherror == "" && $nationerror == "" && $gendererror == "" &&
        $doberror == "" && $mobileerror == "" && $niderror == "" &&
        $passerror == "" && $cpasserror == "" && $addresserror == "" && $othererror == ""
    ) {
        $success = "Your data has been submitted successfully.";
    }
}
?>
