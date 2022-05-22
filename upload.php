<?php
 require 'connection.php';


 include "PHPMailerAutoload.php";


define("sendmail_from","kidistsamuel21@gmail.com");
function sendmailx($from,$to,$subj,$msg,$att)
{
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "smtp.hostinger.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = username;
//Password to use for SMTP authentication
$mail->Password = password;
//Set who the message is to be sent from
$mail->setFrom($from, 'TASK MANAGER');
//Set an alternative reply-to address
$mail->addReplyTo($from, 'TASK MANAGER');
//Set who the message is to be sent to
$mail->addAddress($to, '');
//Set the subject line
$mail->Subject = $subj;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->AddAddress('$to', '');
                $mail->IsHTML(true);
                $mail->Body= $msg;
               
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    return "Mailer Error: " . $mail->ErrorInfo;
} else {
    return "Message sent!";
}
}

 if (isset($_POST['submit'])) {
 $pwd1 = md5($pwd1);

 $register = "INSERT INTO users (email, username, password) VALUES ('$email', '$username','$pwd1')";
 $query_result = mysqli_query($connect, $register);
 if($query_result) {
    
    $link = '<a href = "verify.php?email='.$email.'&hash='.$hash.'">Verify</a>';

    
    $rtn=sendmailx(username,$email,"Please Confirm your Email","Click On This Link to Verify Email ".$link,"");
               
    if($rtn=="Message sent!")
    {
       echo "Please Confirm you email,  we have sent you the confirmation link through". $email;
    }
    else
    {
        echo "your Registration done we will send the confirmation soon, Emailing Problem";
    }
     
    
 }
}
 else{
     die("unsucc".mysqli_error($connect));
 }


?>