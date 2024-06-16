<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$getemail = $_POST['theemail'];
emailforgot($getemail);

function oldpassword($ssemail)
{
    include 'dbconfig.php'; 
    @$theemail = $ssemail; 
    @$mypassword = ""; 

    $mysql = "Select * from `useracct` Where `username` Like '$theemail'"; 
    
    $dbt = mysqli_query($sqlcon,$mysql); 

    if(!mysqli_error($sqlcon))
    {
        while($rows = mysqli_fetch_assoc($dbt))
        {

            $mypassword = $rows['password']; 
            return $mypassword; 

        }
    }
    else
    {
        echo mysqli_error($sqlcon); 

    }





}



function emailforgot($myemailactivation)
{   
    $emailsent = $myemailactivation; 
	

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    @$smtpUsername = "info@virtuemaritime.com"; 
    @$smtpPassword = "Vir@00000"; 
    @$emailFrom = $smtpUsername; 
    @$emailFromName = "FORGOT PASSWORD - Virtue Maritime"; 
    @$emailTo = $emailsent; 
    @$emailToName = "Applicant"; 


    $mail = new PHPMailer;
    $mail->isSMTP(); 
   // $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "mail.virtuemaritime.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 465; // TLS only
    $mail->SMTPSecure = 'ssl'; // ssl is depracated
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
    $mail->setFrom($emailFrom, $emailFromName);
    $mail->addAddress($emailTo, $emailToName);
    @$password = oldpassword($emailsent); 
    $mail->Subject = "(NO REPLY) YOUR OLD PASSWORD - VIRTUE MARITIME" ;
    $mail->Body  =  "<h4> Hello, Thank you for Using our online Virtue Maritime Application</h4>
    <p> Your Old password is: <b> $password </b></p>" . 
    "</br><p> After login kindly change your password, Thank You</p>".
      $mail->AltBody = 'VirtueMaritime@2023';
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

    if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
        echo ""; 
        echo "<p class='text-success' id='resultforgot' name='resultforgot'>Your Old Password is Sent in your Email!</p>";
    }

}


?>