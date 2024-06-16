<?php 
include "dbconfig.php"; 
include "loadprogress.php"; 

@$myusername = $_COOKIE['usname']; 

@$passport_docs = $_POST['mypassport_docs']; 
@$passport_issue = $_POST['mypassport_issue']; 
@$passport_valid = $_POST['mypassport_valid']; 
@$sirb_docs = $_POST['mysirb_docs']; 
@$sirb_issue = $_POST['mysirb_issue']; 
@$sirb_valid = $_POST['mysirb_valid']; 
@$poea_docs = $_POST['mypoea_docs']; 
@$poea_issue = $_POST['mypoea_issue']; 
@$poea_valid = $_POST['mypoea_valid']; 
@$nbi_docs = $_POST['mynbi_docs']; 
@$nbi_issue = $_POST['mynbi_issue']; 
@$nbi_valid = $_POST['mynbi_valid']; 
@$marina_docs = $_POST['mymarina_docs']; 
@$marina_issue = $_POST['mymarina_issue']; 
@$marina_valid = $_POST['mymarina_valid']; 
@$visa_docs = $_POST['myvisa_docs']; 
@$visa_issue = $_POST['myvisa_issue']; 
@$visa_valid = $_POST['myvisa_valid'];



$sql = "UPDATE `applicantinfo` SET ". 
"`passport_doc`='$passport_docs',".
"`passport_issue`='$passport_issue',".
"`passport_valid`='$passport_valid',".
"`sirb_doc`='$sirb_docs',".
"`sirb_issue`='$sirb_issue',".
"`sirb_valid`='$sirb_valid',".
"`poea_doc`='$poea_docs',".
"`poea_issue`='$poea_issue',".
"`poea_valid`='$poea_valid',".
"`nbi_doc`='$nbi_docs',".
"`nbi_issue`='$nbi_issue',".
"`nbi_valid`='$nbi_valid',".
"`marina_doc`='$marina_docs',".
"`marina_issue`='$marina_issue',".
"`marina_valid`='$marina_valid',".
"`visa_doc`='$visa_docs',".
"`visa_issue`='$visa_issue',".
"`visa_valid`='$visa_valid' ".
" Where username Like '$myusername'"; 

//echo $sql; 

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


