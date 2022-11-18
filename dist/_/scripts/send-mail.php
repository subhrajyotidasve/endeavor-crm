<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/common/functions.php");
require($_SERVER["DOCUMENT_ROOT"] . "/common/create-email.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/_/scripts/lib/PHPMailerAutoload.php");
custom_session_start();

   $inputs = [];
   $redirect="Location: /support/contact/#form-messages";
    $exploits = "/(content-type|bcc:|cc:|document.cookie|onclick|onload|javascript|alert)/i";
    $profanity = "/(beastial|bestial|blowjob|clit|cum|cunilingus|cunillingus|cunnilingus|cunt|ejaculate|fag|felatio|fellatio|fuk|fuks|fuck|fuck off|gangbang|gangbanged|gangbangs|hotsex|jism|jiz|kock|kondum|kum|kunilingus|orgasim|orgasims|orgasm|orgasms|phonesex|phuk|phuq|porn|pussies|pussy|spunk|xxx)/i";
    $spamwords = "/(viagra|phentermine|tramadol|adipex|advai|alprazolam|ambien|ambian|amoxicillin|antivert|blackjack|backgammon|texas|holdem|poker|carisoprodol|ciara|ciprofloxacin|debt|dating|porn)/i";
    $bots = "/(Indy|Blaiz|Java|libwww-perl|Python|OutfoxBot|User-Agent|PycURL|AlphaServer)/i";


if (isset($_POST['submit']) || isset($_POST['submit_x']) || $_SERVER['REQUEST_METHOD'] == "POST") {
    if($_POST['enquiry_type'] == 'service') {

        $req = ['name','surname','email','tel', 'message', 'line1','town','postcode'];
    } else {

        $req = ['name','surname','email','message'];
    }
   $_SESSION['enquiry_type']    = filter_input(INPUT_POST, 'enquiry_type', FILTER_SANITIZE_STRING);
   $inputs['enquiry_type'] = $_SESSION['enquiry_type'];
   $_SESSION['tel']             = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
   $inputs['tel'] = $_SESSION['tel'];
   $_SESSION['email']           = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
   $inputs['email'] = $_SESSION['email'];
   $_SESSION['name']            = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
   $inputs['name'] = $_SESSION['name'];
   $_SESSION['surname']         = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
   $inputs['surname'] = $_SESSION['surname'];
   $_SESSION['message']         = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
   $inputs['message'] = $_SESSION['message'];
   $_SESSION['product_category'] = filter_input(INPUT_POST, 'product_category', FILTER_SANITIZE_STRING);
   $inputs['product_category'] = $_SESSION['product_category'];
   $_SESSION['product_type']    = filter_input(INPUT_POST, 'product_type', FILTER_SANITIZE_STRING);
   $inputs['product_type'] = $_SESSION['product_type'];
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

   $phpmailer->FromName = "{$_SESSION['name']}";
   $phpmailer->AddAddress( $admin_email , $admin_name );
   $phpmailer->AddReplyTo("{$_SESSION['email']}", "{$_SESSION['name']}");
   $phpmailer->WordWrap = 50;
   $phpmailer->Subject  = "Message from the website contact form";
   if(!empty($_FILES['myFirstFile']['name'])){
      $file1_name  = $_FILES['myFirstFile']['name'];
      $file1_size  = $_FILES['myFirstFile']['size'];
      $file1_tmp   = $_FILES['myFirstFile']['tmp_name'];
      $file1_type  = $_FILES['myFirstFile']['type'];
      $tmp = explode('.', $file1_name);
      $file1_ext=strtolower(end($tmp));
      $extensions= array("JPEG","jpg","png","pdf","docx","xlsx");
      if(in_array($file1_ext,$extensions)=== false){
        $_SESSION['_error'] = "File format not supported, please only attach jpg, png, pdf, docx or xlsx.";
        header($redirect); exit;
      }
      if($file1_size > 2097152) {
        $_SESSION['_error'] = "File size must not exceed 2mb.";
        header($redirect); exit;
      }
   $phpmailer->addAttachment($file1_tmp, $file1_name);
   }
   if(!empty($_FILES['mySecondFile']['name'])){
      $file2_name  = $_FILES['mySecondFile']['name'];
      $file2_size  = $_FILES['mySecondFile']['size'];
      $file2_tmp   = $_FILES['mySecondFile']['tmp_name'];
      $file2_type  = $_FILES['mySecondFile']['type'];
      $tmp = explode('.', $file2_name);
      $file2_ext=strtolower(end($tmp));
      $extensions= array("JPEG","jpg","png","pdf","docx","xlsx");
      if(in_array($file2_ext,$extensions)=== false){
        $_SESSION['_error'] = "File format not supported, please only attach jpg, png, pdf, docx or xlsx.";
        header($redirect); exit;
      }
      if($file2_size > 2097152) {
        $_SESSION['_error'] = "File size must not exceed 2mb.";
        header($redirect); exit;
      }
   $phpmailer->addAttachment($file2_tmp, $file2_name);
   }
   $phpmailer->isHTML(true);
   $message = "";
    if ($_SESSION['enquiry_type'] == 'general') {
        $message .= "Enquiry Type: General Enquiry <br />";
    }
    if ($_SESSION['enquiry_type'] == 'service') {
        $message .= "Enquiry Type: Customer Service Enquiry <br />";
    }
   $message .= "First Name: {$_SESSION['name']} <br />";
   $message .= "Surname: {$_SESSION['surname']} <br />";
   $message .= "Email: {$_SESSION['email']} <br />";
   $message .= $_SESSION['tel'] ? "Telephone: {$_SESSION['tel']} <br />" : "";
   $message .= $_SESSION['line1'] ? "Address: {$_SESSION['line1']} <br />" : "";
   $message .= $_SESSION['line2'] ? "{$_SESSION['line2']} <br />" : "";
   $message .= $_SESSION['line3'] ? "{$_SESSION['line3']} <br />" : "";
   $message .= $_SESSION['town'] ? "Town: {$_SESSION['town']} <br />" : "";
//    $message .= $_SESSION['county'] ? "County: {$_SESSION['county']} <br />" : "";
   $message .= $_SESSION['postcode'] ? "Postcode: {$_SESSION['postcode']} <br />" : "";
    if (!empty($_SESSION['product_category'])) {
        $message .= "Product Category: {$_SESSION['product_category']} <br />";
    }
    if (!empty($_SESSION['product_type'])) {
        $message .= "Product Type: {$_SESSION['product_type']} <br />";
    }
   $message .= "Message: {$_SESSION['message']} <br />";
   $phpmailer->Body = $message;
   $phpmailer->AltBody = "To view the message, please use an HTML compatible email viewer!";
   if($phpmailer->Send()) {

   unset($_SESSION['enquiry_type']);
   unset($_SESSION['message']);
   unset($_SESSION['product_category']);
   unset($_SESSION['product_type']);
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

      $_SESSION['_success'] = "Success! Your message has been sent successfully.";
      header($redirect); exit;
   } else {
      $_SESSION['_error'] = "Error! message failed, please try again later.";
      header($redirect); exit;
   }
}
?>
