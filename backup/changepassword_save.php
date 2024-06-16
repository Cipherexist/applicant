<?php 

include "dbconfig.php"; 
include "modules.php"; 



@$oldpassword = $_POST['oldpass']; 
@$newpassword = $_POST['newpass']; 
@$newpasswordconfirm = $_POST['newpass2']; 
@$username = $_COOKIE['usname'];  

if($oldpassword!="" && $newpassword!="" && $newpasswordconfirm!="")
{
    if(loadnumberofdataall("useracct","Where `username` Like '$username' and `password` Like '$oldpassword'")!=0)
    {
        if($newpassword==$newpasswordconfirm)
        {
           $mysql = "UPDATE `useracct` SET `password`='$newpassword' Where `username` Like '$username' and `password` Like '$oldpassword'"; 
            mysqli_query($sqlcon,$mysql); 

            if(!mysqli_error($sqlcon))
            {

            }
            else 
            {
                echo mysqli_error($sqlcon); 
            }
           
        }
        else 
        {
            echo 3;
        }
    

    }
    else
    {
        echo 2;
    }
}
else 
{
    echo 1;
}









?> 


