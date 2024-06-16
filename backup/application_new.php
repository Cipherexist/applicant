 <?php  
      include 'modules.php'; 
      include 'dbconfig.php'; 
      include 'loadtables.php'; 

      @$hiringid = $_POST['idme'];
      @$username = $_COOKIE['usname']; 
      @$dateme = loadregistrationdatetoday(); 


      if(loadnumberofdataall('monitoring',"Where `hiringid` Like '$hiringid' and `username`='$username'")==0)
      {
        $sqlme = "SELECT * from `hiring` Where ID Like '$hiringid'";
        $dbt = mysqli_query($sqlcon,$sqlme); 

        if(!mysqli_error($sqlcon))
        {
          while($rows = mysqli_fetch_assoc($dbt))
          {
            @$docid = $rows['docid']; 
            @$quizid = $rows['quizid']; 
            @$level = $rows['level']; 
         
            $x = 0; 

            for($x=1;$x<=$level;$x++)
            {
              $savesql = "INSERT INTO `monitoring`(`hiringid`,`stage`,`username`,`docid`,`quizid`,`status`,`datedone`,`datereg`) VALUES ('$hiringid','$x','$username','$docid','$quizid','','','$dateme')"; 
              mysqli_query($sqlcon,$savesql); 

              if(!mysqli_error($sqlcon))
              {
              // loadthelist();


                    if(loadnumberofdataall("monitoring_quiz","Where hiringid Like '$hiringid' and username Like '$username'")=="0")
                    { 
                      $selectquiz = "Select * from `quizmanagement_list` Where `quiztitle` Like '$quizid'"; 
                      $daxme = mysqli_query($sqlcon,$selectquiz); 

                      if(!mysqli_error($sqlcon))
                      {
                        while($dips = mysqli_fetch_assoc($daxme))
                        {
                          @$functiononly = $dips['quizfunction']; 
                              @$functionquiz =  loadquizshort($functiononly); 
                          
                              @$theaddress = '"'. "quizmode.php?function=$functiononly&qn=10&hiringid=$hiringid" .'"'; 


                              $sqlinsert = "INSERT INTO `monitoring_quiz`(`username`,`hiringid`,`quizid`,`functionid`,`session`,`status`,`timer`,`active`,`insertdate`) VALUES ('$username','$hiringid','$quizid','$functiononly','1','Pending','10:00','','$dateme')"; 
                              mysqli_query($sqlcon,$sqlinsert); 

                              if(!mysqli_error($sqlcon))
                              {
                               // loadthelist();
                                echo 1;

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
                     echo 1; 
                    }

              }
              else 
              {
                echo mysqli_error($sqlcon); 
              }
            }

          }
          updatethemonitor($hiringid,"Pending Exam");
        }
        else 
        {
          echo mysqli_error($sqlcon); 

        }
      }
      else 
      {
       echo 1;

      }


?> 