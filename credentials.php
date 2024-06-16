<?php 

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function loaduseraccesstype($username)
{
    include 'dbconfig.php';
    $query = "Select * from `useracct` Where username Like '". $username. "'";
    $datame = mysqli_query($sqlcon, $query);
	
		if(mysqli_num_rows($datame)!=0)
		{
		  while($row = mysqli_fetch_assoc($datame)) 
		  {
		  $codecomplete = $row["accounttype"]; 
		  }
		}
		else
		{
		  $codecomplete = $query; 
		}
		
      return $codecomplete;
}


function emailsending($email)
{
	require 'PHPMailer/PHPMailerAutoload.php';

	@$randomstring = generateRandomString(5);

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
		require 'dbconfig.php';
		$updatesql = "UPDATE `useracct` set `verificationcode`='$randomstring' Where username Like '$email'";
		mysqli_query($sqlcon,$updatesql); 
		if(mysqli_error($sqlcon))
		{
			echo mysqli_error($sqlcon);
		}
	// echo 'Data has been saved';
	// echo '<script> window.location.replace("thankyoumessage.php")</script>'; 
	//echo "<p style='color: blue;'> Your Password Has Been Sent to Email </p>";
	}



}



include 'dbconfig.php';


if(isset($_POST['usname']) && isset($_POST['psname']))
 {
	 @$huan = str_replace("'",'',$_POST['usname']);
	 @$two = str_replace("'",'',$_POST['psname']);
	 
	 
$fetchqry  = "SELECT * FROM `useracct` WHERE username LIKE '$huan' AND password LIKE '$two'"; //SQL FORMAT FOR SEARCHING 

$result=mysqli_query($sqlcon,$fetchqry);

	if(!mysqli_error($sqlcon))
	{
		
		
		$numrows=mysqli_num_rows($result);
		if($numrows != 0) 
		{
			while ($rows = mysqli_fetch_assoc($result))
			{
				if($rows['verified']=='no'||$rows['verified']=='')
				{
					echo 2;
					//@$email = $_POST['usname'];
				//	@$email = "cipherexist@gmail.com";
				//emailsending($email); 

				
				}
				else 
				{
					$huan = $_POST['usname'];
					$two = $_POST['psname'];
					$myaccount = loaduseraccesstype($huan);
					$setlimit = 10000;
					$viewtype = "Deck Management Level";
					setcookie('usname', $huan, time()+$setlimit);
					setcookie('psword', $two, time()+$setlimit);
					setcookie('account',$myaccount , time()+$setlimit);
		
					setcookie('viewtype',$viewtype , time()+$setlimit);
		
					echo 1;
				
				}
			}
	
		}
		else 
		{ 
		 echo 'Login-details incorrect';
		} 
	}
	else 
	{
		//echo $fetchqry;
	echo 'Login-details incorrect';
	}
 }


?>
   
      