<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'dbconfig.php'; 
include 'loadtables.php';
include 'loadmodules.php'; 


@$username = $_POST['myusername']; 
@$remarks = $_POST['myremarks']; 
@$hiringid = $_POST['myhiring']; 

$sqlme = "UPDATE `monitoring` SET `docremarks`='$remarks',`docssubmitted`= NULL,`overallstatus`='Resubmit Documents' Where `hiringid` Like '$hiringid' and `username` Like '$username' and `stage` Like '3'"; 
mysqli_query($sqlcon,$sqlme);

if(!mysqli_error($sqlcon))
{
    @$dateinsert = loadregistrationdatetoday(); 
    @$globaluser = $_COOKIE['usname']; 
    updateoverallstatus($username,$hiringid,"Resubmit Documents"); 
    $sqlinsert = "INSERT INTO `remarks` (`remarks`,`globalusername`,`datesave`,`username`,`hiringid`) VALUES ('$remarks','$globaluser','$dateinsert','$username','$hiringid')";

    mysqli_query($sqlcon,$sqlinsert); 

    if(!mysqli_error($sqlcon))
    {

        $emailsent = $username; 
    
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        @$smtpUsername = "info@virtuemaritime.com"; 
        @$smtpPassword = "Vir@00000"; 
        @$emailFrom = $smtpUsername; 
        @$emailFromName = "Virtue Maritime - Application Status"; 
        @$emailTo = $emailsent; 
        @$emailToName = "Applicant"; 
    
        @$completehiringname = loadhiringname($hiringid); 

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
        $mail->Subject = "(NO REPLY) REMARKS ON YOUR DOCUMENTS" ;
        $mail->Body  =  "<h4> Kindly rectify the following</h4>". "</br></br>". 
        "<p><b>Applying for:</b> $completehiringname</p>". "</br></br>".
        "<p><b>Remarks: </b>$remarks</p>" . "</br></br>". 
        "<p>Remarks by: $globaluser</p>".
        "</br>".
        "<p> Login to check your application, <a href='https://www.virtuemaritime.com/applicant/'>Click here</a></p>".
          $mail->AltBody = 'VirtueMaritime@2023';
        // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    
        if(!$mail->send()){
            echo "Mailer Error: " . $mail->ErrorInfo;
        }else{

            echo loadremarkslist($username,$hiringid); 
        }
       
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }

   
}
else 
{
  echo mysqli_error($sqlcon); 
}






?>

