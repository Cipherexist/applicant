<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

@$hiringid = $_POST['myhiring']; 
@$username = $_POST['myusername']; 



include "dbconfig.php"; 
include "modules.php"; 

@$regdate = loadregistrationdatetoday(); 
$sqlstage3 = "UPDATE `monitoring` SET `docssubmitted`='notified',`docsubmiteddate`='$regdate' Where `hiringid` Like '$hiringid' and `username` Like '$username' and `stage` Like '3'"; 
mysqli_query($sqlcon,$sqlstage3);

if(!mysqli_error($sqlcon))
{
    
  // $emailsent = "cipherexist@gmail.com"; 
   $emailsent = "virtuemaritime.online@gmail.com"; 
  
   @$completename = loadcompletename($username);
   require 'PHPMailer/src/Exception.php';
   require 'PHPMailer/src/PHPMailer.php';
   require 'PHPMailer/src/SMTP.php';
   @$smtpUsername = "info@virtuemaritime.com"; 
   @$smtpPassword = "Vir@00000"; 
   @$emailFrom = $smtpUsername; 
   @$emailFromName = "Documents are ready for [$completename]"; 
   @$emailTo = $emailsent; 
   @$emailToName = "Applicant"; 
   @$hrid = $hiringid; 

   
   $birthDate = loadtextreturn("applicantinfo","birthdate","Where username Like '$username'");
   @$contactnumber = loadtextreturn("applicantinfo","contactnumber","Where username Like '$username'");
   @$emailadd = $username; 
   //explode the date to get month, day and year
   $birthDate = explode("/", $birthDate);
   //get age from date or birthdate
   @$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
     ? ((date("Y") - $birthDate[2]) - 1)
     : (date("Y") - $birthDate[2]));

 
   @$hiringtitle = loadtextreturn("hiring","hiringtitle","Where `ID` Like '$hiringid'"); 


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
   $mail->Subject = "(NOTIFICATION) DOCUMENTS ARE READY" ;
   $mail->Body  =  "<h4> Applicant is successfully uploaded the documents via Online Application</h4>".
   "<p>Name: $completename</p>" . "</br>".
   "<p>Email: $emailadd</p>" .   "</br>".
   "<p>Contact Number: $contactnumber </p>" .   "</br>".
   "<p>Applying for: $hiringtitle</p>" .   "</br></br>". 
   "<p>Documents are for verification, kindly login to portal to check the documents</p>" .   "</br>". 
   "</br>".
   "<p> Login using portal to see complete details, <a href='https://www.virtuemaritime.com/virtueonline/'>Click here</a></p>".
     $mail->AltBody = 'VirtueMaritime@2023';
   // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

   if(!$mail->send()){
       echo "Mailer Error: " . $mail->ErrorInfo;
   }else{
    updatethemonitor($hiringid,"Documents Submitted"); 
    echo 1; 

   

   }




}
else 
{
    echo mysqli_error($sqlcon); 
}


?> 
