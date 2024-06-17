<?php 
include 'dbconfig.php'; 
include 'loadmodules.php'; 
include 'loadtables.php'; 
include "forcookie.php"; 
  
@$iddoc = $_POST['id']; 
@$final = $_POST['mydecision']; 

if($final=='Recheck')
{
    $final='';
}

$sqlme = "UPDATE `userdocuments` SET `authenticity`='$final' Where ID Like '$iddoc'"; 

mysqli_query($sqlcon,$sqlme); 



if(!mysqli_error($sqlcon))
{   
    $myusername = loadtextreturn("userdocuments","username","Where ID Like '$iddoc'"); 

    echo loaduserdocuments($myusername); 
}
else 
{
    echo mysqli_error($sqlcon); 

}




?> 

