<html>
    <head>

    <title> Regestration from with Validation </title>
    <script src="formjs.js" ></script>
</head>
<body>
<?php include "../control/submitpage.php"; ?>

<form  action=" " method = post>
Applicant's Name :  <input type="text" name="aname"><?php echo $nameerror; ?><br><br>
Father/Husband's Name:  <input type="text" name="fh_name"><?php echo $fherror; ?><br><br>
Nationality: <input type="text" name="nationality"><?php echo $nationerror; ?><br><br>
Gender: <input type="text" name="gender"><?php echo $gendererror; ?><br><br>
Date of Birth: <input type="date" id="dob"name="dob"><?php echo $doberror; ?><br><br>
Mobile Number: <input type="text" id="mnumber"name="mnumber"><?php echo $mobileerror; ?><br><br>
National Identity Card no: <input type="text" id="nidnum"name="nidnum"><?php echo $niderror; ?><br><br>
Password: <input type="password" id="password" name="password"><?php echo $passerror; ?><br><br>
Confirm Password: <input type="password" id="cpassword" name="cpassword"><?php echo $cpasserror; ?><br><br>
Address: <input type="text" id="address"name="address"><?php echo $addresserror; ?><br><br>
Other info(if any): <input type="text" id="other_info" name="other_info"><?php echo $othererror; ?> <br> <br>

<input type="submit" value="submit"> 

</form>

<h2 ><?php echo $success; ?></h2>

</body>
</html>