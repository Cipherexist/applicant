<?php 
if(!empty($_COOKIE['usname']) && !empty($_COOKIE['psword'])){ 

$sname = $_COOKIE['usname'];
$pword = $_COOKIE['psword'];
include 'dbconfig.php';

$fetchqry  = "SELECT * FROM `urzxkokt_vir`.`useracct` WHERE username LIKE '". $sname  ."' AND accounttype LIKE 'applicant' AND password LIKE '". $pword ."'" ; //SQL FORMAT FOR SEARCHING 

$result=mysqli_query($sqlcon,$fetchqry);
$num_row=mysqli_num_rows($result);

if ($num_row != 0) 
{

} 
else 
{
echo '
<script> 
window.location.replace("index.html");</script> 
';	
}

}
else 
{ 
echo '
<script> 
window.location.replace("index.html");
</script> 
';	
} 


?> 


