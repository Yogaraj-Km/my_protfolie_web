<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$receiving_email_address = 'yogaraj872@gmail.com';

if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
} else {
    die( 'Unable to load the "PHP Email Form" Library!');
}

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contact = new PHP_Email_Form;
    $contact->ajax = true;
    
    $contact->to = $receiving_email_address;
    $contact->from_name = $_POST['name'];
    $contact->from_email = $_POST['email'];
    $contact->subject = $_POST['subject'];

    $contact->smtp = array(
        'host' => 'smtp.gmail.com',
        'username' => 'yogaraj872@gmail.com',
        'password' => 'mjxo swdk yidd mhqr',
        'port' => '587',
        'encryption' => 'tls'
    );

    $contact->add_message($_POST['name'], 'From');
    $contact->add_message($_POST['email'], 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    echo $contact->send();
} else {
    // Not a POST request, return 405 error
    header("HTTP/1.1 405 Method Not Allowed");
    exit;
}
?>