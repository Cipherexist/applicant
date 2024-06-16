<?php 

function getmyid($username)
{
    include 'dbconfig.php'; 
    @$user = $username; 
    @$myid = ""; 

    @$sql = "Select * from `applicantinfo` Where `username` Like '$user'"; 

    $dbt = mysqli_query($sqlcon,$sql); 
    
    while($rows = mysqli_fetch_assoc($dbt))
    {
       @$idnumber = (int)$rows['ID'];
       $myid =   "APPID-". sprintf('%04d', $idnumber);

    }

    return $myid;
}


$username = $_COOKIE['usname'] ; 
@$myid = getmyid($username);
$user = loadcompletename($username) . " ($myid)"; 

echo "<h5> Welcome Back, " . $user . "</h5>"; 

include "picmodesshow.php";
?>

