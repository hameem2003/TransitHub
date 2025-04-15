<html>
    <head>

    <title> Regestration from with Validation </title>
</head>
<body>

<script>
    function data()
    {
    var a=document.getElementById("aname").value;
    var b=document.getElementById("fh_name").value;
    var c=document.getElementById("nationality").value;
    var d=document.getElementById("gender").value;
    var e=document.getElementById("dob").value;
    var f=document.getElementById("nidnum").value;
    var pass = document.getElementById("password").value; 
    var cpass = document.getElementById("cpassword").value;
    var g=document.getElementById("mnumber").value;
    var h=document.getElementById("address").value;
    var i=document.getElementById("other_info").value;

    if(a==""||b==""||c==""||d==""||e==""||f==""||g==""||h==""||i=="")
    {
        alert("All Fields are mendatory");
        return false;
    }
    else if (!isNaN(a)) {
    document.getElementById("a_error").innerHTML = "Name must contain only letters.";
    return false;
    }
    else if (!isNaN(b)) {
        document.getElementById("fh_name_error").innerHTML = "Name must contain only letters.";
        return false;
    }
    else if (!isNaN(c)) {
        document.getElementById("nationality_error").innerHTML = "Nationality must contain only letters.";
        return false;
    }
    else if (!(d == "man" || d == "woman" || d == "others")) {
        document.getElementById("gender_error").innerHTML = "Gender must be 'Man', 'Woman', or 'Others'.";
        return false;
    }
    else if(g.length<11||g.length>11)
    {
        document.getElementById("mnumber_error").innerHTML = "Mobile number must be exactly 11 digits.";
        return false;
    }
    else if (isNaN(g)) {
    document.getElementById("mnumber_error").innerHTML = "Mobile number contain only  number.";
    return false;
    }
    else if (pass.length < 6) {
            document.getElementById("password_error").innerHTML = "Password must be at least 6 characters long.";
            return false;
    }
    else if (pass !== cpass) {
            document.getElementById("cpassword_error").innerHTML = "Passwords do not match.";
            return false;
        }
    else
    {
    true;

    }
    }
    </script>

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