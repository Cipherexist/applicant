<?php 
require 'oldmailer/PHPMailerAutoload.php';
$email = "cipherexist@gmail.com"; 


spl_autoload_register("__autoload"); 

@$randomstring = "2222222";

/*
$mail = new PHPMailer;// Set mailer to use SMTP
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtpout.secureserver.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'donotreply@virtuemaritime.com.ph';                 // SMTP username
$mail->Password = 'Vir@00000';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;    
*/ 

$mail = new PHPMailer;
// Set mailer to use SMTP
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'shu17.unified-servers.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@icebergmaritimesolutions.com';                 // SMTP username
$mail->Password = 'jayvee@2442814';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;    


$mail->setFrom('info@icebergmaritimesolutions.com', 'Activate Online - Virtue Maritime');
$mail->addAddress($email);     // Add a recipient 
//  $mail->addAddress('mmvalerio@navigatormaritime.com');  
// $mail->addAddress('mis@navigatormaritime.com');  
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = "(NO REPLY) NEW ONE TIME PASSWORD" ;
$mail->Body    =  "<h4> Hello, Thank you for Registering in online Virtue Maritime</h4>
  <p> Your One time password is: <b> $randomstring </b></p>" . 
  "</br><p> return to website and type this One time password</p>".
    $mail->AltBody = 'VirtueMaritime@2023';

if(!$mail->send()) 
{
// echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo . " Email: ".$email;

} 
else 
{
    /*
    require 'dbconfig.php';
    $updatesql = "UPDATE `useracct` set `verificationcode`='$randomstring' Where username Like '$email'";
    mysqli_query($sqlcon,$updatesql); 
    if(mysqli_error($sqlcon))
    {
        echo mysqli_error($sqlcon);
    }
    */ 
// echo 'Data has been saved';
// echo '<script> window.location.replace("thankyoumessage.php")</script>'; 
//echo "<p style='color: blue;'> Your Password Has Been Sent to Email </p>";
}



?> 

