<?php 
include 'dbconfig.php'; 




function loaduseraccesstype($username)
{
    include 'dbconfig.php';
    $query = "Select * from `useracct` Where username Like '". $username. "'";
    $datame = mysqli_query($sqlcon, $query);
	
		if(mysqli_num_rows($datame)!=0)
		{
		  while($row = mysqli_fetch_assoc($datame)) 
		  {
		  $codecomplete = $row["accounttype"]; 
		  }
		}
		else
		{
		  $codecomplete = $query; 
		}
		
      return $codecomplete;
}



@$otp = $_POST['theotp'];
@$username = $_POST['theusername'];


$sqlme = "SELECT * from `useracct` Where `verificationcode` Like '$otp' and username Like '$username'"; 

$dbt = mysqli_query($sqlcon,$sqlme); 


if(!mysqli_error($sqlcon))
{
  if(mysqli_num_rows($dbt)!=0)
  {
    $sql2 = "UPDATE `useracct` SET `verified`='yes' Where username Like '$username'"; 
    mysqli_query($sqlcon,$sql2); 
    
    if(!mysqli_error($sqlcon))
    {
        $huan = $_POST['usname'];
        $two = $_POST['psname'];
        $myaccount = loaduseraccesstype($huan);
        $setlimit = 10000;
        $viewtype = "Deck Management Level";
        setcookie('usname', $huan, time()+$setlimit);
        setcookie('psword', $two, time()+$setlimit);
        setcookie('account',$myaccount , time()+$setlimit);

        setcookie('viewtype',$viewtype , time()+$setlimit);

        echo 1;
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }  
  }
  else 
  {
    echo 2; 
  }
}
else 
{
    echo mysqli_error($sqlcon); 
}









?> 