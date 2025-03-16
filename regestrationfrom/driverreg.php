<!DOCTYPE html>
<html >
<head>
    
    <title>Driver Registration Form</title>
</head>
<body>

    <h1>Driver Registration Form</h1>

    <form action="register_process.php" method="POST">
        <table border="5" cellpadding="5" cellspacing="1">
            <tr>
                <td>*Applicant's Name :</td>
                <td><input type="text" name="applicant_name" required></td>
            </tr>
            <tr>
                <td>Father/Husband's Name:</td>
                <td><input type="text" name="father_husband_name"></td>
            </tr>
            <tr>
                <td>Mother's Name:</td>
                <td><input type="text" name="mother_name"></td>
            </tr>
            <tr>
                <td>*Nationality:</td>
                <td><input type="checkbox" id="bangladeshi" name="nationality" value="Bangladeshi"> Bangladeshi
                    <input type="checkbox" id="others" name="nationality" value="Others"> Others
                     <input type="text" name="otherNationality" placeholder="Enter nationality">
                </td>
            </tr>
            <tr>
                <td>*Gender:</td>
                <td>
                    <input type="radio" name="gender" value="male"> Male
                    <input type="radio" name="gender" value="female"> Woman
                    <input type="radio" name="gender" value="other"> Other
                </td>
            </tr>
            <tr>
                <td>*Date of Birth:</td>
                <td>
                    <input type="number" name="dob_day" placeholder="Day" size="5"> 
                    <input type="text" name="dob_month" placeholder="Months" size="5"> 
                    <input type="number" name="dob_year" placeholder="Year" size="7">
                </td>
            </tr>
            <tr>
                <td>*National ID:</td>
                <td> 
                    <input type="text" name="id_number" id_num="Enter ID Number" required>
                </td>
            </tr>
            <tr>
                <td>*Driving License:</td>
                <td>
                     
                    <input type="text" name="id_number" id_num="Enter ID Number" required>
                </td>
            </tr>
            
            <tr>
                <td>*Driving Experience (Years):</td>
                <td><input type="number" name="experience"  placeholder="Enter years of experience" required></td>
            </tr>
            <tr>
                <td>*Mobile Number:</td>
                <td><input type="number" name="mobile" required></td>
            </tr>
            <tr>
                <td>Address :</td>
                <td><textarea name="address" rows="3"></textarea></td>
            </tr>
            <tr>
                <td>Others info(if any):</td>
                <td><textarea name="other_info" rows="3"></textarea></td>
            </tr>
        </table>

        <p>
        I hereby certify that the information provided is correct. The information provided will be stored in the digital database and used for research purposes.
        </p>

        <input type="submit" value="Submit">
    </form>

</body>
</html>