<?php 
include "dbconfig.php"; 
require "loadtables.php"; 
include 'modules.php'; 
@$id = $_POST['id']; 
@$hiringid = $_POST['thehiring']; 

$mysql = "SELECT * from `userdocuments` Where ID Like '$id'"; 
$dbt = mysqli_query($sqlcon,$mysql); 


if(!mysqli_error($sqlcon))
{

    if(mysqli_num_rows($dbt)==0) 
    {
        echo $mysql; 
    }
    else 
    {
        @$sql2 = "DELETE from `userdocuments` Where ID Like '$id'"; 
        mysqli_query($sqlcon,$sql2);
        {
            if(!mysqli_error($sqlcon)) 
            {
                if(isset($_POST['mycontent']))
                {
                    if($_POST['mycontent']=='training')
                    {
                        loaddocumentlistfortraining($_POST['mycontent']);
                    }
                    else if($_POST['mycontent']=='training')
                    {
                        loaddocumentlistforforeign($_POST['mycontent']);
                    }
                    else 
                    {
                        loaddocumentlist($_POST['mycontent']);
                    }
                }
                else 
                {
                    loaddocumentlist("all");
                }
             
            }
    
        }
    }

  
}
else 
{
    echo mysqli_error($sqlcon); 
}










?> 
