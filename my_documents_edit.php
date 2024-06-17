<?php
include 'dbconfig.php'; 
require 'modules.php'; 

if(isset($_POST['id']))
{

  @$id = $_POST['id']; 
  @$docnumber = $_POST['docnumber']; 
  @$issuedate = $_POST['issuedate']; 
  @$expirydate = $_POST['expirydate']; 
  @$username = $_COOKIE['usname']; 
  @$regdate = loadregistrationdatetoday(); 

  @$sqlme = "UPDATE `userdocuments` SET `docnumber`='$docnumber', `issuedate`='$issuedate', `expirydate`='$expirydate', `user_update`='$username', `docdate`='$regdate' Where `ID` Like '$id'";

  mysqli_query($sqlcon, $sqlme); 

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
  echo "no id is set"; 
}
?>

