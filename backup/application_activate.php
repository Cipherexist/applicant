<?php 

@$myfunction = $_POST['functionset']; 
@$myhirhingid = $_POST['hiringidset']; 
@$userid = $_POST['username']; 



include "dbconfig.php"; 

$updateno = "UPDATE `monitoring_quiz` SET `active`='' Where `username` Like '$userid'" ; 

mysqli_query($sqlcon,$updateno); 

if(!mysqli_error($sqlcon))
{
   

    $mysql = "UPDATE `monitoring_quiz` SET `active`='yes' Where `username` Like '$userid' and `hiringid` Like '$myhirhingid' and `functionid` Like '$myfunction'" ; 


    mysqli_query($sqlcon,$mysql); 


    if(!mysqli_error($sqlcon))
    {
        echo 1; 
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }




}
else 
{
    echo mysqli_error($sqlcon); 
}







?> 
