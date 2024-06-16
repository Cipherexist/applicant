<?php 
include 'dbconfig.php'; 
include 'modules.php'; 




@$verifiercode = $_GET['vercode']; 

@$regdate = loadregistrationdatetoday(); 




@$mysql = "UPDATE `monitor_applicant` SET `confirmation`='Confirm',`confirmationdate`='$regdate',`confirmremarks`='Confirm via Email Link' Where `verifiercode`='$verifiercode'"; 



mysqli_query($sqlcon,$mysql); 



if(!mysqli_error($sqlcon))
{
 echo "<h4 style='color:green;'>Your Schedule is Confirmed</h4>";
}
else 
{
    echo mysqli_error($sqlcon);
}
















?> 


