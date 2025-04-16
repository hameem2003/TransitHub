<html>
    <head>

    <title> Regestration from with Validation </title>
    <script src="fromjs.js" ></script>
</head>
<body>
<form onsubmit="return data()" action="submitpage.php" >
Applicant's Name :  <input type="text" id="aname"><span id="a_error"></span><br><br>
Father/Husband's Name:  <input type="text" id="fh_name"><span id="fh_name_error"></span><br><br>
Nationality: <input type="text" id="nationality"><span id="nationality_error"></span><br><br>
Gender: <input type="text" id="gender" ><span id="gender_error"></span><br><br>
Date of Birth: <input type="date" id="dob"><span id="dob_error"></span><br><br>
Mobile Number: <input type="text" id="mnumber"><span id="mnumber_error"></span><br><br>
National Identity Card no: <input type="text" id="nidnum"><span id="nidnum_error"></span><br><br>
Password: <input type="password" id="password"><span id="password_error"></span><br><br>
Confirm Password: <input type="password" id="cpassword"><span id="cpassword_error" ></span><br><br>
Address: <input type="text" id="address"><span id="address_error"></span><br><br>
Other info(if any): <input type="text" id="other_info"><span id="other_info_error"></span> <br> <br>

<input type="submit" value="submit your data">

</form>



</body>