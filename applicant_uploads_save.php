<?php 

            // echo $_POST['coursecode'] . ' ' . $_POST['coursemonth']; 

if(!empty($_FILES["file"]))
{
    include "loadtables.php"; 
    include 'loadmodules.php'; 
    $filename = $_POST['theuser'] . "-" . loadregistrationtime();
    $target_directory = "../applicant/". "uploads/". $_POST['theuser']. "/"; 
    $target_file = $target_directory.basename($_FILES["file"]["name"]);
    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 
    $newfilename = $target_directory.$filename. "." . $filetype; 
    $filetitle = $filename. "." . $filetype;
    $filenameonly = $filename. "." . $filetype; 
    @$docid = $_POST['mydocid']; 
    @$content = $_POST['content']; 

    if(move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename))
    {
        include 'dbconfig.php'; 
        @$filenamelocation = $filetitle; 
        @$classno = $_POST['filename'];  
        @$usernamecall = $_POST['theuser'];  
       // @$tcode = $_COOKIE['traineecode']; 
       @$insertdate = loadregistrationdatetoday(); 
       @$inserttime = loadregistrationtime(); 


        $sqlquery = "SELECT * from `userdocuments` Where `ID` Like '$docid' and `username` Like '$usernamecall'"; 
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
                       // echo $mysql2; 
                        loaduserdocumentsall($usernamecall,$content);
        
                    }
                    else
                    {
                        echo mysqli_error($sqlcon); 
                    }
            
            //        echo "DOCID: " . $docid;
                
            }
            else 
            {
                $mysql2 = "UPDATE `userdocuments` SET `filename`='$filenamelocation',`docdate`='$insertdate',`doctime`='$inserttime' Where `ID` Like '$docid' "; 

               // $mysql2 = "INSERT INTO `userdocuments`(`username`,`docid`,`filename`,`docdate`,`doctime`) VALUES ('$usernamecall','$docid','$filenamelocation','$insertdate','$inserttime')"; 
                //   $mysql = "UPDATE `applicantinfo` SET `pictureloc` = '$filenamelocation' WHERE username Like '$usernamecall'"; 
                    $dba = mysqli_query($sqlcon,$mysql2); 
        
                    if(!mysqli_error($sqlcon))
                    {
                        //echo $mysql2; 
                       loaduserdocumentsall($usernamecall,$content);
        
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