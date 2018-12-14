<?php
  require_once("EmailSettings.php");

  $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);
  $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);

  if(ValidateForm($name, $email, $subject, $message)){
    if(SendMessage($name, $email, $subject, $message)){
      echo "send";
    }else{
      echo "notsent";
    }
  }else{
    echo "invalid";
  }

function ValidateForm(string $fullname, string $email, string $subject, string $message){
  $errorCount = 0;

  if(strlen($fullname) <= 4){
    $errorCount++;
  }

  if(strpos($email, "@") <= 0){
    $errorCount++;
  }

  if(strlen($subject) < 3){
    $errorCount++;
  }

  if(strlen($message) < 10){
    $errorCount++;
  }

  if($errorCount === 0 ){
    return true;
  }else{
    return false;
  }
}
