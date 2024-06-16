<?php 

/*

@$myviewtype = $_POST['rsviewtype']; 
@$mycompetence = $_POST['rscompetence']; 
@$mysession = $_POST['rssession']; 
@$username = $_COOKIE['usname']; 
@$thehiring = $_POST['rshiring']; 




@$sqlme =  "DELETE from `onlineresults` Where username Like '$username' and course Like '$myviewtype' and session Like '$mysession'"; 

$dba = mysqli_query($sqlcon,$sqlme); 

if (!mysqli_error($sqlcon))
{
        echo 1; 
}
else 
{
    echo mysqli_error($sqlcon); 
}

*/
include 'dbconfig.php'; 
include 'modules.php'; 
@$myusername = $_COOKIE['usname']; 

$qqq = "SELECT * from `monitoring_quiz` Where `username` Like '$myusername' and `active` Like 'yes'"; 

$das = mysqli_query($sqlcon,$qqq); 


if(!mysqli_error($sqlcon))
{
  while($dd = mysqli_fetch_assoc($das))
  {
    @$theviewtype =  $dd['functionid'];
    @$thehiring =  $dd['hiringid']; 
    $mysession = loadmysession($myusername,$thehiring,$theviewtype); 

    $sessionupdate = (int)$mysession + 1; 
    updatesession($myusername,$thehiring,$theviewtype,$sessionupdate); 
    updatetimer($myusername,$thehiring,$theviewtype,"10:00"); 
 //   updatetimer($myusername,$thehiring,$theviewtype,"10:00"); 
    echo  1; 

}

  

}
else 
{
  echo mysqli_error($sqlcon); 
}






?>

