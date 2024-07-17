<?php 
include "dbconfig.php"; 
include "modules.php"; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

@$username = $_POST['myusername']; 
@$password = $_POST['mypassword']; 
@$firstname = $_POST['myfirstname']; 
@$middlename = $_POST['mymiddlename']; 
@$lastname = $_POST['mylastname']; 
@$address = $_POST['myaddress']; 
@$birthdateno = $_POST['mybirthdate']; 
@$completename = $firstname. ' ' . $middlename . ' '. $lastname; 
@$suffix1 = ""; 
@$suffix2 = ""; 
@$birthplace = "";
@$gender =  $_POST['mygender']; 
@$currentrank =  $_POST['myrank'];
@$appliedrank =   $_POST['myrankapplied'];
@$contactnumber = $_POST['mycontactnumber']; 
@$relation = $_POST['myrelation'];
@$cadet = $_POST['mycadet']; 
@$experience = $_POST['myonboardexperience']; 
@$previouscompany = $_POST['mypreviouscompany']; 
@$registereddate = loadregistrationdatetoday(); 
@$availability = $_POST['myavailability']; 




@$mymonth = date('m');
@$myday = date('d'); 
@$myyear = date('Y'); 


if(loadnumberofdataall("applicantinfo","Where `username` Like '$username'")==0) 
{
        if (loadnumberofdataall("applicantinfo","Where `firstname` Like '$firstname' and `middlename` like '$middlename' and `lastname` Like '$lastname'")==0) 
        {
        
            $sql2 = "INSERT INTO `applicantinfo` (`username`,`firstname`,`middlename`,`lastname`,`address`,`birthdate`,`suffix1`,`suffix2`,`birthplace`,`currentrank`,`contactnumber`,`gender`,`applyingrank`,`relation`,`cadet`,`experience`,`previouscompany`,`status`,`dateavailability`) 
            VALUES ('$username','$firstname','$middlename','$lastname','$address','$birthdateno','$suffix1','$suffix2','$birthplace','$currentrank','$contactnumber','$gender','$appliedrank','$relation','$cadet','$experience','$previouscompany','applicant','$availability')";
            mysqli_query($sqlcon,$sql2); 

            if(!mysqli_error($sqlcon))
            {


                $sql  = "INSERT INTO `useracct` (`username`,`password`,`accounttype`,`userinfo`,`registereddate`,`mymonth`,`myday`,`myyear`,`verificationcode`,`verified`) VALUES ('$username','$password','applicant','$completename','$registereddate','$mymonth','$myday','$myyear','','no')";

                mysqli_query($sqlcon,$sql); 

                if(!mysqli_error($sqlcon))
                {

                    $emailsent = "virtuemaritime.online@gmail.com"; 
             

                    $birthDate = $birthdateno;
                    //explode the date to get month, day and year
                    $birthDate = explode("/", $birthDate);
                    //get age from date or birthdate
                    @$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                      ? ((date("Y") - $birthDate[2]) - 1)
                      : (date("Y") - $birthDate[2]));
                  
                    @$completerank = loadcompleterank($currentrank); 
                
                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';
                    @$smtpUsername = "info@virtuemaritime.com"; 
                    @$smtpPassword = "Vir@00000"; 
                    @$emailFrom = $smtpUsername; 
                    @$emailFromName = "Newly Registered Applicant - Virtue Maritime"; 
                    @$emailTo = $emailsent; 
                    @$emailToName = "Applicant"; 
                
                
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
                    $mail->addAddress("virtuemaritime.online@gmail.com", $emailToName);
                    //$mail->addAddress("cipherexist@gmail.com", $emailToName);
                    $mail->Subject = "(NOTIFICATION) NEWLY REGISTERED APPLICANT" ;
                    $mail->Body  =  "<h4> Applicant is successfully registered via Online Application</h4>".
                    "<p>Name: $completename</p>" .   "</br>".
                    "<p>Email: $username</p>" .   "</br>".
                    "<p>Gender: $gender</p>" .   "</br>".
                    "<p>Birthdate: $birthdateno</p>" .   "</br>".
                    "<p>Rank: $completerank</p>" .   "</br>".
                    "<p>Age: $age</p>" .   "</br>".
                    "<p>Contact Number: $contactnumber</p>" .   "</br>".
                    "<p>Former Crew? : $relation</p>" .   "</br>".
                    "<p>Cadet? : $cadet</p>" .   "</br>".
                    "<p>Experience: $experience</p>" .   "</br>".
                    "<p>Previous Company: $previouscompany</p>" .   "</br>".
                    "</br>".
                    "<p> Login using portal to see complete details, <a href='https://www.virtuemaritime.com/virtueonline/'>Click here</a></p>".
                      $mail->AltBody = 'VirtueMaritime@2023';
                    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
                
                    if(!$mail->send()){
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    }else{
                            echo 1;
                     
                    }

                }
                else 
                {
                    echo "error1: ". mysqli_error($sqlcon); 
                }
            }
            
            else
            {
                echo "error2: ". mysqli_error($sqlcon); 
            }
        }
        else 
        {
            echo 3; 
        } 
}
else 
{
        echo 2; 
}
       










?> 
