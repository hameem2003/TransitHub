function data()
    {
        let errorSpans = document.querySelectorAll("span");
    errorSpans.forEach(span => span.innerHTML = "");
    
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
        document.getElementById("error").innerHTML ="All Fields are mendatory";
        return false;
    }
     if (!isNaN(a)) {
    document.getElementById("a_error").innerHTML = "Name must contain only letters.";
    return false;
    }
     if (!isNaN(b)) {
        document.getElementById("fh_name_error").innerHTML = "Name must contain only letters.";
        return false;
    }
     if (!isNaN(c)) {
        document.getElementById("nationality_error").innerHTML = "Nationality must contain only letters.";
        return false;
    }
     if (!(d == "man" || d == "woman" || d == "others")) {
        document.getElementById("gender_error").innerHTML = "Gender must be 'Man', 'Woman', or 'Others'.";
        return false;
    }
    if(g.length<11||g.length>11)
    {
        document.getElementById("mnumber_error").innerHTML = "Mobile number must be exactly 11 digits.";
        return false;
    }
     if (isNaN(g)) {
    document.getElementById("mnumber_error").innerHTML = "Mobile number contain only  number.";
    return false;
    }
     if (isNaN(f)) {
        document.getElementById("nidnum_error").innerHTML = "NID number contain only  number.";
        return false;
        }
     if (pass.length < 6) {
            document.getElementById("password_error").innerHTML = "Password must be at least 6 characters long.";
            return false;
    }
     if (pass !== cpass) {
            document.getElementById("cpassword_error").innerHTML = "Passwords do not match.";
            return false;
        }
    return true;

    }