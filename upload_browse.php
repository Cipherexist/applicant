<?php 
require 'loadtables.php'; 
include 'dbconfig.php'; 

@$hiringid = $_POST['myhiringid']; 
@$myusername = $_COOKIE['usname']; 
   

loadmydocumentsbyhiring($hiringid); 






function loadmydocumentsbyhiring($hiringid)
{
    include "dbconfig.php"; 
    require 'modules.php'; 
    
    @$myusername = $_COOKIE['usname']; 
    @$docid = ""; 
    $id = $hiringid;
    @$mydocidlist = loadhiringdocid($id); 


    $sqldoc = "Select * from `reqlist` Where `reqid` Like '$mydocidlist'"; 
    $dat = mysqli_query($sqlcon,$sqldoc); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dat)!=0)
        {
            echo mysqli_num_rows($dat);
            while($rows2 = mysqli_fetch_assoc($dat))
            {
                @$docid = $rows2['doclistid']; 
                @$docname = loaddocname($docid); 
                $mysql = "SELECT * from `userdocuments` Where `username` Like '$myusername' and `docid` Like '$docid'"; 

                $dbt = mysqli_query($sqlcon,$mysql);
            
            
                if(!mysqli_error($sqlcon))
                {
                    if(mysqli_num_rows($dbt)==0)
                    {
                      echo "<option value='$docid'>$docname</option>"; 
                    }
                }
                else 
                {
                    echo mysqli_error($sqlcon); 
                }

            }
        }
        else 
        {
            echo $sqldoc;
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 

    }

 

}












?> 

