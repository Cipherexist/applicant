<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function deletelastsession($course,$trainee,$session)
{
    include 'dbconfig.php'; 
    $mysqldel = "DELETE from onlineresults Where username Like '$trainee' and course Like '$course' and session Like '$session'"; 
    $dbt = mysqli_query($sqlcon,$mysqldel); 
    if(mysqli_error($sqlcon))
    {
    echo mysqli_error($sqlcon);
    }
} 


function loadmyquestion($qnumber,$mycode,$mysession,$hiringid)
{
    include 'dbconfig.php'; 

    @$traineeid = $_COOKIE['usname']; 
    
    @$myclasscode = $mycode; 
    @$mynewnumber;  
    @$myhiring = $hiringid; 

       // $mynewnumber = $qnumber + 1; 
        $mynewnumber = $qnumber; 

 
    @$newsession = $mysession; 
    @$mycompetence = $competence; 

$mysqli = "Select * from onlineresults Where course Like '$myclasscode'  and qno Like '$mynewnumber' and username Like '$traineeid' and session Like '$newsession' and hiringid Like '$myhiring'"; 
//echo $mysqli;
@$thesqlme =  "'" + $mysqli + "'"; 

$dba = mysqli_query($sqlcon,$mysqli); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dba)!=0)
        {
            if($rows = mysqli_fetch_assoc($dba))
            {   
                @$question = str_replace("'","",$rows['question']); 
              
                @$c1 = str_replace("'","",$rows['c1']); 
                @$c2 = str_replace("'","",$rows['c2']); 
                @$c3 = str_replace("'","",$rows['c3']); 
                @$c4 = str_replace("'","",$rows['c4']); 
                @$c1checked = ""; 
                @$c2checked = ""; 
                @$c3checked = ""; 
                @$c4checked = ""; 
                @$uranswernow = $rows['uranswer']; 
                if($rows['c1'] == $rows['uranswer'])
                {
                    $c1checked = "checked";
                }
                else if ($rows['c2'] == $rows['uranswer'])
                {
                    $c2checked = "checked";
                }
                else if ($rows['c3'] == $rows['uranswer'])
                {
                    $c3checked = "checked";
                }
                else if ($rows['c4']== $rows['uranswer'])
                {
                    $c4checked = "checked";
                }
                else 
                {
                    //echo "WALA " . $rows['uranswer'];
                }
                
            
                
                echo "

                <div class='row  questionstyle'> 
                <h4 class='noselectlarge'>$question</p>
                </div> 

                <div class='row justify-content-md-left choicesstyle' style='margin-top: 10px;'>
                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault1' $c1checked value='$c1'>
                <label class='form-check-label noselect' for='flexRadioDefault1'>
                $c1
                </label>
                </div>

                <div class='row justify-content-md-left choicesstyle'>
                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault2' $c2checked value='$c2'>
                <label class='form-check-label noselect' for='flexRadioDefault2'>
                 $c2
                </label>
                </div>

                <div class='row justify-content-md-left choicesstyle'>
                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault3' $c3checked value='$c3'>
                <label class='form-check-label noselect' for='flexRadioDefault3'>
                $c3
                </label>
                </div>

                <div class='row justify-content-md-left choicesstyle'>
                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault4' $c4checked value='$c4'>
                <label class='form-check-label noselect' for='flexRadioDefault4'>
                  $c4
                </label>
                </div>
                "; 
                

             }
         }
         else 
         {
            $myaverage = loadmyaverage($traineeid,$myclasscode,$newsession,$myhiring); 
          //  loadupdatemyaverage($traineeid,$myclasscode,$myaverage); 
          
          //ENABLE ANYTIME TO USE SHOW ALL THE AFTER EXAM 
          // 
            //

           // inserttohistory($traineeid, $myclasscode);
          //  echo "<h3> Your Average is : " . $myaverage . "% </h3>";
            if($myaverage<60)
            {
                updatetimer($traineeid,$myhiring,$myclasscode,"10:00"); 
             //   echo "<h4 style='color: red;'> You need atleast 70% to PASSED the Examination </h4>";
                $sessionupdate = (int)$newsession + 1; 
              //  updatesession($traineeid,$myhiring,$myclasscode,$sessionupdate); 
             //   updatetimer($traineeid,$thehiring,$myclasscode,"10:00"); 
               checkmylastsessiononly($traineeid,$myclasscode,$myhiring,$newsession);
                updatestatus($traineeid,$myhiring,$myclasscode,"Failed"); 
                sendexamemail($myhiring); 
                echo "<h4>Your Examination is Finished</h4>";
            }
            else 
            {
                
               
                updatestatus($traineeid,$myhiring,$myclasscode,"Passed"); 
             //   updatetimer($traineeid,$myhiring,$myclasscode,"10:00"); 
               // checkmylastsession($traineeid,$myclasscode,$myhiring,$newsession);
               sendexamemail($myhiring); 
                checkmylastsessiononly($traineeid,$myclasscode,$myhiring,$newsession);
              // echo "<h4 style='color: green;'> Congratulations you PASSED the Exam! </h4>";
                echo "<h4>Your Examination is Finished</h4>";
           
            }
         }
    }
}




function showtablelist($hiringid)
{
    include 'dbconfig.php'; 

    @$traineeid = $_COOKIE['usname']; 
    @$id = $hiringid; 
    @$tableresult = ""; 

    $sqlme = "Select * from `onlineaverage` Where `hiringid` Like '$id' and `username` Like '$traineeid'"; 

    $dbt = mysqli_query($sqlcon,$sqlme); 

    if(!mysqli_error($sqlcon))
    {
        $tableresult = "<table>
        <tr>
        <th>Function</th>
         <th>Score</th> 
         <th>Result</th>
         </tr>"; 
        while($rows = mysqli_fetch_assoc($dbt))
        {
            @$functionid = loadquizname($rows['functionid']); 
            @$average = $rows['average']; 
            @$result = $rows['status']; 

            $tableresult = $tableresult. "<tr>
            <td>$functionid</td>
            <td>$average</td>
            <td>$result</td>
            </tr>";
             

            
        }
        $tableresult = $tableresult. "</table>";
    }
    else
    {
        echo mysqli_error($sqlcon); 
    }

    return $tableresult; 

}

function sendexamemail($hiringid)
{
 
  // $emailsent = "cipherexist@gmail.com"; 
   $emailsent = "virtuemaritime.online@gmail.com"; 
    @$traineeid = $_COOKIE['usname']; 

    @$completename = loadcompletename($traineeid);
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    @$smtpUsername = "info@virtuemaritime.com"; 
    @$smtpPassword = "Vir@00000"; 
    @$emailFrom = $smtpUsername; 
    @$emailFromName = "Examination Completed for [$completename]"; 
    @$emailTo = $emailsent; 
    @$emailToName = "Applicant"; 
    @$hrid = $hiringid; 

    
    $birthDate = loadtextreturn("applicantinfo","birthdate","Where username Like '$traineeid'");
    @$contactnumber = loadtextreturn("applicantinfo","contactnumber","Where username Like '$traineeid'");
    @$emailadd = $traineeid; 
    //explode the date to get month, day and year
    $birthDate = explode("/", $birthDate);
    //get age from date or birthdate
    @$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
      ? ((date("Y") - $birthDate[2]) - 1)
      : (date("Y") - $birthDate[2]));




   
    @$hiringtitle = loadtextreturn("hiring","hiringtitle","Where `ID` Like '$hrid'"); 


    $mail = new PHPMailer;
    $mail->isSMTP(); 
  //  $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "mail.virtuemaritime.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 465; // TLS only
    $mail->SMTPSecure = 'ssl'; // ssl is depracated
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->setFrom($emailFrom, $emailFromName);
    $mail->addAddress($emailTo, $emailToName);
    $mail->Subject = "(NOTIFICATION) EXAMINATION FINISHED" ;
    $mail->Body  =  "<h4> Applicant is successfully finished the examination via Online Application</h4>".
    "<p>Name: $completename</p>" .   "</br>".
    "<p>Age: $age</p>" .   "</br>".
    "<p>Email: $emailadd</p>" .   "</br>".
    "<p>Contact Number: $contactnumber </p>" .   "</br>".
    "<p>Hiring for: $hiringtitle</p>" .   "</br></br>". 
    showtablelist($hrid)."</br></br>".
    "<p>Examination are based on the current result on taken online</p>" .   "</br>". 
    "</br>".
    "<p> Login using portal to see complete details, <a href='https://www.virtuemaritime.com/virtueonline/'>Click here</a></p>".
      $mail->AltBody = 'VirtueMaritime@2023';
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

    if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
           
     
    }

}


function sendemail($traineecode,$myclasscode,$totalaverage)
{
    require 'PHPMailer/PHPMailerAutoload.php';
    
    $mail = new PHPMailer;
    // Set mailer to use SMTP
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'shu20.unified-servers.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@navigatormaritime.com';                 // SMTP username
    $mail->Password = 'N@vigator0000';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;    
    
    
    $mail->setFrom('info@navigatormaritime.com', 'EXAMINATION PASSED');
    //$mail->addAddress('registrar@navigatormaritime.com');     // Add a recipient
    $mail->addAddress('marketing@navigatormaritime.com');   
    $mail->addAddress('registrar@navigatormaritime.com');   
   // $mail->addAddress('mis@navigatormaritime.com');   
    //$mail->addAddress('info@navigatormaritime.com');   
    //  $mail->addAddress('mmvalerio@navigatormaritime.com');  
    // $mail->addAddress('mis@navigatormaritime.com');  
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    //$mail->isHTML(true);                                  // Set email format to HTML
    $mycode = loadcompletecoursecode($myclasscode);
    $mail->Subject = 'Online Training is finished for <'. loadtraineecompletename($traineecode) . '>' ;
    $mail->Body    =  '<p> Course: '. loadcompletecoursename($mycode) .'</p>'.
    '</br>'.
    '<p>Date Training: '. loadcompletetrainingdate($myclasscode) . '</p>'.
    '<p>Complete Name: '. loadtraineecompletename($traineecode) .'</p>'.
    '<p>Total Score: '. $totalaverage .'%</p>'.
    '</br>'.
    '<p> MESSAGE: You can now passed on the navisys to print the certificate</p>'.
    $mail->AltBody = '(This is automated, do not reply)';
    
    if(!$mail->send()) 
    {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    
    } 
    else 
    {
    // echo 'Data has been saved';
    }


}

function loadupdatemyaverage($traineecode,$classcode,$average) 
{
    @$mytraineeid = $traineecode; 
    @$mycode = $classcode; 
    @$myaverage = $average; 


    if($myaverage>=75)
    {
        $myquery = "UPDATE `onlinetrainings` SET `average`='$myaverage', `status`='Passed' Where traineeid Like '$traineecode' and classcode Like '$mycode'"; 

    }
    else 
    {
        $myquery = "UPDATE `onlinetrainings` SET `average`='$myaverage' Where traineeid Like '$traineecode' and classcode Like '$mycode'"; 
    }
   include 'dbconfig.php'; 
   $dbt = mysqli_query($sqlcon,$myquery); 
   if(mysqli_error($sqlcon))
   {
       echo mysqli_error($sqlcon); 
   }

}

function checkmylastsession($traineecode, $code, $hiringno, $session)
{
    include 'dbconfig.php'; 
    
    $mysqlme = "SELECT * FROM onlineresults Where username Like '$traineecode' and course Like '$code' and session Like '$session' and `hiringid` Like '$hiringno'"; 
    $dbt=mysqli_query($sqlcon,$mysqlme); 
    $x = 0; 
    $totalcorrect = 0; 
    $totalcount = 0;

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<table class="table table-bordered mydatatable">';
            echo "<tr>
            <th> NO </th>
            <th> QUESTION </th>
            <th> YOUR ANSWER </th>
            <th> STATUS / CORRECT ANSWER </th>
            </tr>
            ";
            
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$question = $rows["question"]; 
                @$correctanswer = $rows["answer"]; 
                @$uranswer = $rows["uranswer"]; 
                @$status = $rows["status"]; 
                @$stats = "";
                $totalcount +=1;
                @$x +=1; 

                if($rows['status']=='PASSED')
                {
                    $totalcorrect +=1;
                    echo "<tr style='background-color:lightgreen;'>"; 
                    $stats = "CORRECT";
                }
                else 
                {
                    echo "<tr style='background-color:orange;'>";
                    $stats = "<strong>". $correctanswer . "</strong>";
                }
                echo "<td> $x </td>"; 
                echo "<td> $question </td>"; 
                echo "<td> $uranswer </td>"; 
                echo "<td> $stats </td>"; 
            }

            echo "</table>"; 
      

            $sql2 = "SELECT * from onlineaverage Where `username` Like '$traineecode' and `hiringid` Like '$hiringno' and `functionid` Like '$code' and session Like '$session' "; 
            $dba = mysqli_query($sqlcon,$sql2); 

            if(!mysqli_error($sqlcon))
            {
                if(mysqli_num_rows($dba)!=0)
                {
                    mysqli_query($sqlcon,"DELETE from onlineaverage Where `username` Like '$traineecode' and `hiringid` Like '$hiringno' and `functionid` Like '$code' and session Like '$session' ");
                    
                    if(mysqli_error($sqlcon))
                    {
                        echo mysqli_error($sqlcon); 
                    }
                }

                @$average = round(($totalcorrect/$totalcount)*100); 
                @$thestatus = ""; 

                if($average>=70)
                {
                    $thestatus = "PASSED";
                }
                else 
                {
                    $thestatus = "FAILED"; 
                }

                @$globaldate = loadregistrationdatetoday(); 
                @$globaltime = loadregistrationtime();

                $insertnow = "INSERT INTO `onlineaverage` (`username`,`hiringid`,`session`,`totalcorrect`,`totalitems`,`average`,`status`,`datetoday`,`timetoday`,`functionid`) VALUES ". 
                "('$traineecode','$hiringno','$session','$totalcorrect','$totalcount','$average','$thestatus','$globaldate','$globaltime','$code')"; 
                mysqli_query($sqlcon,$insertnow); 
            
                if(mysqli_error($sqlcon))
                {
                    echo mysqli_error($sqlcon); 
                }
            }
            else 
            {
                echo mysqli_error($sqlcon); 
            }
        
        }
        else 
        {
            echo "NO TABLE TO SHOW";
        } // END


    }
    else 
    {
        echo mysqli_error($sqlcon);
    }
}


function checkmylastsessiononly($traineecode, $code, $hiringno, $session)
{
    include 'dbconfig.php'; 
    
    $mysqlme = "SELECT * FROM onlineresults Where username Like '$traineecode' and course Like '$code' and session Like '$session' and `hiringid` Like '$hiringno'"; 
    $dbt=mysqli_query($sqlcon,$mysqlme); 
    $x = 0; 
    $totalcorrect = 0; 
    $totalcount = 0;

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
          
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$question = $rows["question"]; 
                @$correctanswer = $rows["answer"]; 
                @$uranswer = $rows["uranswer"]; 
                @$status = $rows["status"]; 
                @$stats = "";
                $totalcount +=1;
                @$x +=1; 

                if($rows['status']=='PASSED')
                {
                    $totalcorrect +=1;
                   
                    $stats = "CORRECT";
                }
                else 
                {
                  
                    $stats = "<strong>". $correctanswer . "</strong>";
                }
           
            }

      

            $sql2 = "SELECT * from onlineaverage Where `username` Like '$traineecode' and `hiringid` Like '$hiringno' and `functionid` Like '$code' and session Like '$session' "; 
            $dba = mysqli_query($sqlcon,$sql2); 

            if(!mysqli_error($sqlcon))
            {
                if(mysqli_num_rows($dba)!=0)
                {
                    mysqli_query($sqlcon,"DELETE from onlineaverage Where `username` Like '$traineecode' and `hiringid` Like '$hiringno' and `functionid` Like '$code' and session Like '$session' ");
                    
                    if(mysqli_error($sqlcon))
                    {
                        echo mysqli_error($sqlcon); 
                    }
                }

                @$average = round(($totalcorrect/$totalcount)*100); 
                @$thestatus = ""; 

                if($average>=70)
                {
                    $thestatus = "PASSED";
                }
                else 
                {
                    $thestatus = "FAILED"; 
                }

                @$globaldate = loadregistrationdatetoday(); 
                @$globaltime = loadregistrationtime();

                $insertnow = "INSERT INTO `onlineaverage` (`username`,`hiringid`,`session`,`totalcorrect`,`totalitems`,`average`,`status`,`datetoday`,`timetoday`,`functionid`) VALUES ". 
                "('$traineecode','$hiringno','$session','$totalcorrect','$totalcount','$average','$thestatus','$globaldate','$globaltime','$code')"; 
                mysqli_query($sqlcon,$insertnow); 
            
                if(mysqli_error($sqlcon))
                {
                    echo mysqli_error($sqlcon); 
                }
            }
            else 
            {
                echo mysqli_error($sqlcon); 
            }
        
        }
        else 
        {
            echo "NO TABLE TO SHOW";
        } // END


    }
    else 
    {
        echo mysqli_error($sqlcon);
    }
}


function inserttohistory($traineecode, $code)
{
    include 'dbconfig.php'; 
    @$sessiondate = date("m-d-y,H:m:s"); 

   
    $mysqlme = "SELECT * FROM onlineresults Where username Like '$traineecode' and course Like '$code'"; 
    $dbt=mysqli_query($sqlcon,$mysqlme); 
    $x = 0; 
    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
        
            
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$question = $rows["question"]; 
                @$uranswer = $rows["uranswer"]; 
                @$status = $rows["status"]; 
                @$stats = "";

                $insertsql = "INSERT INTO `onlineresulthistory` (`session`,`question`,`youranswer`,`status`,`username`,`classno`) VALUES ". 
                "('$sessiondate','$question','$uranswer','$status','$traineecode','$code')"; 
              
                $dbax  = mysqli_query($sqlcon,$insertsql); 

                if(!mysqli_error($sqlcon))
                {
                    echo mysqli_error($sqlcon); 
                }
            }

        }
    }
}


function loadmytotalquestions($mycode,$mysession)
{
    include 'dbconfig.php'; 

    @$traineeid = $_COOKIE['usname']; 

    @$myclasscode = $mycode;
    @$newsession = $mysession; 

$mysqli = "Select * from onlineresults Where course Like '$myclasscode' and username Like '$traineeid' and session Like '$newsession'"; 
$dba = mysqli_query($sqlcon,$mysqli); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dba)!=0)
        {
            echo mysqli_num_rows($dba); 
        }
    }

}

function loadmyaverage($traineecode,$code,$sessionme,$hiringme)
{
    $myaverage = 0; 
    @$mytraineecode = $traineecode; 
    @$mycode = $code; 
    @$mysession = $sessionme; 

    include 'dbconfig.php'; 

    $mysqlme = "SELECT * FROM onlineresults Where username Like '$mytraineecode' and session Like '$mysession' and hiringid Like '$hiringme' and course Like '$mycode'"; 
    $dbt=mysqli_query($sqlcon,$mysqlme); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            $mytotalpass = 0; 
            $totalcount = mysqli_num_rows($dbt); 

            while($rows = mysqli_fetch_assoc($dbt))
            {
              if($rows['status']=='PASSED')
              {
                  $mytotalpass +=1; 

              }    
            }
            $myaverage = ($mytotalpass / $totalcount) * 100;
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }

    return round($myaverage);
}




function loadquizfirsttime($function,$qn,$sessionnumber,$hiringno) 
{
include 'dbconfig.php';
@$myviewtype = $function; 
@$mycompetence = "1";
@$email = $_COOKIE['usname'];
@$sessionid = $sessionnumber; 
@$thenumber = $qn; 
@$hiring = $hiringno; 

    $mysql = "Select * from `preboard` Where `FUNCTION` like '$function' ORDER BY RAND() LIMIT $thenumber"; 
    $dba = mysqli_query($sqlcon, $mysql); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dba)!=0)
        {   
            @$myemail = $_COOKIE['usname']; 
            @$qno = 0; 
            updatetimer($myemail,$hiring,$function,"10:00"); 
            while($rows = mysqli_fetch_assoc($dba))
            {
            
                @$question = str_replace("'","",$rows['QUESTION']); 
                @$answer = str_replace("'","",$rows['C1']); 
                @$qno +=1; 
                @$my_array = array($rows['C1'],$rows['C2'],$rows['C3'],$rows['C4']);
                
                shuffle($my_array);
                @$c1 =  str_replace("'","",$my_array[0]); 
                @$c2 =  str_replace("'","",$my_array[1]);
                @$c3 =  str_replace("'","",$my_array[2]);
                @$c4 =  str_replace("'","",$my_array[3]);

                $mysqlme = "INSERT INTO `onlineresults` (`qno`,`course`,`question`,`username`,`session`,`answer`,`c1`,`c2`,`c3`,`c4`,`competence`,`hiringid`) VALUES('$qno','$myviewtype','$question','$myemail','$sessionid','$answer','$c1','$c2','$c3','$c4','$mycompetence','$hiring')"; 
                $dbax = mysqli_query($sqlcon, $mysqlme); 
                
                if(!mysqli_error($sqlcon))
                {
                // echo $numberofdata; 
                }
                else 
                {
                    echo mysqli_error($sqlcon); 
                }

            }
        }
        else
        {
            echo  "LOADFIRSTTIME: " . $mysql; 
        }
    }
    else
    {
        echo mysqli_error($sqlcon); 
    
    }
}



?> 

