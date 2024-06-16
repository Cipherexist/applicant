<?php 
include "dbconfig.php"; 
include "loadprogress.php"; 

@$myusername = $_COOKIE['usname']; 


@$highesteducation = $_POST['myhighesteducation']; 
@$coursedegree = $_POST['mycoursedegree']; 
@$yearstarted = $_POST['myyearstarted']; 
@$schoolattended = $_POST['myschoolattended']; 
@$yearcompleted = $_POST['myyearcompleted']; 


$sql = "UPDATE `applicantinfo` SET `highesteducation`='$highesteducation',`coursedegree`='$coursedegree',`yearstarted`='$yearstarted',". 
"`schoolattended`='$schoolattended',`yearcompleted`='$yearcompleted'". 
" Where username Like '$myusername'"; 

mysqli_query($sqlcon,$sql); 

if(!mysqli_error($sqlcon))
{
   echo showprogress(); 
    
}
else 
{
    echo mysqli_error($sqlcon); 
}













?> 


