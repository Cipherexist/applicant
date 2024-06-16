<?php 

            // echo $_POST['coursecode'] . ' ' . $_POST['coursemonth']; 

if(!empty($_FILES["file"]))
{
    include 'modules.php'; 
    $filename = $_COOKIE['usname']. "-" . loadregistrationtime();
    $target_directory = "../userdocuments/profilepic/"; 
    $target_file = $target_directory.basename($_FILES["file"]["name"]);
    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 
    $newfilename = $target_directory.$filename. "." . $filetype; 
    $filenameonly = $filename. "." . $filetype; 

    if(move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename))
    {
        include 'dbconfig.php'; 
        @$filenamelocation = $newfilename; 
        @$classno = $_POST['filename'];  
        @$usernamecall = $_COOKIE['usname'];  
        @$tcode = $_COOKIE['traineecode']; 

        $mysql = "UPDATE `applicantinfo` SET `pictureloc` = '$filenameonly' WHERE username Like '$usernamecall'"; 
        $dba = mysqli_query($sqlcon,$mysql); 

        if(!mysqli_error($sqlcon))
        {
            echo "<div id='reloadpic' name='reloadpic' class='img logo rounded-circle mb-5' style='background-image: url($filenamelocation);'> <button type='button' class='btn btn-primary btn-sm btnupload fa fa-upload' data-toggle='modal' data-target='#pictureuploadmodal'></button></div> "; 
        }
        else
        {
            echo 1; 
        }

    } 
    else
    {
        echo 1; 
    }
}
else
{
    echo 1;  
}

?>