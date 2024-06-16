<?php 
include 'dbconfig.php'; 
include 'modules.php'; 




@$verifiercode = $_GET['vercode']; 

@$regdate = loadregistrationdatetoday(); 




@$mysql = "UPDATE `monitor_applicant` SET `confirmation`='Cancel',`confirmationdate`='$regdate',`confirmremarks`='Unavailable via Email Link' Where `verifiercode`='$verifiercode'"; 



mysqli_query($sqlcon,$mysql); 



if(!mysqli_error($sqlcon))
{
 echo "<h4 style='color:red;'>Your Schedule is Cancelled</h4>";
}
else 
{
    echo mysqli_error($sqlcon);
}
















?> 


