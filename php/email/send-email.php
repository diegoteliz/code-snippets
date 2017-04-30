<?php 

$name   = $_POST[ 'name' ];
$email  = $_POST[ 'email' ];
$msg    = $_POST[ 'message' ];

// Additional info
/*$ip     = $_SERVER[ 'REMOTE_ADDR' ];
$info   = $_SERVER[ 'HTTP_USER_AGENT' ];
$site   = $_SERVER[ 'HTTP_REFERER' ];*/

if ( ( $email ) && ( $msg ) ) {
    
    $to      = 'aloha@diegoteliz.com';

    $subject = 'E-mail from diegoteliz.com';

    $message = '<strong>Name: </strong>'.$name.'<br />';
    $message.= '<strong>E-mail: </strong>'.$email.'<br />';
    $message.= '<strong>Message: </strong>'.$msg;
    
    $headers = 'From:'.$name.' <'.$email.'>'.'\r\n';
    $headers.= 'Reply-To:'.$name.' <'.$email.'>'.'\r\n';
    $headers.= 'Return-path:'.$name.' <'.$email.'>'.'\r\n';
    $headers.= 'Content-Type: text/html';
    

    mail( $to , $subject , $message , $headers );

    echo 1;

} else {
    echo 0;
}

?>