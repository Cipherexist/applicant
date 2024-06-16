<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$getemail = $_POST['myemail'];
emailactivation($getemail);



function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function emailactivation($myemailactivation)
{   
    $emailsent = $myemailactivation; 
	@$randomstring = generateRandomString(5);


    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    @$smtpUsername = "info@virtuemaritime.com"; 
    @$smtpPassword = "Vir@00000"; 
    @$emailFrom = $smtpUsername; 
    @$emailFromName = "Activate Online - Virtue Maritime"; 
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
    $mail->addAddress($emailTo, $emailToName);
    $mail->Subject = "(NO REPLY) NEW ONE TIME PASSWORD" ;
    $mail->Body  =  "<h4> Hello, Thank you for Registering in online Virtue Maritime</h4>
    <p> Your One time password is: <b> $randomstring </b></p>" . 
    "</br><p> return to website and type this One time password</p>".
      $mail->AltBody = 'VirtueMaritime@2023';
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

    if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
       
        require 'dbconfig.php';
		$updatesql = "UPDATE `useracct` set `verificationcode`='$randomstring' Where username Like '$emailsent'";
		mysqli_query($sqlcon,$updatesql); 
		if(mysqli_error($sqlcon))
		{
			echo mysqli_error($sqlcon);
		}
        else 
        {
           
        }

    }

}


?>