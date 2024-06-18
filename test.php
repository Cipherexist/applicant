<?php 

function loaddocumentlist($docttype_value)
{
        include 'dbconfig.php'; 
        @$username = $_COOKIE['usname'];
        @$mydoctype = $docttype_value; 
        @$showrequired = false; 
        if($mydoctype!="all")
        {
            $showrequired = true; 
            $sqlme = "Select * from `requirement` Where `doctype` Like '$mydoctype' ORDER BY `requirementname` ASC"; 
        }
        else 
        {
            $showrequired = false; 
            $sqlme = "Select * from `requirement` ORDER BY `requirementname` ASC"; 
        }
    
        $primary_dbt = mysqli_query($sqlcon,$sqlme); 
    
        if(!mysqli_error($sqlcon))
        {
            if(mysqli_num_rows($primary_dbt)!=0)
            {
                $x = 0; 
                while($primary = mysqli_fetch_assoc($primary_dbt))
                {
                    @$documentname = $primary['requirementname']; 
                    @$docid = $primary['ID'];
                   
                    $sql2 = "Select * from `userdocuments` Where `username` Like '$username' and `docid` Like '$docid'";
                    $dbt = mysqli_query($sqlcon,$sql2);

                    if(!mysqli_error($sqlcon))
                    {
                        if(mysqli_num_rows($dbt)!=0)
                        {
                            while($rows = mysqli_fetch_assoc($dbt))
                            {
                                @$id = $rows['ID'];
                                @$authenticity = $rows['authenticity']; 
                                @$docfile = $rows['filename']; 
                                @$myusername =  $_COOKIE['usname'];
                                @$docfilelink = "../userdocuments/uploads/". $myusername . "/" . $docfile; 
                                @$docshow = '"'. $docfilelink . '"'; 
                                @$delid = '"'. $rows['ID']  .'"'; 
                                @$doctheid = '"'. $id .'"'; 
                                @$delname = '"'.  $documentname  .'"'; 
                                @$docusername = '"'. $_COOKIE['usname'] .'"'; 
                                @$docnumber = $rows['docnumber']; 
                                @$issuedate = $rows['issuedate']; 
                                @$expirydate = $rows['expirydate']; 

                                if($authenticity=="")
                                {
                                    if($docfile==NULL||$docfile=="")
                                    {
                                        $authenticity = "For Upload";
                                    }
                                    else 
                                    {
                                        $authenticity = "Not Verified";
                                    }
                                  
                                }


                                echo "<div class='col-md-4' style='margin-top:10px;'>"; 
                                        echo "<div class='card border border-primary'>";                        
                                                echo "<div class='card-header text-light bg-primary'>";
                                                        echo $documentname;
                                                        echo "<div class='float-right'>";
                                                    //     echo "<button type='button' class='btn btn-sm btn-secondary'><i class='bi bi-eye'></i></button>";
                                                    //   echo " <button type='button' class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></button>";
                                                    if($authenticity!="Verified")
                                                    {
                                                        echo " <button type='button' class='btn btn-sm btn-danger' onclick='deletelist($delid,$delname)'><i class='bi bi-trash'></i></button>";
                                                    }    
                                                   
                                                        echo "</div>";
                                                echo "</div>";
                                                echo "<div class='card-body'>";
                                                    echo "  <p class='card-title text-dark'>Docu/Cert No - <span id='docnumber_$id' class='text-primary'>$docnumber</span></p>";
                                                    echo "  <p class='card-title text-dark'>Issue Date (DD/MM/YYYY)- <span id='issuedate_$id' class='text-primary'>$issuedate</span></p>";
                                                    echo "  <p class='card-text text-dark'>Expiry Date (DD/MM/YYYY)- <span id='expirydate_$id' class='text-primary'>$expirydate</span></p>";
                                                    echo "  <p class='card-text text-dark'>Status: <span id='status_$id'>$authenticity</span></p>";
                                                 
                                                 
                                                    // echo "<button type='button' class='btn btn-warning btn-sm'>Edit</button>";
                                                    // echo "<button style='margin-left:10px;' type='button' class='btn btn-info btn-sm'>Upload</button>";
                                                    // echo "<button style='margin-left:10px;' type='button' class='btn btn-success btn-sm'>View</button>";
                                                    if($authenticity!="Verified")
                                                    {
                                                       echo "<button type='button' class='btn btn-primary btn-sm'  onclick='editshow($doctheid,$delname)' >Edit</button>";
                                                       echo "<button type='button' class='btn btn-primary btn-sm' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname,$docusername)' >Upload</button>";
                                                    }

                                                    if($docfile!=NULL||$docfile!="")
                                                    {
                                                        echo "<button type='button' class='btn btn-info btn-sm' style='margin-left: 10px;' onclick='popupwindow($docshow)'>View</button>";

                                                    }
                                                   // "<button type='button' class='btn btn-secondary' style='margin-left: 10px;'><a href='$docfilelink' download><i class='bi bi-download'></i></a></button>"; 
                       
                                                    
                                                echo "</div>";
                                echo "</div>";
                                echo "  </div>"; 
                            }
                        }
                        else 
                        {
                            if($showrequired)
                            {
                                @$doctheid = '"'. $docid .'"'; 
                                @$delname = '"'.  $documentname  .'"'; 
                                @$docusername = '"'. $_COOKIE['usname'] .'"'; 
                            
                                echo "<div class='col-md-4' style='margin-top:10px;'>"; 
                                echo "<div class='card border border-primary'>";                        
                                        echo "<div class='card-header text-dark bg-pending'>";
                                                echo $documentname;
                                   
                                        echo "</div>";
                                        echo "<div class='card-body'>";
                                            echo "  <p class='card-title text-dark'>Upload Document first</p>";
                                            echo "<button type='button' class='btn btn-primary btn-sm' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname,$docusername)' >Upload</button>";
                                                 
                                        echo "</div>";
                                echo "</div>";
                                echo "  </div>"; 
                            }
                    
                        }
                    }
                    else 
                    {
                        echo mysqli_error($sqlcon);
                    }
                }
            }
        }
        else 
        {
            echo mysqli_error($sqlcon); 
        }
}



?>