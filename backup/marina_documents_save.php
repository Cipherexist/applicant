<?php 
include "dbconfig.php"; 
include "loadprogress.php"; 

@$myusername = $_COOKIE['usname']; 

@$bt_cop_doc = $_POST['mybt_cop_doc']; 
@$bt_cop_issue = $_POST['mybt_cop_issue']; 
@$bt_cop_expiry = $_POST['mybt_cop_expiry']; 

@$sdsd_cop_doc = $_POST['mysdsd_cop_doc']; 
@$sdsd_cop_issue = $_POST['mysdsd_cop_issue']; 
@$sdsd_cop_expiry = $_POST['mysdsd_cop_expiry']; 


@$pscrb_cop_doc = $_POST['mypscrb_cop_doc']; 
@$pscrb_cop_issue = $_POST['mypscrb_cop_issue']; 
@$pscrb_cop_expiry = $_POST['mypscrb_cop_expiry']; 


@$aff_cop_doc = $_POST['myaff_cop_doc']; 
@$aff_cop_issue = $_POST['myaff_cop_issue']; 
@$aff_cop_expiry = $_POST['myaff_cop_expiry']; 

@$frb_cop_doc = $_POST['myfrb_cop_doc']; 
@$frb_cop_issue = $_POST['myfrb_cop_issue']; 
@$frb_cop_expiry = $_POST['myfrb_cop_expiry']; 

@$btlgt_cop_doc = $_POST['mybtlgt_cop_doc']; 
@$btlgt_cop_issue = $_POST['mybtlgt_cop_issue']; 
@$btlgt_cop_expiry = $_POST['mybtlgt_cop_expiry']; 

@$atlgt_cop_doc = $_POST['myatlgt_cop_doc']; 
@$atlgt_cop_issue = $_POST['myatlgt_cop_issue']; 
@$atlgt_cop_expiry = $_POST['myatlgt_cop_expiry']; 

@$btoc_cop_doc = $_POST['mybtoc_cop_doc']; 
@$btoc_cop_issue = $_POST['mybtoc_cop_issue']; 
@$btoc_cop_expiry = $_POST['mybtoc_cop_expiry']; 

@$atoc_cop_doc = $_POST['myatoc_cop_doc']; 
@$atoc_cop_issue = $_POST['myatoc_cop_issue']; 
@$atoc_cop_expiry = $_POST['myatoc_cop_expiry']; 

@$atot_cop_doc = $_POST['myatot_cop_doc']; 
@$atot_cop_issue = $_POST['myatot_cop_issue']; 
@$atot_cop_expiry = $_POST['myatot_cop_expiry']; 


$sql = "UPDATE `applicantinfo` SET ". 
"`bt_cop_doc`='$bt_cop_doc',".
"`bt_cop_issue`='$bt_cop_issue',".
"`bt_cop_expiry`='$bt_cop_expiry',".
"`sdsd_cop_doc`='$sdsd_cop_doc',".
"`sdsd_cop_issue`='$sdsd_cop_issue',".
"`sdsd_cop_expiry`='$sdsd_cop_expiry',".
"`pscrb_cop_doc`='$pscrb_cop_doc',".
"`pscrb_cop_issue`='$pscrb_cop_issue',".
"`pscrb_cop_expiry`='$pscrb_cop_expiry',".
"`aff_cop_doc`='$aff_cop_doc',".
"`aff_cop_issue`='$aff_cop_issue',".
"`aff_cop_expiry`='$aff_cop_expiry',".
"`frb_cop_doc`='$frb_cop_doc',".
"`frb_cop_issue`='$frb_cop_issue',".
"`frb_cop_expiry`='$frb_cop_expiry',".
"`btlgt_cop_doc`='$btlgt_cop_doc',".
"`btlgt_cop_issue`='$btlgt_cop_issue',".
"`btlgt_cop_expiry`='$btlgt_cop_expiry',".
"`atlgt_cop_doc`='$atlgt_cop_doc',".
"`atlgt_cop_issue`='$atlgt_cop_issue',".
"`atlgt_cop_expiry`='$atlgt_cop_expiry',".
"`btoc_cop_doc`='$btoc_cop_doc',".
"`btoc_cop_issue`='$btoc_cop_issue',".
"`btoc_cop_expiry`='$btoc_cop_expiry',".
"`atoc_cop_doc`='$atoc_cop_doc',".
"`atoc_cop_issue`='$atoc_cop_issue',".
"`atoc_cop_expiry`='$atoc_cop_expiry',".
"`atot_cop_doc`='$atot_cop_doc',".
"`atot_cop_issue`='$atot_cop_issue',".
"`atot_cop_expiry`='$atot_cop_expiry' ".
" Where username Like '$myusername'"; 

//echo $sql; 

mysqli_query($sqlcon,$sql); 

if(!mysqli_error($sqlcon))
{
    //echo "<p class='text-success'> Data Saved! AS OF ". date("F j, Y, g:i a") ." </p>"; 
    echo showprogress(); 
}
else 
{
    echo mysqli_error($sqlcon); 
}













?> 


