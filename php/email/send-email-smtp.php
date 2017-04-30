<?

include('includes/class.phpmailer.php'); 
include('includes/class.smtp.php'); 

if ( ( isset( $_POST[ 'name' ] ) ) && ( isset( $_POST[ 'mail' ] ) ) && ( isset( $_POST[ 'message' ] ) ) ) {
    
    $name           = $_POST[ 'name' ];
    $mail           = $_POST[ 'mail' ];
    $phone          = $_POST[ 'phone' ];
    $message_box    = $_POST[ 'message' ];

    $plain_message  = '
        Lorem ipsum dolor sit amet\n\n
        Name: '.$name.'\n
        E-mail: '.$mail.'\n
        Phone: '.$phone.'\n
        Message: \n\n
        '.$message_box.'
        ';

    $html_message   = '
        <b>Lorem ipsum dolor sit amet</b><br />
        <b>Name:</b> '.$name.'<br />
        <b>E-mail:</b> '.$mail.'<br />
        <b>Phone:</b> '.$phone.'<br />
        <b>Message:</b><br />
        '.$message_box.'
        ';

    $mail = new PHPMailer(); 

    $mail->IsSMTP(); 
    $mail->SMTPAuth     = true; 
    $mail->SMTPSecure   = 'tls'; 
    $mail->Host         = 'mail.diegoteliz.com'; 
    $mail->Port         = 587; 
    $mail->Username     = 'no-reply@diegoteliz.com'; 
    $mail->Password     = 'password';
    $mail->From         = 'no-reply@diegoteliz.com';
    $mail->CharSet      = 'UTF-8'; 
    $mail->FromName     = 'Diego Teliz website'; 
    $mail->Subject      = 'Email from diegoteliz.com'; 
    $mail->AltBody      = $plain_message; 
    $mail->MsgHTML( $html_message ); 
    $mail->AddAddress( 'aloha@diegoteliz.com' , 'Diego Teliz' ); 
    $mail->IsHTML( true );
    $mail->SMTPDebug    = 1;

    if(!$mail->Send()) { 
        header( 'location:mail.php?state=2' );
    } else { 
        header( 'location:mail.php?state=1' );
    }

}