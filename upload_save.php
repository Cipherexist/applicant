<?php 

function loadregistrationtime2()
{

	$completetime = time(); 
	
	return $completetime; 
}

function loadregistrationdatetoday2()
{
	$myyear = date('Y'); 
	$mydate = date('d'); 
	$mymonth = date('m'); 
		
	
	$completeregdate = $myyear. $mymonth. $mydate; 
	
	return $completeregdate; 
}


            // echo $_POST['coursecode'] . ' ' . $_POST['coursemonth']; 

if(!empty($_FILES["file"]))
{
    require "loadtables.php"; 

    $filename = $_COOKIE['usname']. "-" . loadregistrationtime2();
    $target_directory = "uploads/". $_COOKIE['usname']. "/"; 
    $target_file = $target_directory.basename($_FILES["file"]["name"]);
    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 
    $newfilename = $target_directory.$filename. "." . $filetype; 
    $filetitle = $filename. "." . $filetype;
    $filenameonly = $filename. "." . $filetype; 
    @$docid = $_POST['mydocid']; 
    @$hiringid = $_POST['myhiring']; 
    if(move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename))
    {
        include 'dbconfig.php'; 
        @$filenamelocation = $filetitle; 
        @$classno = $_POST['filename'];  
        @$usernamecall = $_COOKIE['usname'];  
       // @$tcode = $_COOKIE['traineecode']; 
       @$insertdate = loadregistrationdatetoday2(); 
       @$inserttime = loadregistrationtime2(); 


        $sqlquery = "SELECT * from `userdocuments` Where `username` Like '$usernamecall' and `docid` Like '$docid'"; 
        $dbt = mysqli_query($sqlcon,$sqlquery); 


        if(!mysqli_error($sqlcon))
        {
            if(mysqli_num_rows($dbt)==0)
            {
                $mysql2 = "INSERT INTO `userdocuments`(`username`,`docid`,`filename`,`docdate`,`doctime`) VALUES ('$usernamecall','$docid','$filenamelocation','$insertdate','$inserttime')"; 
                //   $mysql = "UPDATE `applicantinfo` SET `pictureloc` = '$filenamelocation' WHERE username Like '$usernamecall'"; 
                    $dba = mysqli_query($sqlcon,$mysql2); 
        
                    if(!mysqli_error($sqlcon))
                    {
                        loadmydocumentsbyhiring($hiringid); 
        
                    }
                    else
                    {
                        echo mysqli_error($sqlcon); 
                    }
            
            //        echo "DOCID: " . $docid;
                
            }
            else 
            {
                $mysql2 = "UPDATE `userdocuments` SET `filename`='$filenamelocation',`docdate`='$insertdate',`doctime`='$inserttime' Where `username` Like '$usernamecall' and `docid` Like '$docid' "; 

               // $mysql2 = "INSERT INTO `userdocuments`(`username`,`docid`,`filename`,`docdate`,`doctime`) VALUES ('$usernamecall','$docid','$filenamelocation','$insertdate','$inserttime')"; 
                //   $mysql = "UPDATE `applicantinfo` SET `pictureloc` = '$filenamelocation' WHERE username Like '$usernamecall'"; 
                    $dba = mysqli_query($sqlcon,$mysql2); 
        
                    if(!mysqli_error($sqlcon))
                    {
                        loadmydocumentsbyhiring($hiringid); 
        
                    }
                    else
                    {
                        echo mysqli_error($sqlcon); 
                    }
            }
          
        }
        else 
        {
            echo mysqli_error($sqlcon);
        }


    } 
    else
    {
        echo "Error Uploading"; 
    }
}
else
{
    echo "File is empty";  
}

?>