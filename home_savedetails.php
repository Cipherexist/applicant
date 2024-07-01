<?php 
include "dbconfig.php"; 
include "loadprogress.php"; 


@$firstname = $_POST['myfirstname']; 
@$middlename = $_POST['mymiddlename']; 
@$lastname = $_POST['mylastname']; 
@$birthdate = $_POST['mybirthdate']; 
@$placeofbirth = $_POST['myplaceofbirth']; 
@$age = $_POST['myage']; 
@$nationality = $_POST['mynationality']; 
@$citizenship = $_POST['mycitizenship']; 
@$religion = $_POST['myreligion']; 
@$gender = $_POST['mygender']; 
@$haircolor = $_POST['myhaircolor']; 
@$eyecolor = $_POST['myeyecolor']; 
@$sss = $_POST['mysss']; 
@$philhealth = $_POST['myphilhealth']; 
@$tin = $_POST['mytin']; 
@$pagibig = $_POST['mypagibig']; 
@$mobilenumber = $_POST['mymobilenumber']; 
@$emailadd = $_POST['myemailadd']; 
@$rank = $_POST['myrank']; 
@$rankapplied = $_POST['myrankapplied']; 
@$address = $_POST['myaddress']; 
@$currentaddress = $_POST['mycurrentaddress']; 
@$height = $_POST['myheight']; 
@$weight = $_POST['myweight']; 
@$myusername = $_COOKIE['usname']; 
@$facebookaccount = $_POST['myfacebookaccount'];

/* 
firstname
middlename
lastname
birthdate
placeofbirth
age
nationality
citizenship
religion
gender
haircolor
eyecolor
sss
philhealth
tin
pagibig
mobilenumber
emailadd

*/

$sql = "UPDATE `applicantinfo` SET `firstname`='$firstname',`middlename`='$middlename',`lastname`='$lastname',". 
"`birthdate`='$birthdate',`birthplace`='$placeofbirth',`age`='$age',`nationality`='$nationality',". 
"`citizenship`='$citizenship',`religion`='$religion',`address`='$address',`currentaddress`='$currentaddress',`gender`='$gender',`haircolor`='$haircolor',`eyecolor`='$eyecolor',". 
"`sss`='$sss',`philhealth`='$philhealth',`tin`='$tin',`pagibig`='$pagibig',`contactnumber`='$mobilenumber',`currentrank`='$rank',`email`='$emailadd',`applyingrank`='$rankapplied',".
"`height`='$height',`weight`='$weight',`facebookaccount`='$facebookaccount'". 
"Where username Like '$myusername'"; 

mysqli_query($sqlcon,$sql); 

if(!mysqli_error($sqlcon))
{
    //echo "<p class='text-success'> Data Saved! AS OF ". date("F j, Y, g:i a") ." </p>"; 
    echo showprogress();  
}
else 
{
    echo mysqli_error($sqlcon); 
}













?> 


