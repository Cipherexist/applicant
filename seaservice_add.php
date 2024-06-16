<?php 
include "dbconfig.php"; 
include "loadtables.php"; 
include 'modules.php'; 
    
@$username = $_COOKIE['usname']; 

@$rank            = $_POST['myrank'];
@$vesselname = $_POST['myvesselnname'];
@$flagname = $_POST['myflagname'];
@$agencyname = $_POST['myagencyname'];
@$vesseltype = $_POST['myvesseltype'];
@$grosstonnage = $_POST['mygrosstonnage'];
@$kwpower = $_POST['mykwpower'];
@$signin = $_POST['mysignin'];
@$signout = $_POST['mysignout'];
@$reason = $_POST['myreason'];
@$totalmonths = $_POST['mytotalmonths'];


$mysql = "INSERT INTO `seaservice` (`username`,`rankid`,`vesselname`,`vesseltype`,`flag`,`grt`,`enginekw`,`signin`,`signoff`,`months`,`reason`,`previousagency`)". 
" VALUES ('$username','$rank','$vesselname','$vesseltype','$flagname','$grosstonnage','$kwpower','$signin','$signout','$totalmonths','$reason','$agencyname')"; 

mysqli_query($sqlcon,$mysql); 


if(!mysqli_error($sqlcon))
{
    echo loadseaservice();
}
else 
{
    echo mysqli_error($sqlcon); 
}







?> 