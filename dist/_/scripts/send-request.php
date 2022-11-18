<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/common/functions.php");
require($_SERVER["DOCUMENT_ROOT"] . "/common/create-email.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/_/scripts/lib/PHPMailerAutoload.php");
custom_session_start();
    $inputs = [];
    $req = ['name','surname','email','line1','town','postcode'];
    $exploits = "/(content-type|bcc:|cc:|document.cookie|onclick|onload|javascript|alert)/i";
    $profanity = "/(beastial|bestial|blowjob|clit|cum|cunilingus|cunillingus|cunnilingus|cunt|ejaculate|fag|felatio|fellatio|fuk|fuks|fuck|fuck off|gangbang|gangbanged|gangbangs|hotsex|jism|jiz|kock|kondum|kum|kunilingus|orgasim|orgasims|orgasm|orgasms|phonesex|phuk|phuq|porn|pussies|pussy|spunk|xxx)/i";
    $spamwords = "/(viagra|phentermine|tramadol|adipex|advai|alprazolam|ambien|ambian|amoxicillin|antivert|blackjack|backgammon|texas|holdem|poker|carisoprodol|ciara|ciprofloxacin|debt|dating|porn)/i";
    $bots = "/(Indy|Blaiz|Java|libwww-perl|Python|OutfoxBot|User-Agent|PycURL|AlphaServer)/i";

   $redirect="Location: /support/fabric-request/#form-messages";

if (isset($_POST['submit']) || isset($_POST['submit_x']) || $_SERVER['REQUEST_METHOD'] == "POST") {

   $_SESSION['tel']     = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
   $inputs['tel'] = $_SESSION['tel'];
   $_SESSION['email']   = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
   $inputs['email'] = $_SESSION['email'];
   $_SESSION['name']    = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
   $inputs['name'] = $_SESSION['name'];
   $_SESSION['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
   $inputs['surname'] = $_SESSION['surname'];
   $_SESSION['line1'] = filter_input(INPUT_POST, 'line1', FILTER_SANITIZE_STRING);
   $inputs['line1'] = $_SESSION['line1'];
   $_SESSION['line2'] = filter_input(INPUT_POST, 'line2', FILTER_SANITIZE_STRING);
   $inputs['line2'] = $_SESSION['line2'];
   $_SESSION['line3'] = filter_input(INPUT_POST, 'line3', FILTER_SANITIZE_STRING);
   $inputs['line3'] = $_SESSION['line3'];
   $_SESSION['town'] = filter_input(INPUT_POST, 'town', FILTER_SANITIZE_STRING);
   $inputs['town'] = $_SESSION['town'];
//    $_SESSION['county'] = filter_input(INPUT_POST, 'county', FILTER_SANITIZE_STRING);
//    $inputs['county'] = $_SESSION['county'];
   $_SESSION['postcode'] = filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_STRING);
   $inputs['postcode'] = $_SESSION['postcode'];
   $_SESSION['comments'] = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
   $inputs['comments'] = $_SESSION['comments'];

   $data = [
    'secret' => '6LetOWkUAAAAAFrYAWUR3wTIAfrs2VVuXmUrCnEg', 
    'response' => @$_POST['g-recaptcha-response']

];

$curl = curl_init();

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($curl);
$response = json_decode($response, true);
curl_close($curl);

if ($response['success'] === false) {

    $_SESSION['_error'] = "Error! Please check I'm not a robot!";
    header($redirect); exit;

}



if (preg_match($bots, $_SERVER['HTTP_USER_AGENT'])) {
    $_SESSION['_error']="Error! known spam bots are not allowed.";
    header($redirect); exit;
}

foreach ($inputs as $key => $value) {
    if (in_array($key, $req)){
        if(validateString($value)) {
            $_SESSION['_error'] = "Error! please go back and complete the required fields.";
            header($redirect); exit;
        }
    } elseif(preg_match($exploits, $value)) {
            $_SESSION['_error'] = "Error! exploits/malicious scripting attributes aren't allowed.";
            header($redirect); exit;

    } elseif (preg_match($profanity, $value) || preg_match($spamwords, $value)) {
                $_SESSION['_error'] = "Error! please keep things clean, no naughty words.";
                header($redirect); exit;

    }
}
   $phpmailer->From     = $_SESSION['email'];
   $phpmailer->FromName = $_SESSION['name'];
   $phpmailer->AddAddress( $admin_email , $admin_name );
   $phpmailer->AddReplyTo("{$_SESSION['email']}", "{$_SESSION['name']}");
   $phpmailer->WordWrap = 50;
   $phpmailer->Subject  = "Fabric Sample Request from the website";

   $message = "Name: {$_SESSION['name']} {$_SESSION['surname']} <br />";
   $message .= "Email: {$_SESSION['email']} <br />";
   $message .= "Telephone: {$_SESSION['tel']} <br />";
   $message .= "Address: {$_SESSION['line1']} <br />";
   $message .= $_SESSION['line2'] ? "{$_SESSION['line2']} <br />" : "";
   $message .= $_SESSION['line3'] ? "{$_SESSION['line3']} <br />" : "";
   $message .= "Town: {$_SESSION['town']} <br />";
//    $message .= $_SESSION['county'] ? "County: {$_SESSION['county']} <br />" : "";
   $message .= "Postcode: {$_SESSION['postcode']} <br />";
   $message .= "Message: {$_SESSION['comments']} <br />";
   $phpmailer->Body = $message;
   $phpmailer->AltBody = "To view the message, please use an HTML compatible email viewer!";
   if($phpmailer->Send()) {

   unset($_SESSION['tel']);
   unset($_SESSION['email']);
   unset($_SESSION['name']);
   unset($_SESSION['surname']);
   unset($_SESSION['line1']);
   unset($_SESSION['line2']);
   unset($_SESSION['line3']);
//    unset($_SESSION['county']);
   unset($_SESSION['town']);
   unset($_SESSION['postcode']);
   unset($_SESSION['comments']);

      $_SESSION['_success'] = "Success! Your sample request has been sent successfully.";
      header($redirect); exit;
   } else {
      $_SESSION['_error'] = "Error! message failed, please try again later.";
      header($redirect); exit;
   }
}
?>