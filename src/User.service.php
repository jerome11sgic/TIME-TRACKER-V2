<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class UserService{

    public static function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public static function sendMailNotification($username,$useremail,$userpass,$url){
        //email function start
        // Load Composer's autoloader
        require 'phpmailer/vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);
        
                try {
                    //Server settings
                    //$mail->SMTPDebug = 1; // Enable verbose debug output
                    $mail->isSMTP(); // Set mailer to use SMTP
                    $mail->Host       = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                    $mail->SMTPAuth   = true; // Enable SMTP authentication
                    $mail->Username   = 'samuelgnanamhrm@gmail.com'; // SMTP username
                    $mail->Password   = 'SGIC123456'; // SMTP password
                    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                    $mail->Port       = 587; // TCP port to connect to
        
                    //Recipients
                    $mail->setFrom('samuelgnanamhrm@gmail.com', 'TIME TRACKER LOGIN INFORMATION');
                    $mail->addAddress($useremail, 'Sgic Time Tracker .com');
                    $Body = ' Dear ' . $username . ',</br>
                                <p> This is to inform you that SGIC TIME TRACKER SYSTEM login credentials information details  </p> </br>
                                Your Login Email ID : "' . $useremail . '"</br>
                                Your Login Password : "' . $userpass . '" </br>';
        
                    $Body .= '<p>Here is your web site login link : </br>';
                    $Body .= '<a href ="' . $url . '">' . $url . '</a></P></br>';
                    $Body .= '<p> After Login please change your password ... </P>';
                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'SGIC TIME TRACKER SYSTEM login credentials information details';
                    $mail->Body    = $Body;
                    $mail->AltBody = strip_tags($Body);
        
                    $mail->send();
                    //header("location:user.php?newuser_added=success");
                   return true;
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    return false;
                } //finshed email function
    }
}



?>