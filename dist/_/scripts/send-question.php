<?php
    session_start();
    require("lib/PHPMailerAutoload.php");

    $redirect="Location: /support/faqs/#form-messages";
    $smtp_host="mail.smtp2go.com";
    $smtp_user="service@jaybe.co.uk";
    $smtp_pass="2#@&MH+3iq-sZoiAXQtN";
    $smtp_port=2525;
    $admin_name="Michelle Killey";
    $admin_email="service@jaybe.com";
    //$admin_name2="Sam Smith";
    //$admin_email2="sam@jaybe.com";

    if (isset($_POST['submit']) || isset($_POST['submit_x']) || $_SERVER['REQUEST_METHOD'] == "POST") {
       $_SESSION['name']     = $_POST['name'];
       $_SESSION['email']   = $_POST['email'];
       $_SESSION['question'] = $_POST['question'];

       $response = $_POST["g-recaptcha-response"];
       $secret = "6LetOWkUAAAAAFrYAWUR3wTIAfrs2VVuXmUrCnEg";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret'   => $secret,
            'response' => $response,
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $response = @json_decode($data);
        if ($response && $response->success)
        {
            // validation succeeded, user input is correct
        }
        else
        {
            $_SESSION['_error']="Error! Please check I'm not a robot!";
            header($redirect); exit;
        }



    $exploits = "/(content-type|bcc:|cc:|document.cookie|onclick|onload|javascript|alert)/i";
    $profanity = "/(beastial|bestial|blowjob|clit|cum|cunilingus|cunillingus|cunnilingus|cunt|ejaculate|fag|felatio|fellatio|fuk|fuks|fuck|fuck off|gangbang|gangbanged|gangbangs|hotsex|jism|jiz|kock|kondum|kum|kunilingus|orgasim|orgasims|orgasm|orgasms|phonesex|phuk|phuq|porn|pussies|pussy|spunk|xxx)/i";
    $spamwords = "/(viagra|phentermine|tramadol|adipex|advai|alprazolam|ambien|ambian|amoxicillin|antivert|blackjack|backgammon|texas|holdem|poker|carisoprodol|ciara|ciprofloxacin|debt|dating|porn)/i";
    $bots = "/(Indy|Blaiz|Java|libwww-perl|Python|OutfoxBot|User-Agent|PycURL|AlphaServer)/i";
    if (preg_match($bots, $_SERVER['HTTP_USER_AGENT'])) {
        $_SESSION['_error']="Error! known spam bots are not allowed.";
        header($redirect); exit;
    }
    foreach ($_POST as $key => $value) {
        $value = trim($value);
        if (empty($value)) {
            if ($key == "email" && $key == "name" && $key == "question"){
            $_SESSION['_error']="Error! please go back and complete the required fields.";
            header($redirect); exit;
            }
        } elseif (preg_match($exploits, $value)) {
        $_SESSION['_error']="Error! exploits/malicious scripting attributes aren't allowed.";
        header($redirect); exit;
        } elseif (preg_match($profanity, $value) || preg_match($spamwords, $value)) {
        $_SESSION['_error']="Error! please keep things clean, no naughty words.";
        header($redirect); exit;
        }
        $_POST[$key] = stripslashes(strip_tags($value));
    }

   $mail = new PHPMailer();
   $mail->IsSMTP();
   $mail->Mailer = "smtp";
   $mail->Host = $smtp_host;
   $mail->Port = $smtp_port;
   $mail->SMTPAuth = true;
   //$mail->SMTPSecure = 'tls';
   $mail->Username = $smtp_user;
   $mail->Password = $smtp_pass;
   $mail->From     = $admin_email;
   $mail->FromName = "{$_POST['name']}";
   $mail->AddAddress( $admin_email , $admin_name );
   //$mail->AddAddress( $admin_email2 , $admin_name2 );
   $mail->AddReplyTo("{$_POST['email']}", "{$_POST['name']}");
   $mail->WordWrap = 50;
   $mail->Subject  = "A question for the website FAQs section";

   $mail->isHTML(true);
   $message .= "Name: {$_POST['name']} <br />";
   $message .= "Email: {$_POST['email']} <br />";
   $message .= "Question: {$_POST['question']} <br /><br /><br />";
   $mail->Body = $message;
   $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
   if($mail->Send()) {

   unset($_SESSION['name']);
   unset($_SESSION['email']);
   unset($_SESSION['question']);

      $_SESSION['_success'] = "Success! Your question has been sent successfully.";
      header($redirect); exit;
   } else {
      $_SESSION['_error'] = "Error! message failed, please try again later.";
      header($redirect); exit;
   }
}
?>
