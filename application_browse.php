 <?php  
      include 'modules.php'; 
      include 'dbconfig.php'; 

      @$hiringid = $_POST['idme'];
      @$username = $_COOKIE['usname']; 

      loadthelist();


      function updatestage2($hiringid,$username)
      {
        $proceed = 0;

        include "dbconfig.php"; 
        
        $callsql = "Select * from `monitoring` Where `hiringid` Like '$hiringid' and `username` Like '$username' and `stage` Like '2'"; 
        $daxme = mysqli_query($sqlcon,$callsql); 

        if(!mysqli_error($sqlcon))
        {
  
                  while($rows=mysqli_fetch_assoc($daxme))
                  {

                    if($rows['status']=="Completed")
                    {
                      $proceed = 1; 
                      updatethemonitor($hiringid,"Pending Examination"); 
                    }
                  }
        
        }
        else 
        {
            echo mysqli_error($sqlcon); 

        }


      return $proceed; 
    
      
      }


      function updatestage3($hiringid,$username)
      {
        $proceed = 0;

        include "dbconfig.php"; 
        
        $callsql = "Select * from `monitoring` Where `hiringid` Like '$hiringid' and `username` Like '$username' and `stage` Like '3'"; 
        $daxme = mysqli_query($sqlcon,$callsql); 

        if(!mysqli_error($sqlcon))
        {
  
                  while($rows=mysqli_fetch_assoc($daxme))
                  {

                    if($rows['status']=="Completed")
                    {
                      $proceed = 1; 
                      updatethemonitor($hiringid,"Pending Initial Interview"); 
                    }
                  }
        
        }
        else 
        {
            echo mysqli_error($sqlcon); 

        }


      return $proceed; 
    
      
      }
      




      function updatestage2OLD($hiringid,$username)
      {
        $proceed = 0;

        include "dbconfig.php"; 
        
        $callsql = "Select * from `monitoring_quiz` Where hiringid Like '$hiringid' and username Like '$username'"; 
        $daxme = mysqli_query($sqlcon,$callsql); 

        if(!mysqli_error($sqlcon))
        {
          $totalpassed = mysqli_num_rows($daxme); 
            if($totalpassed!=0)
            {
                  $colpass = 0; 
            

                  while($rows=mysqli_fetch_assoc($daxme))
                  {
                    if($rows['status']=="Passed")
                    {
                      $colpass +=1; 
                    }
                  }
        
                  if($colpass==$totalpassed)
                  {
                    $sqlme = "UPDATE `monitoring` SET `status`='Completed' Where `hiringid` Like '$hiringid' and `username` Like '$username' and `stage` Like '2'"; 
                    mysqli_query($sqlcon,$sqlme);
        
                    if(!mysqli_error($sqlcon))
                    {
                        $proceed = 1; 
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


      return $proceed; 
    
      
      }


 





      function loadthelist()
      {
        @$hiringid = $_POST['idme'];
        @$username = $_COOKIE['usname']; 
        include 'dbconfig.php'; 
       
        $sql = "Select * from `monitoring` Where `hiringid` Like '$hiringid' and `username` Like '$username' ORDER BY `stage` ASC";
        $dbt = mysqli_query($sqlcon,$sql); 
        
        if(!mysqli_error($sqlcon))
        {
          while($rows = mysqli_fetch_assoc($dbt))
          {
            if($rows['stage']=="1")
            {
              echo "
              <div class='row' style='margin-top:10px; '>
                        <div class='card col-sm-11'>
                          <div class='card-header bg-success text-white'>
                           STEP 1 - Personal Information (Status: Completed)
                          </div>
                          <div class='card-body'>
                            <h5 class='card-title'>Personal Information</h5>
                            <p class='card-text'>Important Details and Information</p>
                          </div>
                        </div>
              </div>"; 

            }
            elseif ($rows['stage']=="2")
            {

              @$status =  loadtextreturn("monitoring","status","Where hiringid Like '$hiringid' and username Like '$username' and stage Like '2'"); 
              @$docnotify =  loadtextreturn("monitoring","docssubmitted","Where hiringid Like '$hiringid' and username Like '$username' and stage Like '2'"); 
              @$docremarks =  loadtextreturn("monitoring","docremarks","Where hiringid Like '$hiringid' and username Like '$username' and stage Like '2'"); 
            
              if($status=="Completed")
              {
                $status = "Completed";
                @$thecolor = "bg-success";

              }
              else 
              {
                $status = "Pending";
                @$thecolor = "bg-info";  
              }

              echo "
              <div class='row' style='margin-top:10px;'>
                        <div class='card col-sm-11'>
                        <div class='card-header $thecolor text-white'>
                        STEP 2 - Submit Required Documents (Status: $status)
                          </div>
                          <div class='card-body'>
                            <h5 class='card-title'>Documentary Requirements</h5>";
                            
                            $docid = hiring_loaddocid($hiringid); 
                            $doccompletename = loadcompletedoctitle($docid); 
                         echo "   <p class='card-text'>Document For: ". $doccompletename . "</p>"; 
                      $verifiedtotalcount = 0; 
                      $uploadedtotalcount = 0; 
                      $totaldocuments = 0; 
                      if($status != "Completed")
                      {
                                    echo "
                                    <table class='table' style='margin-top: 10px;' id='tabledocu'>
                                      <thead>
                                        <tr>
                                          <th>Document</th>
                                          <th>Uploaded</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody>"; 


                                      $docsql = "SELECT * from `reqlist` Where reqid Like '$docid'"; 
                                      $dbtdoc = mysqli_query($sqlcon,$docsql); 

                                      if(!mysqli_error($sqlcon))
                                      {
                                        $totaldocuments = mysqli_num_rows($dbtdoc); 
                                        while($docrow = mysqli_fetch_assoc($dbtdoc))
                                        {
                                          @$reqid = $docrow['doclistid']; 
                                          @$reqtitle = loadcompletereqtitle($reqid); 
                                      
                                          if(loadnumberofdataall("userdocuments","Where username Like '$username' and docid Like '$reqid'")==0)
                                          {
                                            $sqlinsertme = "INSERT INTO `userdocuments`(`username`,`docid`) VALUES ('$username','$reqid')"; 
                                            mysqli_query($sqlcon,$sqlinsertme); 

                                            if(!mysqli_error($sqlcon))
                                            {

                                            }
                                            else 
                                            {
                                              echo mysqli_error($sqlcon);
                                            }

                                          }
                                      
                                          $getdocu = loadtextreturn("userdocuments","filename","Where username Like '$username' and docid Like '$reqid'"); 
                                          $getauth = loadtextreturn("userdocuments","authenticity","Where username Like '$username' and docid Like '$reqid'"); 
                                          $getforadmin = loadtextreturn("requirement","foradmin","Where ID Like '$reqid'"); 
                                      
                                       //   echo "admin: " . $getforadmin; 

                                          if($getforadmin==NULL||$getforadmin=="")
                                          {
                                                $setresult = ""; 
                                                if($getdocu!="")
                                                {
                                                  $setresult = "Uploaded"; 
                                                  $uploadedtotalcount +=1; 
                                                }
                                                else 
                                                {
                                                  $setresult = "For Upload"; 
                                                  echo "<tr class='text-danger'>"; 
                                                }
      
                                                $setauth = ""; 
      
                                                if($getauth=='Verified')
                                                {
                                                  $setauth = "Verified"; 
                                                  $verifiedtotalcount +=1; 
                                                  echo "<tr class='text-success'>"; 
                                                }
                                                else 
                                                {
                                                  $setauth = $getauth; 
                                              
                                                }
      
                                                echo"<td scope='row'>$reqtitle</td>";  
                                                echo "<td>$setresult</td>"; 
                                                echo " <td>$setauth</td>"; 
                                                echo "</tr>"; 
                                          }
                                          else 
                                          {
                                            $verifiedtotalcount +=1;  
                                            $uploadedtotalcount +=1;  
                                          }
                                       
                                        }


                                  


                                      }
                                      else 
                                      {
                                        echo mysqli_error($sqlcon); 
                                      }
                                      

                                        echo "
                                              </tbody>
                                            </table>
                                          "; 


                                          if($verifiedtotalcount == $totaldocuments)
                                          {
                                            $sqlstage3 = "UPDATE `monitoring` SET `status`='Completed' Where `hiringid` Like '$hiringid' and `username` Like '$username' and `stage` Like '3'"; 
                                            mysqli_query($sqlcon,$sqlstage3);
                                
                                            if(!mysqli_error($sqlcon))
                                            {
                                               
                                            }
                                            else 
                                            {
                                              echo mysqli_error($sqlcon); 
                                            }
                                          }
                                 

                                          @$thehiringid = '"'. $hiringid . '"'; 
                                          @$usernow = '"'. $username . '"'; 

                                          if($uploadedtotalcount == $totaldocuments)
                                          {
                                            @$disme = ""; 
                                            if($docnotify=="notified")
                                            {
                                              $disme = "disabled";
                                            }
                                            echo "<button type='button' id='btn-submitupload' class='btn btn-sm btn-success' style='margin-left:10px;' onclick='submitnotifupload($thehiringid,$usernow)' $disme>Submit Documents</button><img src='images/ajax-loader.gif' style='margin-left:10px;' id='ajaxloadingupload'/>";
                                           

                                            if($docremarks!=NULL||$docremarks!='')
                                            {
                                              echo "<div id='docremarksreload'class='text-danger' style='margin-top:10px;'>Remarks: $docremarks</div>"; 
                                            }


                                            if($docnotify=="notified")
                                            {
                                              echo "<div id='docsubreload' class='text-success' style='margin-top:10px;'>Admin is already notified</div>"; 
                                            }
                                            else 
                                            {
                                              echo "<div id='docsubreload' style='margin-top:10px;'></div>"; 
                                            }
                                          }
                                          else 
                                          {
                                            echo "<a href='uploads.php?content=all&hiringid=$hiringid' class='btn btn-sm btn-warning' style='margin-top:10px;'>Upload Documents</a>"; 
                                          }
                        
                      }
                      else 
                      {
                        echo "<p class='text-success'>Your documents is Verified</p>";
                      }
     
                       echo "</div></div></div>"; 

            }
            elseif ($rows['stage']=="3")
            {
  
              @$status = ""; 
              @$disable = "";
              @$quizid = $rows['quizid'];
              @$proceed = updatestage3($hiringid,$username); 
              @$stage2status = updatestage2($hiringid,$username); 
              @$thecolor = "";

              if($proceed==0)
              {
                $status = "Pending";
                @$thecolor = "bg-info";
              }
              else 
              {
                $status = "Completed";
                @$thecolor = "bg-success";
              }

              echo "
              <div class='row' style='margin-top:10px; '>
                        <div class='card col-sm-11'>
                          <div class='card-header $thecolor text-white'>
                           STEP 3 - Examinations (Status: $status)
                          </div>
                          <div class='card-body'>
                            <h5 class='card-title'>Examination</h5>
                            <p class='card-text'>REQ: to passed the exam atleast 70%</p>"; 

                           
                            if($stage2status==1)
                            {
                              echo "
                              <table class='table'> 
                                <thead> 
                                    <tr>
                                    <th>Function</th> 
                                    <th>Status/Score</th> 
                                    <th>Option</th>
                                    </tr> 
                                </thead> 
                                <tbody> ";
                                if($status=="Pending")
                                {
                                   
                                  
      
                                    $callsql = "Select * from `monitoring_quiz` Where hiringid Like '$hiringid' and username Like '$username' ORDER BY ID ASC"; 
                                    $daxme = mysqli_query($sqlcon,$callsql); 
                                    @$disabledother = false; 
                                    if(!mysqli_error($sqlcon))
                                    {
                                      while($dips = mysqli_fetch_assoc($daxme))
                                      {
                                          @$val = $dips['session']; 
                                          @$rem = 5-$val; 
  
                                          @$functiononly = $dips['functionid']; 
                                          @$thestatus = $dips['status']; 
                                            @$functionquiz =  loadquizshort($functiononly); 
                                        //   @$theaddress = '"'. "quizmode.php?function=$functiononly&qn=10&hiringid=$hiringid" .'"'; 
                                          @$thefunction = '"'. $dips['functionid'] .'"'; 
                                          @$thehiringid = '"'. $hiringid . '"'; 
                                          @$usernow = '"'. $username . '"'; 
                                          @$disabled = ""; 
                                          
  
                                          if($disabledother==false)
                                          {
                                            if($thestatus=='Pending'||$thestatus=='Ongoing')
                                            {
                                              $disabled = ""; 
                                              $disabledother=true; 
                                              echo "
                                              <tr> 
                                                  <td>$functionquiz</td> 
                                                  <td>$thestatus</td> 
                                                  <td>  <button type='button' class='btn btn-sm btn-success' onclick='popupwindow($thefunction,$thehiringid,$usernow)' $disabled>Proceed</button>  </td> 
                                              </tr>";
                                            }
                                            else 
                                            {
                                          
                                              $disabled =  "disabled"; 
                                              echo "
                                              <tr> 
                                                  <td>$functionquiz</td> 
                                                  <td>For Checking</td> 
                                                  <td>  <button type='button' class='btn btn-sm btn-success' onclick='popupwindow($thefunction,$thehiringid,$usernow)' $disabled>Done</button>  </td> 
                                              </tr>";
                                            }
                                          }
                                          else 
                                          {
                                            $disabled =  "disabled"; 
                                            echo "
                                            <tr> 
                                                <td>$functionquiz</td> 
                                                <td>Pending</td> 
                                                <td>  <button type='button' class='btn btn-sm btn-success' onclick='popupwindow($thefunction,$thehiringid,$usernow)' $disabled>Proceed</button>  </td> 
                                            </tr>";
                                          } 
  
                                        
                                      }
                                    }
                                    else 
                                    {
                                      echo mysqli_error($sqlcon);
                                    }
    
  
                                    updatestage2examfinish($hiringid,$username); 
                                }
                             
                            
  
                                
  
                               echo "</tbody> </table>"; 
                            }
                            else 
                            {
                              echo "<p class='text-danger'>Wait for Document Approval to proceed in examination</p>";
                            }
                          
                          echo "</div></div></div>"; 
            }            
            elseif ($rows['stage']=="4")
            {

              @$stage3status = loadtextreturn("monitoring","status","Where hiringid Like '$hiringid' and username Like '$username' and stage Like '3'"); 
              @$stage4status = loadtextreturn("monitoring","status","Where hiringid Like '$hiringid' and username Like '$username' and stage Like '4'"); 
              @$dateexam = loadtextreturn("monitor_applicant","dateset","Where hiringid Like '$hiringid' and applicantusername Like '$username'"); 
              @$datecomplete = $dateexam; 
              @$timeexam = loadtextreturn("monitor_applicant","timeset","Where hiringid Like '$hiringid' and applicantusername Like '$username'"); 
              @$remarks = loadtextreturn("monitor_applicant","remarks","Where hiringid Like '$hiringid' and applicantusername Like '$username'"); 
              @$confirmstatus = loadtextreturn("monitor_applicant","confirmation","Where hiringid Like '$hiringid' and applicantusername Like '$username'"); 
              @$confirmdate = loadtextreturn("monitor_applicant","confirmationdate","Where hiringid Like '$hiringid' and applicantusername Like '$username'"); 
              @$confirmdatecomplete =  loadregistrationtocompletedate($confirmdate); 

             
              @$buttonshow = ""; 

              if($stage4status=="Completed")
              {
                $buttonshow = "";
              }
              else 
              {
                $buttonshow = "disabled";
              }
              echo "
              <div class='row' style='margin-top:10px;'>
                        <div class='card col-sm-11'>
                          <div class='card-header bg-info text-white'>
                           STEP 4 - On-site interview (Status: Pending)
                              </div>
                          <div class='card-body'>"; 
                          
                          if($stage3status=="Completed") 
                          {
                            if (loadnumberofdataall("monitor_applicant","Where hiringid Like '$hiringid' and applicantusername Like '$username'")!=0)
                            {
                                echo "
                                <h5 class='card-title'>On-site interview</h5>
                                <p class='text-dark'>Schedule: $datecomplete </p>
                                <p class='text-dark'>Time: $timeexam </p>
                                <p class='text-dark'>Add. Info: $remarks </p>
                                <p class='text-dark'>If your not available in this schedule, please select Resched or Cancel. <span class='text-danger'> IMPORTANT: </span>Your schedule will proceed even without pressing the confirm button but it is advisable to notify your employer by pressing the button CONFIRM</p>
                               "; 
                               @$thehiringid = '"'. $hiringid . '"'; 
                               @$usernow = '"'. $username . '"'; 
                               @$toconfirm = '"Confirm"'; 
                               @$tocancel = '"Cancel"';


                               if($confirmstatus=='')
                               {
                                echo "<div id='appointmenttab'>";
                                echo "<div class='form-group' style='margin-top: 10px;'>";
                                echo "<label for='confirmremarks'>Additional Remarks</label>";
                                echo "<textarea class='form-control form-control-sm' id='confirmremarks' rows='3' placeholder='Ex. I am not available in this schedule' style='margin-bottom: 10px; '></textarea>";
                               echo "<button type='button' class='btn btn-sm btn-success' onclick='submitnotif($thehiringid,$usernow,$toconfirm)'>Confirm</button>
                               <button type='button' class='btn btn-sm btn-danger' onclick='submitnotif($thehiringid,$usernow,$tocancel)'>Resched/Cancel</button>
                                ";
                                echo "</div>";
                                echo "</div>";
                               }
                               else 
                               {
                                if($confirmstatus=='Confirm')
                                {

                                  echo "<p class='text-success'>Schedule to Confirmed</p>"; 
                                  echo "<p class='text-success'>Confirmed Date: $confirmdatecomplete</p>";
                                }
                                else 
                                {
                                  echo "<p class='text-danger'>Schedule to be Cancelled</p>"; 
                                  echo "<p class='text-success'>Confirmed Date: $confirmdatecomplete</p>";
                                }


                               }
                          
                            }
                            else 
                            {
                              echo "<p class='text-danger'>Waiting for the employer to set the schedule</p>";  
                            }
                          }
                          else  
                          {
                            echo "<p class='text-danger'> Required to finish the Examination</p>";
                          }
                      

                          echo "
                          </div>
                        </div>
              </div>
              ";
            }


          }
        }
        else
        {

          echo mysqli_error($sqlcon); 

        } 

              
      }

?> 