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
                            @$hiringtitle = $rows['hiringtitle']; 
                            @$caption = $rows['caption']; 
                            @$description = $rows['description']; 
                            @$idsend = '"'. $rows['ID'] .'"'; 
                            @$idnumberexam = '"'. $numberofexam .'"'; 
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
    require 'modules.php'; 
    
    @$myusername = $_COOKIE['usname']; 
    @$docid = ""; 
    $id = $hiringid;
    @$mydocidlist = loadhiringdocid($id); 


    $sqldoc = "Select * from `reqlist` Where `reqid` Like '$mydocidlist'"; 
    $dat = mysqli_query($sqlcon,$sqldoc); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dat)!=0)
        {
            echo mysqli_num_rows($dat);
            while($rows2 = mysqli_fetch_assoc($dat))
            {
                $docid = $rows2['doclistid']; 

                $mysql = "SELECT * from `userdocuments` Where `username` Like '$myusername' and `docid` Like '$docid'"; 

                $dbt = mysqli_query($sqlcon,$mysql);
            
            
                if(!mysqli_error($sqlcon))
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
                            @$dochiringid = '"'. $id  .'"'; 

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
                                    "<button type='button' class='btn btn-primary' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname,$dochiringid)' ><i class='bi bi-cloud-arrow-up'></i></button>";
                                 //   "<button type='button' class='btn btn-danger' style='margin-left:10px;' onclick='deletelist($delid,$delname,$dochiringid)'><i class='bi bi-trash'></i></button>";
                                }
                                else 
                                {
                                    echo
                                    "<button type='button' class='btn btn-primary' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname,$dochiringid)' ><i class='bi bi-cloud-arrow-up'></i></button>".
                                    "<button type='button' class='btn btn-danger' style='margin-left:10px;' onclick='deletelist($delid,$delname,$dochiringid)'><i class='bi bi-trash'></i></button>". 
                                    "<button type='button' class='btn btn-info' style='margin-left: 10px;' onclick='popupwindow($docshow)'><i class='bi bi-eye'></i></button>".
                                    "<button type='button' class='btn btn-secondary' style='margin-left: 10px;'><a href='$docfilelink' download><i class='bi bi-download'></i></a></button>"; 
                                   
                                }
                            
                                echo "</td>"; 
                                echo "</tr>"; 
                            }
                        
            
                        }
                    }
                    else 
                    {
                        @$docidme = $docid;
            
                        @$mydocname = loaddocname($docid); 
                        @$authenticity = ""; 
                        @$docfile = ""; 
                        // @$docfilelink = "../userdocuments/uploads/". $myusername . "/" . $docfile; 
                        // @$docshow = '"'. $docfilelink . '"'; 
                        // @$delid = '"'. $rows['ID']  .'"'; 
                         @$doctheid = '"'. $docid  .'"'; 
                         @$dochiringid = '"'. $id  .'"'; 
                         @$delname = '"'.  $mydocname  .'"'; 
        
                        // $getforadmin = loadtextreturn("requirement","foradmin","Where ID Like '$docidme'"); 
                        
                        // if($getforadmin==NULL||$getforadmin=="")
                        // {
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
                            
                            // if($docfile==NULL||$docfile=="")
                            // {
                            //            }
                            // else 
                            // {
                            //     echo
                            //     "<button type='button' class='btn btn-primary' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname)' ><i class='bi bi-cloud-arrow-up'></i></button>".
                            //     "<button type='button' class='btn btn-danger' style='margin-left:10px;' onclick='deletelist($delid,$delname)'><i class='bi bi-trash'></i></button>". 
                            //     "<button type='button' class='btn btn-info' style='margin-left: 10px;' onclick='popupwindow($docshow)'><i class='bi bi-eye'></i></button>".
                            //     "<button type='button' class='btn btn-secondary' style='margin-left: 10px;'><a href='$docfilelink' download><i class='bi bi-download'></i></a></button>"; 
                               
                            // }

                            echo
                            "<button type='button' class='btn btn-primary' style='margin-left: 10px;' onclick='uploadshowupdate($doctheid,$delname,$dochiringid)' ><i class='bi bi-cloud-arrow-up'></i></button>"; 
                           // "<button type='button' class='btn btn-danger' style='margin-left:10px;' onclick='deletelist($delid,$delname)'><i class='bi bi-trash'></i></button>";
             

                        
                            echo "</td>"; 
                            echo "</tr>"; 
                        
                    
        
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

