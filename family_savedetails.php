<?php 
include "dbconfig.php"; 
include "loadprogress.php"; 

@$myusername = $_COOKIE['usname']; 


@$civilstatus = $_POST['mycivilstatus']; 
@$marriagedate = $_POST['mymarriagedate']; 
@$wifecompletename = $_POST['mywifecompletename']; 
@$wifebirthdate = $_POST['mywifebirthdate']; 
@$wifeoccupation = $_POST['mywifeoccupation']; 
@$childrens = $_POST['mychildrens']; 
@$fathername = $_POST['myfathername']; 
@$fatherbirthdate = $_POST['myfatherbirthdate']; 
@$mothername = $_POST['mymothername']; 
@$motherbirthdate = $_POST['mymotherbirthdate']; 
@$personcontact = $_POST['mypersoncontact']; 
@$personrelationship = $_POST['mypersonrelationship']; 
@$personcontactno = $_POST['mypersoncontactno']; 
@$personaddress = $_POST['mypersonaddress']; 

$sql = "UPDATE `applicantinfo` SET `civilstatus`='$civilstatus',`marriagedate`='$marriagedate',`wifecompletename`='$wifecompletename',". 
"`wifebirthdate`='$wifebirthdate',`wifeoccupation`='$wifeoccupation',". 
"`childrens`='$childrens',`fathername`='$fathername',". 
"`fatherbirthdate`='$fatherbirthdate',`mothername`='$mothername',".  "`motherbirthdate`='$motherbirthdate',`personcontact`='$personcontact',". 
"`personrelationship`='$personrelationship',`personcontactno`='$personcontactno',". "`personaddress`='$personaddress'". 
" Where username Like '$myusername'"; 

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


