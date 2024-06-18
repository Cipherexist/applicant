<?php 


function loadhirings()
{
        include 'dbconfig.php'; 
   
        @$myinfoaverage = averageprogress(); 

        if($myinfoaverage>=75)
        {
            
            @$myusername = $_COOKIE['usname']; 

            @$gethiringposition = loadtextreturn("applicantinfo","applyingrank","Where `username` Like '$myusername'"); 
            $sqlme = "Select * from hiring Where `broadcast` Like 'yes' and positionid Like '$gethiringposition' ORDER BY ID DESC"; 
            $dbt = mysqli_query($sqlcon,$sqlme); 
    
    
            if(!mysqli_error($sqlcon))
            {
                if(mysqli_num_rows($dbt)!=0)
                {   
                    echo "<div class='row'>";
                    while($rows = mysqli_fetch_assoc($dbt))
                    {
                        @$id = $rows['ID']; 
                        @$myusername = $_COOKIE['usname']; 
                        if(loadnumberofdataall("monitoring","Where `hiringid` Like '$id' and `username` Like '$myusername'")==0)
                        {
                            @$quizidme = $rows['quizid']; 
                          //  @$getifstatusok = loadnumberofdataall("quizmanagement_list","Where `quiztitle` Like '$quizidme'"); 
                            @$numberofexam = loadnumberofdataall("quizmanagement_list","Where `quiztitle` Like '$quizidme'"); 
                            @$hiringtitle = loadcompleterank($rows['positionid']) . " - " . loadcompletevesselname($rows['vesselid']);
                            @$caption = $rows['caption']; 
                            @$description = $rows['description']; 
                            @$idsend = '"'. $rows['ID'] .'"'; 
                            @$idnumberexam = '"'. $numberofexam .'"'; 
                            @$idcaption = '"'. $rows['caption'] .'"'; 
                            @$iddescription = '"'. $rows['description'] .'"'; 
                            @$titlesend =  '"'. $hiringtitle .'"'; 
                            @$rank = '"'. $rows['positionid'] .'"'; 
                            echo "
                            <div class='col-md-6' style='margin-top: 10px;'> 
                                <div class='card'>
                                        <div class='card-header'>
                                        $hiringtitle
                                        </div>
                                        
                                        <div class='card-body'>
                                            <h5 class='card-title'>$caption</h5>
                                            <p class='card-text'>$description</p>
                                        <button type='button' class='btn btn-sm btn-success' onclick='newshow($idsend,$titlesend,$rank,$idcaption,$iddescription,$idnumberexam)'>Apply</button>"; 

                                      //  echo " <button type='button' class='btn btn-sm btn-danger'>hide</button>"; 

                                       echo "</div>
                                </div>
                            </div>"; 
                        }
                    }
                    echo "</div>";
                }
                else 
                {
                    echo "<div class='row'>";  
                    echo "<h4 class='text-danger'> No Available Jobs for now</h4>";  
                    echo "</div>";
                }
            }
            else 
            {
                echo mysqli_error($sqlcon);
            }
      
        }
        else 
        {
            echo "<div class='row' style='margin-top:30px;'>"; 
            echo "<h5 class='text-danger'>Kindly finish your account information up to 75%</h5>";
            echo "</div>"; 
            echo "<div class='row' style='margin-top:5px;'>"; 
            echo "<p>Your Account information progress is at <span class='text-danger'>$myinfoaverage% </span></p>";
            echo "</div>"; 
            echo "<div class='row' style='margin-top:5px;'>"; 
            echo "<p>Click <a href='home.php'>Here</a> To Finish your progress</p>";
            echo "</div>"; 
        }  
}


function loadseaservice()
{
    include 'dbconfig.php'; 
    @$username = $_COOKIE['usname'];
    $sqlme = "Select * from `seaservice` Where `username` Like '$username'"; 

    $dbt = mysqli_query($sqlcon,$sqlme); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            $x = 0; 
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$x = $x+1; 
                @$myrank  = loadcompleterank($rows['rankid']); 
                @$vesselname  = $rows['vesselname']; 
                @$vesseltype = $rows['vesseltype']; 
                @$totalmonths = $rows['months'] . " Months"; 
                @$iddelete = '"'. $rows['ID'] .'"'; 
                @$namedelete = '"'. $rows['vesselname'] .'"'; 
                @$grt = "Gross: " . $rows['grt'] . "/ KW: ". $rows['enginekw']; 

                echo "<div class='col-md-4' style='margin-top:10px;'>"; 
                echo "<div class='card border border-primary'>";                        
              echo "<div class='card-header text-light bg-primary'>";
              echo "SEA SERVICE #$x";
              echo "<div class='float-right'>";
         //     echo "<button type='button' class='btn btn-sm btn-secondary'><i class='bi bi-eye'></i></button>";
           //   echo " <button type='button' class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></button>";
              echo " <button type='button' class='btn btn-sm btn-danger' onclick='deletelist($iddelete,$namedelete)'><i class='bi bi-trash'></i></button>";
              echo "</div>";
              echo "</div>";
              echo "<div class='card-body'>";
              echo "  <p class='card-title text-dark'>Rank: $myrank</p>";
              echo "  <p class='card-text text-dark'>Vessel Name: $vesselname</p>";
              echo "  <p class='card-text text-dark'>Vessel Type: $vesseltype</p>";
              echo "  <p class='card-text text-dark'>Total Months: $totalmonths</p>";
              echo "  <p class='card-text text-dark'>$grt</p>";
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
                                @$classheader = "";
                                if($authenticity=="")
                                {
                                    if($docfile==NULL||$docfile=="")
                                    {
                                        $authenticity = "For Upload";
                                        $classheader = "bg-pending text-dark";
                                    }
                                    else 
                                    {
                                        $authenticity = "Not Verified";
                                        $classheader = "bg-primary text-light";
                                    }
                                  
                                }


                                echo "<div class='col-md-4' style='margin-top:10px;'>"; 
                                        echo "<div class='card border border-primary'>";                        
                                                echo "<div class='card-header  $classheader'>";
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

function loadhiringsapplied()
{
        include 'dbconfig.php'; 
   
        @$myinfoaverage = averageprogress(); 

        if($myinfoaverage>=75)
        {
            $sqlme = "Select * from hiring ORDER BY ID DESC"; 
            $dbt = mysqli_query($sqlcon,$sqlme); 
    
    
            if(!mysqli_error($sqlcon))
            {
                if(mysqli_num_rows($dbt)!=0)
                {   
                    echo "<div class='row'>";
                    while($rows = mysqli_fetch_assoc($dbt))
                    {
                        @$id = $rows['ID']; 
                        @$myusername = $_COOKIE['usname']; 
                        if(loadnumberofdataall("monitoring","Where `hiringid` Like '$id' and `username` Like '$myusername'")!=0)
                        {   
                            @$hiringtitle = $rows['hiringtitle']; 
                            @$caption = $rows['caption']; 
                            @$description = $rows['description']; 
                            @$idsend = '"'. $rows['ID'] .'"'; 
                            @$idcaption = '"'. $rows['caption'] .'"'; 
                            @$iddescription = '"'. $rows['description'] .'"'; 
                            @$titlesend = '"'. $rows['hiringtitle'] .'"'; 
                            @$rank = '"'. $rows['positionid'] .'"'; 
                            echo "
                            <div class='col-md-6' style='margin-top: 10px;'> 
                                <div class='card'>
                                        <div class='card-header'>
                                        $hiringtitle
                                        </div>
                                        
                                        <div class='card-body'>
                                            <h5 class='card-title'>$caption</h5>
                                            <p class='card-text'>$description</p>
                                        <button type='button' class='btn btn-sm btn-success' onclick='applicationshow($idsend,$titlesend,$rank)'>Show</button>
                                        <button type='button' class='btn btn-sm btn-danger'>Cancel</button>
                                        </div>
                                </div>
                            </div>"; 
                        }
                    }
                    echo "</div>";
    
                }
            }
            else 
            {
                echo mysqli_error($sqlcon);
            }
      
        }
        else 
        {
            echo "<div class='row' style='margin-top:30px;'>"; 
            echo "<h5 class='text-danger'>Kindly finish your account information up to 75%</h5>";
            echo "</div>"; 
            echo "<div class='row' style='margin-top:5px;'>"; 
            echo "<p>Your Account information progress is at <span class='text-danger'>$myinfoaverage% </span></p>";
            echo "</div>"; 
            echo "<div class='row' style='margin-top:5px;'>"; 
            echo "<p>Click <a href='home.php'>Here</a> To Finish your progress</p>";
            echo "</div>"; 
        }  
}

function loaduserdocuments($theuser)
{
    include "dbconfig.php"; 
   
    @$myusername = $theuser; 
   
        $mysql = "SELECT * from `userdocuments` Where `username` Like '$myusername'"; 
    
    $dbt = mysqli_query($sqlcon,$mysql);


    if(!mysqli_errno($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            @$verifiedcount = 0; 
            @$totaldocuments = mysqli_num_rows($dbt); 
            
            while(@$rows = mysqli_fetch_assoc($dbt))
            {
                @$id = $rows['ID'];
                @$mydocname = loaddocname($rows['docid']); 
                @$authenticity = $rows['authenticity']; 
                @$docfile = $rows['filename']; 
                @$docfilelink = "../applicant/uploads/". $myusername . "/" . $docfile; 
                @$docshow = '"'. $docfilelink . '"'; 
                @$delid = '"'. $rows['ID']  .'"'; 
                @$doctheid = '"'. $rows['ID']  .'"'; 
                @$docusername = '"'. $rows['username']  .'"'; 
                @$delname = '"'.  $mydocname  .'"'; 
                @$delapprove1 = '"Verified"'; 
                @$delapprove2 = '"Declined"'; 
                @$delapprove3 = '"Recheck"'; 
                @$docnumber = $rows['docnumber']; 
                @$issuedate = $rows['issuedate'];
                @$expirydate = $rows['expirydate'];
                @$userupdate = $rows['user_update'];
                @$getupdate = loadregistrationtocompletedate($rows['docdate']); 
                @$expirationclass = "text-dark";
                if($authenticity=="")
                {
                    $authenticity = "Not Verified";
                }
                elseif($authenticity=="Verified")
                {
                    $authenticity="Verified";
                    $verifiedcount +=1; 
                }

                if($expirydate!="")
                {
                    if(loadexpirationcheck($expirydate))
                    {
                        $expirationclass = "text-danger"; 
                    }
                }
           
                
                @$doctype = loaddoctype($rows['docid']); 
                echo "<tr>"; 
                echo "<td scope='row'>$doctype</td>"; 
                echo "<td scope='row'>$mydocname</td>"; 
                echo "<td scope='row' id='docnumber_$id'>$docnumber</td>"; 
                echo "<td scope='row' id='issuedate_$id'>$issuedate</td>"; 
                echo "<td scope='row' class='$expirationclass' id='expirydate_$id'>$expirydate</td>"; 
                echo "<td id='authenticity_$id'>$authenticity</td>";
                echo "<td>$getupdate</td>";
                echo "<td>$userupdate</td>";
                //"<button type='button' class='btn btn-primary' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname)'><i class='bi bi-cloud-arrow-up'></i></button>".
                //"<button type='button' class='btn btn-danger' style='margin-left:10px;' onclick='deletelist($delid,$delname)'><i class='bi bi-trash'></i></button>". 
              
                if($docfile!=NULL||$docfile!="")
                {
                    echo "<td>";
                    echo
                     "<a class='choicelink' href='#!'  onclick='editshow($doctheid,$delname)'>Edit</a>".
                    "<a class='choicelink' href='#!'  onclick='uploadshowupdate($doctheid,$delname,$docusername)' >Upload</a>".
                    "<a class='choicelink' href='#!'  onclick='deletelist($delid,$delname,$docusername)'>Delete</a>".
                    "<a class='choicelink' href='#!'  onclick='popupwindow($docshow)'>Show</a>".
                    "<a class='choicelink' href='$docfilelink' target='_blank' style='margin-left: 10px;' download>Download</a>" . "</td>"; 

                    echo "<td>".
                    "<a class='choicelink' href='#!' onclick='approval($delid,$delname,$delapprove1)'>Approve</a>".  
                    "<a class='choicelink' href='#!' onclick='approval($delid,$delname,$delapprove2)'>Deny</a>". 
                    "<a class='choicelink' href='#!' onclick='approval($delid,$delname,$delapprove3)'>Undo</a>".     "</td>"; 
                 
                }
                else 
                {
                    echo "<td>";
                    echo
                    "<button type='button' class='btn btn-primary' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname,$docusername)' ><i class='bi bi-cloud-arrow-up'></i></button>"; 
                }
             
                echo "</tr>"; 
         
          

            }

            if($verifiedcount==$totaldocuments)
            {
                echo "<tr colspan='4'>";
                echo "<td><button id='btn-approvestage' class='btn btn-success btn-large' onclick='approvesend()'  data-dismiss='modal'>Documents are Final</button></td>";
                echo "</tr>"; 
              
            }
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 

    }

}



function loadmydocuments()
{
    include "dbconfig.php"; 
   
    @$myusername = $_COOKIE['usname']; 
    $mysql = "SELECT * from `userdocuments` Where `username` Like '$myusername'"; 

    $dbt = mysqli_query($sqlcon,$mysql);


    if(!mysqli_errno($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$docidme = $rows['docid']; 

                @$mydocname = loaddocname($rows['docid']); 
                @$authenticity = $rows['authenticity']; 
                @$docfile = $rows['filename']; 
                @$docfilelink = "../userdocuments/uploads/". $myusername . "/" . $docfile; 
                @$docshow = '"'. $docfilelink . '"'; 
                @$delid = '"'. $rows['ID']  .'"'; 
                @$doctheid = '"'. $rows['docid']  .'"'; 
                @$delname = '"'.  $mydocname  .'"'; 

                $getforadmin = loadtextreturn("requirement","foradmin","Where ID Like '$docidme'"); 
                
                if($getforadmin==NULL||$getforadmin=="")
                {
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
                    echo "<tr>"; 
                    echo "<td scope='row'>Required</td>"; 
                    echo "<td scope='row'>$mydocname</td>"; 
                    echo "<td>$authenticity</td>";
                    echo "<td>"; 
                    
                    if($docfile==NULL||$docfile=="")
                    {
                        echo
                        "<button type='button' class='btn btn-primary' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname)' ><i class='bi bi-cloud-arrow-up'></i></button>".
                        "<button type='button' class='btn btn-danger' style='margin-left:10px;' onclick='deletelist($delid,$delname)'><i class='bi bi-trash'></i></button>";
                    }
                    else 
                    {
                        echo
                        "<button type='button' class='btn btn-primary' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname)' ><i class='bi bi-cloud-arrow-up'></i></button>".
                        "<button type='button' class='btn btn-danger' style='margin-left:10px;' onclick='deletelist($delid,$delname)'><i class='bi bi-trash'></i></button>". 
                        "<button type='button' class='btn btn-info' style='margin-left: 10px;' onclick='popupwindow($docshow)'><i class='bi bi-eye'></i></button>".
                        "<button type='button' class='btn btn-secondary' style='margin-left: 10px;'><a href='$docfilelink' download><i class='bi bi-download'></i></a></button>"; 
                       
                    }
                
                    echo "</td>"; 
                    echo "</tr>"; 
                }
            

            }
        }
        {
          
        }

    }
    else 
    {
        echo mysqli_error($sqlcon); 

    }

}



function loadmydocumentsbyhiring($hiringid)
{
    include "dbconfig.php"; 

    @$myusername = $_COOKIE['usname']; 
    @$docid = ""; 
    $id = $hiringid;
    @$mydocidlist = loadhiringdocid($id); 
    @$show = false; 

    $sqldoc = "Select * from `reqlist` Where `reqid` Like '$mydocidlist'"; 
    $dat = mysqli_query($sqlcon,$sqldoc); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dat)!=0)
        {
          
            while($rows2 = mysqli_fetch_assoc($dat))
            {
                $docid = $rows2['doclistid']; 

                $mysql = "SELECT * from `userdocuments` Where `username` Like '$myusername' and `docid` Like '$docid'"; 

                $dbt = mysqli_query($sqlcon,$mysql);
            
            
                if(!mysqli_error($sqlcon))
                {
                  //  echo $mysql . "</br>" ;
                    if(mysqli_num_rows($dbt)==0)
                    {
                        @$documentname =  loaddocname($rows2['doclistid']); 
                        @$doctheid = '"'. $rows2['doclistid'] .'"'; 
                        @$delname = '"'.  $documentname .'"'; 
                        @$docusername = '"'. $_COOKIE['usname'] .'"'; 
                        echo "<div class='col-md-4' style='margin-top:10px;'>"; 
                        echo "<div class='card border border-primary'>";                        
                                echo "<div class='card-header text-dark bg-pending'>";
                                        echo "Pending: " . $documentname;
                           
                                echo "</div>";
                                echo "<div class='card-body'>";
                                    echo "  <p class='card-title text-dark'>Upload Document first</p>";
                                    echo "<button type='button' class='btn btn-primary btn-sm' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname,$docusername)' >Upload</button>";
                                         
                                echo "</div>";
                        echo "</div>";
                        echo "  </div>"; 
        
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

