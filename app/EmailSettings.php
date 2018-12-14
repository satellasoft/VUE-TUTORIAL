<?php
require_once("../vendor/autoload.php");
//https://packagist.org/packages/phpmailer/phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define("HOST", "");
define("PORT", );
define("USER", "");
define("PASS", "");

function SendMessage(string $fullname, string $email, string $subject, string $message){

  $html = ReturnHTMLBody($fullname, $email, $subject, $message);

  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  try {
      //Server settings
      $mail->SMTPDebug = 0; // Enable verbose debug output
      $mail->CharSet = 'UTF-8';
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = HOST;  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = USER;                 // SMTP username
      $mail->Password = PASS;                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = PORT;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom($email, $fullname); //
      $mail->addAddress('vuemail@satellasoft.com', $subject);     // Add a recipient

       $mail->AddEmbeddedImage('../img/Logo_white.png', 'logoimg');
       $mail->AddEmbeddedImage('../img/twitter.png', 'twitter');
       $mail->AddEmbeddedImage('../img/youtube.png', 'youtube');
       $mail->AddEmbeddedImage('../img/facebook.png', 'facebook');
       $mail->AddEmbeddedImage('../img/instagram.png', 'instagram');

      //Content
      $mail->isHTML(true);// Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $html;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      return true;
  } catch (Exception $e) {
      echo 'ERROR: ', $mail->ErrorInfo;
      return false;
  }
}

function ReturnHTMLBody(string $fullname, string $email, string $subject, string $message){

  $dateTime = date("Y/m/d H:i:s");
  $ipAddress = $_SERVER["REMOTE_ADDR"];
  $browser = $_SERVER['HTTP_USER_AGENT'];

  $html = "<style>".
          "@import url('https://fonts.googleapis.com/css?family=Archivo');".
          "</style>".
          "<div style='background-color: #EEE; border:1px solid #03A9F4; border-radius:3px; max-width:700px; margin:0 auto; font-family: Archivo, sans-serif;'>".
            "<div style='background-color: #0288d1; text-align: center; border-bottom: 2px solid #03A9F4'>".
              "<a href='https://www.satellasoft.com/'>".
                "<img src='cid:logoimg' alt='Logo satellasoft' style='border: none; padding: 10px; max-width: 350px; width:100%;'>".
              "</a>".
            "</div>".
            "<div style='padding: 5px;'>".
                  "<h1 style='text-align: center; color: #212121; font-weight: 300'>Mail send by my website</h1>".
                  "<div style='border:1px solid #BDBDBD;'></div>".
                  "<p><span style='font-weight: bold;'>Full name: </span> {$fullname}</p>".
                  "<p><span style='font-weight: bold;'>Email: </span> {$email}</p>".
                  "<p><span style='font-weight: bold;'>Subject: </span> {$subject}</p>".
                  "<p><span style='font-weight: bold;'>Date time: </span> {$dateTime}</p>".
                  "<p><span style='font-weight: bold;'>IP Address: </span> {$ipAddress}</p>".
                  "<p><span style='font-weight: bold;'>Browser: </span> {$browser}</p>".
                  "<p><span style='font-weight: bold;'>Message: </span> {$message}</p>".
            "</div>".
            "<div style='background-color: #0288d1; text-align: center; border-top: 2px solid #888; color: #FFF'>".
              "<p>&copy; SatellaSoft 2018 - All Rights Reserved</p>".
              "<a style='padding:10px;' href='https://www.facebook.com/satellasoft/' style='padding:5px; text-decoration: none;'> <img src='cid:facebook' alt='Facebook' style='max-width: 32px; width: 100%;'> </a>".
              "<a style='padding:10px;' href='https://www.youtube.com/user/satellasoft1/' style='padding:5px; text-decoration: none;'> <img src='cid:youtube' alt='Youtube' style='max-width: 32px; width: 100%;'> </a>".
              "<a style='padding:10px;' href='https://www.instagram.com/satellasoft/' style='padding:5px; text-decoration: none;'><img src='cid:instagram' alt='Instagram' style='max-width: 32px; width: 100%;'></a>".
              "<a style='padding:10px;' href='https://twitter.com/satellasoft' style='padding:5px; text-decoration: none;'><img src='cid:twitter' alt='Twitter' style='max-width: 32px; width: 100%;;'></a>".
            "</div>".
          "</div>";
  return $html;
}
