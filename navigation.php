
<?php 
include 'loadprogress.php'; 


function loadthepic($username)
{
  @$pictureresult = ""; 
    include "dbconfig.php";
    @$theusername = $username; 

    $sql = "SELECT * from `applicantinfo` Where username Like '$theusername'"; 

    $dbt = mysqli_query($sqlcon,$sql); 

    if(!mysqli_error($sqlcon))
    {
        if (mysqli_num_rows($dbt)!=0) 
        {
            while ($rows = mysqli_fetch_assoc($dbt))
            {
                if($rows['pictureloc']!="")
                {
                   
                    $result = explode("/", $rows['pictureloc']);

                    if(count($result)>=2)
                    {
                        $pictureresult = "../userdocuments/profilepic/". $result[1]; 
                    }
                    else 
                    {
                        $pictureresult = "../userdocuments/profilepic/". $rows['pictureloc']; 

                    }

               
                }
                else 
                {

                }
             



                return $pictureresult; 
            }


        }
    }
    else 
    {
        echo mysqli_error($sqlcon);
        return mysqli_error($sqlcon);
    }

}

    
    @$username = $_COOKIE['usname'];
    @$picturelocation = loadthepic($username); 
    @$finalpic = "images/blank.jpg"; 

    if($picturelocation!="")
    {
    $finalpic = $picturelocation; 
    }
    //echo $picturelocation;
    echo "<div id='reloadpic' name='reloadpic' class='img logo rounded-circle mb-5' style='background-image: url($finalpic);'> <button type='button' class='btn btn-primary btn-sm btnupload fa fa-upload' data-toggle='modal' data-target='#pictureuploadmodal'></button></div> "; 
    echo "<div id='reloadprogress'>"; 
    echo showprogress(); 
    echo "</div>";
    echo "<ul class='list-unstyled components mb-5'>"; 

    echo "<li class='$nav1'>
              <a href='home.php'>Profile</a>
          </li>"; 

    echo "<li class='$nav2'>
                <a href='application.php'>Application</a>
          </li>"; 
          


    echo "<li class='$nav3'>
          <a href='uploads.php'>Uploads</a>
          </li>"; 

        echo "<li class='$nav4'>
        <a href='changepassword.php'>Change Password</a>
        </li>"; 

    echo "<li>
          <a href='logout.php'>Log-Out</a>
          </li>"; 
                
                
      echo  "</ul>"; 

    //echo "<a href='#' class='img logo rounded-circle mb-5' style='background-image: url(images/logo.png);'></a>"; 

?> 
