<?php

if(!$_POST) exit;

// Email verification, do not edit.
function isEmail($email_contact ) {
	return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_contact ));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

$name_contact     = $_POST['name_contact'];
$lastname_contact    = $_POST['lastname_contact'];
$email_contact    = $_POST['email_contact'];
$phone_contact   = $_POST['phone_contact'];
$message_contact = $_POST['message_contact'];
$verify_contact   = $_POST['verify_contact'];

if(trim($name_contact) == '') {
	echo '<div class="error_message">Введите Ваше имя.</div>';
	exit();
} else if(trim($lastname_contact ) == '') {
	echo '<div class="error_message">Введите Вашу фамилию.</div>';
	exit();
} else if(trim($email_contact) == '') {
	echo '<div class="error_message">Пожалуйста, введите действительный адрес электронной почты.</div>';
	exit();
} else if(!isEmail($email_contact)) {
	echo '<div class="error_message">Вы ввели неверный адрес электронной почты, повторите попытку.</div>';
	exit();
	} else if(trim($phone_contact) == '') {
	echo '<div class="error_message">Пожалуйста, введите действующий телефонный номер.</div>';
	exit();
} else if(!is_numeric($phone_contact)) {
	echo '<div class="error_message">Номер телефона может содержать только номера.</div>';
	exit();
} else if(trim($message_contact) == '') {
	echo '<div class="error_message">Введите ваше сообщение.</div>';
	exit();
} else if(!isset($verify_contact) || trim($verify_contact) == '') {
	echo '<div class="error_message"> Введите контрольный номер.</div>';
	exit();
} else if(trim($verify_contact) != '4') {
	echo '<div class="error_message">Неверный введенный номер проверки.</div>';
	exit();
}

if(get_magic_quotes_gpc()) {
	$message_contact = stripslashes($message_contact);
}


//$address = "HERE your email address";
$address = "Montblanc.tours.minsk@gmail.com";


// Below the subject of the email
$e_subject = 'С вами связались ' . $name_contact . '.';

// You can change this if you feel that you need to.
$e_body = "С вами связались $name_contact $lastname_contact с дополнительным сообщением, выглядит следующим образом." . PHP_EOL . PHP_EOL;
$e_content = "\"$message_contact\"" . PHP_EOL . PHP_EOL;
$e_reply = "Вы можете связаться $lastname_contact $name_contact по электронной почте, $email_contact либо по телефону $phone_contact";

$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

$headers = "From: $email_contact" . PHP_EOL;
$headers .= "Reply-To: $email_contact" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

$user = "$email_contact";
$usersubject = "Спасибо";
$userheaders = "From: infoMontblanc.tours.minsk@gmail.com\n";
$usermessage = "Благодарим вас за контакт. Мы свяжемся с Вами в ближайшее время. С уважением, Команда Montblanc Tours.";
mail($user,$usersubject,$usermessage,$userheaders);

if(mail($address, $e_subject, $msg, $headers)) {

	// Success message
	echo "<div id='success_page' style='padding:25px 0'>";
	echo "<strong >Письмо отправлено.</strong><br>";
	echo "Спасибо <strong>$name_contact</strong>,<br> Ваше сообщение отправленно, мы свяжемся с Вами в ближайшее время.";
	echo "</div>";

} else {

	echo 'ERROR!';

}
