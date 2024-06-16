<?php 
include 'dbconfig.php'; 
include 'modules.php'; 



@$username = $_POST['myusername']; 
@$hiringid = $_POST['myhiring'];
@$status = $_POST['mystatus'];
@$remarks = $_POST['myremarks'];
@$confirmationdate = loadregistrationdatetoday(); 


@$mysql =  "UPDATE `monitor_applicant` SET `confirmation`='$status',`confirmationdate`='$confirmationdate',`confirmremarks`='$remarks' Where `applicantusername` Like '$username' and `hiringid` Like '$hiringid'";

mysqli_query($sqlcon,$mysql); 


if(!mysqli_error($sqlcon))
{
if($status='Confirm')
{
    echo "<p class='text-success'>Schedule to Confirmed</p>"; 

}
else 
{
    echo "<p class='text-danger'>Schedule to be Cancelled</p>"; 
}

}
else 
{
    echo mysqli_error($sqlcon); 

}






?> 