<?php 

include 'dbconfig.php'; 



@$username = $_COOKIE['usname'];
@$mydoctype = $_POST['doctype']; 
if($mydoctype!="All")
{
    @$sqlme = "Select * from `requirement` Where `doctype` Like '$mydoctype' ORDER BY `requirementname` ASC"; 
}
else 
{
    @$sqlme = "Select * from `requirement` ORDER BY `requirementname` ASC"; 
}

$primary_dbt = mysqli_query($sqlcon,$sqlme); 

if(!mysqli_error($sqlcon))
{
    if(mysqli_num_rows($primary_dbt)!=0)
    {
      
        $x = 0; 
        while($primary = mysqli_fetch_assoc($primary_dbt))
        {
            $x +=1; 
            @$documentname = $primary['requirementname']; 
            @$docid = $primary['ID'];
           
            $sql2 = "Select * from `userdocuments` Where `username` Like '$username' and `docid` Like '$docid'";
            $dbt = mysqli_query($sqlcon,$sql2);

            if(!mysqli_error($sqlcon))
            {
                if(mysqli_num_rows($dbt)==0)
                {
                 
                       echo "<option value='$docid'>$documentname</option>";
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

    }
}
else 
{
    echo mysqli_error($sqlcon); 
}


?>