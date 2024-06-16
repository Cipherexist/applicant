<?php 
include 'loadfunction2.php'; 
include 'modules.php'; 



@$myanswer = $_POST['choiceanswer'];
@$mynumber = $_POST['choicenumber']; 
@$mycode = $_POST['choicecode']; 
@$mycompetence = "1"; 
@$username = $_COOKIE['usname']; 
@$myhiring = $_POST['choicehiring']; 



// echo $myanswer. ' ' . $mynewnumber . ' ' . $mycode; 
@$mysession = loadmysession($_COOKIE['usname'],$myhiring,$mycode); 
$mynumber = $mynumber - 1;
include 'dbconfig.php'; 

$mysqlme = "SELECT * from onlineresults Where qno Like '$mynumber' and session Like '$mysession' and username Like '$username' and course Like '$mycode' and `hiringid` Like '$myhiring'"; 
$dba = mysqli_query($sqlcon, $mysqlme); 


if(!mysqli_error($sqlcon))
{
    if(mysqli_num_rows($dba)!=0)
    {

        while($rows = mysqli_fetch_assoc($dba))
        {
         
            
                echo loadmyquestion($mynumber,$mycode,$mysession,$myhiring);
            
          //  echo $mysqlme; 
        //  echo loadmyquestion($mynumber,$mycode,$mysession,$mycompetence);

        }
    }
    else 
    {
        echo $mysqlme ;
       
    }

}
else 
{
echo mysqli_error($sqlcon);
}








?> 
