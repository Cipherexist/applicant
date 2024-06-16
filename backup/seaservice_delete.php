<?php 
include "dbconfig.php"; 
include "loadtables.php"; 
include "modules.php";


@$id = $_POST['id']; 

$mysql = "DELETE from `seaservice` Where `ID` Like '$id'"; 
$dbt = mysqli_query($sqlcon,$mysql); 


if(!mysqli_error($sqlcon))
{

 echo loadseaservice(); 
    
}
else 
{
    echo mysqli_error($sqlcon); 
}

//echo $id;









?> 
