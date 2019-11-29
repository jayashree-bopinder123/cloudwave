<?php

include dirname(dirname(__FILE__)).'/mail.php';

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'email_validation.php';

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);
$phone = stripslashes($_POST['phone']);
$formmessage = stripslashes($_POST['message']);
$formpage = stripslashes($_POST['formpage']);

$subject = '[cloudwaveinc.com] - You have a message from <'.$name.'>';

$error = '';

// Check name

if(!$name)
{
$error .= 'Please enter your name.<br />';
}

// Check email

if(!$email)
{
$error .= 'Please enter an e-mail address.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Please enter a valid e-mail address.<br />';
}

// Check contact number (phone)

if(!$phone)
{
$error .= 'Please enter a contact number.<br />';
}

if($email && !ValidatePhone($phone))
{
$error .= 'Please enter a valid contact number.<br />';
}

// Check message (length)

if(!$formmessage  || strlen($formmessage ) < 10)
{
$error .= "Please enter your message. It should have at least 10 characters.<br />";
}


if(!$error)
{
	
$message = "<strong>Details of the Enquiry</strong><table cellspacing='5' cellpadding='5'><tr><td style='border: 1px solid black'>Name</td><td style='border: 1px solid black'>".$name."</td></tr><tr><td style='border: 1px solid black'>Email</td><td style='border: 1px solid black'>".$email."</td></tr><tr><td style='border: 1px solid black'>Contact Number</td><td style='border: 1px solid black'>".$phone."</td></tr><tr><td style='border: 1px solid black'>Message</td><td style='border: 1px solid black'>".$formmessage."</td></tr><tr><td style='border: 1px solid black'>Page Source</td><td style='border: 1px solid black'>".$formpage."</td></tr></table><p>Regards,<br />Webmaster, CloudwaveInc.com</p>";

/*
$mail = mail(CONTACT_FORM, $subject, $message,
     "From: ".$name." <".$email.">\r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion());
*/ 
$mail = mail(CONTACT_FORM, $subject, $message,
     "From: ".$name." <info@cloudwaveinc.com>"."\r\n"
    ."Reply-To: ".$email."\r\n"
	."Cc: <raj+web@cloudwaveinc.com>, <muruga+web@cloudwaveinc.com>, <mule+web@cloudwaveinc.com>, <ganesh+web@cloudwaveinc.com>, <sankar+web@cloudwaveinc.com>, <neeraja+web@cloudwaveinc.com>" . "\r\n"
    ."MIME-Version: 1.0" . "\r\n"
    ."Content-type: text/html; charset=iso-8859-1" . "\r\n"
    ."X-Mailer: PHP/" . phpversion());

if($mail)
{
echo 'OK';
}


}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>