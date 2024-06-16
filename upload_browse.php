<?php 
require 'loadtables.php'; 
include 'dbconfig.php'; 

@$hiringid = $_POST['myhiringid']; 
@$myusername = $_COOKIE['usname']; 
   

@$sqlme = "Select * from `monitoring` Where `username` Like '$myusername' and `hiringid` Like '$hiringid' and `stage` Like '2' and `status` Like 'Completed'"; 

@$dbt = mysqli_query($sqlcon,$sqlme); 

if(!mysqli_error($sqlcon))
{
    if(mysqli_num_rows($dbt)!=0)
    {
        loadmydocumentsbyhiring($hiringid); 
    }
    else 
    {
        echo "<tr><td colspan=4><span class='text-danger'>Your Application is not yet approve to upload documents</span></td></tr>"; 
    }
    
}
else 
{
   echo mysqli_error($sqlcon); 
}




?> 

