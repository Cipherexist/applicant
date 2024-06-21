<?php
include 'dbconfig.php'; 
require 'modules.php'; 

if(isset($_POST['id']))
{

  @$id = $_POST['id']; 
  @$docnumber = $_POST['docnumber']; 
  if(isset($_POST['issuedate']))
  {
    @$issuedate = $_POST['issuedate']; 
  }
  else 
  {
    @$issuedate = ""; 
  }

  if(isset($_POST['expirydate']))
  {
    @$expirydate = $_POST['expirydate']; 
  }
  else 
  {
    @$expirydate = ""; 
  }

  if(isset($_POST['datestart']))
  {
    @$datestart = $_POST['datestart']; 
  }
  else 
  {
    @$datestart = ""; 
  }

  if(isset($_POST['dateend']))
  {
    @$dateend = $_POST['dateend']; 
  }
  else 
  {
    @$dateend = ""; 
  }

  
  if(isset($_POST['trainingcenter']))
  {
    @$trainingcenter = $_POST['trainingcenter']; 
  }
  else 
  {
    @$trainingcenter = ""; 
  }

  if(isset($_POST['country']))
  {
    @$country = $_POST['country']; 
  }
  else 
  {
    @$country = ""; 
  }





  @$username = $_COOKIE['usname']; 
  @$regdate = loadregistrationdatetoday(); 

  @$sqlme = "UPDATE `userdocuments` SET `docnumber`='$docnumber', `issuedate`='$issuedate', `expirydate`='$expirydate', `user_update`='$username', `docdate`='$regdate',`datestart`='$datestart',`dateend`='$dateend',`trainingcenter`='$trainingcenter',`country`='$country' Where `ID` Like '$id'";

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

