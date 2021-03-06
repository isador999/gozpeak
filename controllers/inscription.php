<?php

session_start();

// Inscription Validation before saving in database //
require_once('./language.php');
require_once('./lib/sessions_init.php');
require_once('./lib/check_strings.php');
require_once('./lib/mailgun.php');
require_once('../models/dbconnect.php');
require_once('../models/inscription_functions.php');

$page = isset($_GET['page']) ? $_GET['page'] : '';

if($_POST) {
	$pseudo 				= isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
	$mail 					= isset($_POST['mail']) ? $_POST['mail'] : '';
	$mail_check 		= isset($_POST['mail_check']) ? $_POST['mail_check'] : '';
	$password 			= isset($_POST['password']) ? $_POST['password'] : '';
	$password_check = isset($_POST['password_check']) ? $_POST['password_check'] : '';


	if((trim($pseudo) == '') OR (trim($mail) == '')) {
		//echo "NOK: rule1";
		$error="empty_fields";
	}
	else if(empty($password) OR empty($password_check))
	{
		//echo "NOK: rule1";
		$error="empty_fields";
	}
	elseif((strlen($mail) < 10) OR (!isEmail($mail)))
	{
	  // (old function) CKMail ($_POST['email']);
	  //echo "NOK: rule2";
	  $error="invalid_email";
	}
	else if(!isEmail($mail)) {
		//echo "NOK: rule2";
		$error="invalid_email";
	}


	/*************** Other checks ***************/

	/***** Count pseudo, count mail in DB *****/
	$nbre_pseudo = pseudo_exist($DB, $pseudo);
	$nbre_mail = mail_exist($DB, $mail);

	/***** If pseudo or mail is not 0, so one of them exists already *****/
	if($nbre_pseudo > 0)
	{
	  //echo "NOK: rule3";
	  $error="pseudo_already_exists";
	}
	elseif($nbre_mail > 0)
	{
	  //echo "NOK: rule4";
	  $error="email_already_exists";
	}
   	elseif ($mail != $mail_check)
	{
	  //echo "NOK: rule5";
	  $error="emails_not_matching";
	}


	/***** If previous rules are OK, check password rules *****/
	elseif (strlen($password) > 25 || strlen($password) < 8)
	{
	  //echo "NOK: rule6";
	  $error="bad_length_pass";
	}
	elseif (ctype_alnum($password)) {
	  //echo "NOK: rule7 - specialchars";
		$error="notcompliant_password";
	}
	elseif (!preg_match("/.*[0-9].*[0-9].*+/", $password) || !preg_match("/.*[A-Z].*+/", $password))  {
	  //echo "NOK: rule7 - numbers and CAPS";
		$error="notcompliant_password";
	}
	elseif ($password != $password_check)
	{
	  //echo "NOK: rule8";
	  $error="passwords_not_matching";
	}

	else {
   		/***** 'htmlentities function permit to esacpe/protect fields against attacks, like XSS *****/
    $pseudo = htmlspecialchars(trim($pseudo));
    $mail = htmlspecialchars(trim($mail));
    $password = htmlspecialchars(trim($password));

		/***** Generate Activation Key *****/
		$key = md5(microtime(TRUE)*100000);
		#$password = hash(sha1, $password);
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		/***** Registering... *****/
		$d = array("$pseudo", "$mail", $hashed_password, "$key");
		add_member($DB, $d);

		/****** Check if register processed correctly ******/
		$nb_pseudo = pseudo_exist($DB, $pseudo);
		if($nb_pseudo > 0) {
			#echo "OK";

			/***** URLENCODE TO CHANGE SPECIAL CHARS TO CODE *****/
			$pseudo = urlencode($pseudo);
	    $key = urlencode($key);

			$mail_subject="Confirmation de votre inscription Gozpeak";
			$mail_content = '<html><body>';
			$mail_content .= '<h4>'."Bonjour $pseudo ! ".'</h4>'.'<br>'.'<br>';
			$mail_content .= "Merci de votre inscription sur Gozpeak :) ".'<br>';
			$mail_content .= "Afin de rendre votre compte actif, cliquez sur le lien suivant (valable pendant 72h)".'<br>';
			$mail_content .= "$gozpeak_protocol"."$gozpeak_host"."/index.php?page=activation&login=$pseudo&key=$key".'<br>'.'<br>';
			$mail_content .= "A très bientôt pour de nombreuses activités !".'<br>'.'<br>';
			$mail_content .= "Linguistiquement,".'<br>'.'<br>';
			$mail_content .= "L'équipe Gozpeak".'<br>';
			$mail_content .= '<img src="'."$gozpeak_protocol"."$gozpeak_host".'/views/images/gozpeak_small.png" alt="Gozpeak Logo">'.'<br>';
			$mail_content .= '</body> </html>';
	    if(send_by_mailgun($mail, "$mail_subject", "$mail_content")) {
				$message='<div class="form-group"> <div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert">&times;</a>Merci pour votre inscription sur Gozpeak ! Un email de confirmation vient de vous être envoyé ;) </div> </div>';

				/******** Send Mail to Gozpeak Team ********/
				$team_mail_content = '<html><body>';
        $team_mail_content .= '<h4>'."Un nouveau membre inscrit sur Gozpeak ! ".'</h4>'.'<br>'.'<br>';
        $team_mail_content .= "Son pseudo : $pseudo".'<br>';
        $team_mail_content .= "Son adresse e-mail : $pseudo".'<br>';
        $team_mail_content .= "Cette personne devra activer son compte pour se connecter et s'inscrire aux activités".'<br>';
				send_by_mailgun('info@gozpeak.com', 'Nouvelle inscription [demo.gozpeak.com]', "$team_mail_content");
			} else {
				#$message = my_echo("3", "red", "'Désolé, une erreur est survenue lors de votre inscription'.'<br>'.'Veuillez réessayer ultérieurement'");
				$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>  Désolé, une erreur est survenue lors de votre inscription.   Veuillez réessayer ultérieurement </div> </div>';
			}

		/***** If register has not processed correctly *****/
		}
		else
		{
			echo "NOK";
			$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> Désolé, une erreur est survenue pendant l\'inscription. Veuillez réessayer plus tard. </div> </div>';
		}
  }
}



if (isset($error)) {
  if ($error == 'empty_fields') {
		$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> Veuillez remplir les champs obligatoires pour votre inscription </div> </div>';
  } elseif ($error == 'pseudo_already_exists') {
		$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> Désolé, le pseudo que vous avez choisi existe deja </div> </div>';
  } elseif ($error == 'email_already_exists') {
		$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> L\'email que vous avez entré existe déjà </div> </div>';
  } elseif ($error == 'bad_length_pass') {
		$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> Le mot de passe doit etre compris entre 8 et 25 caracteres </div> </div>';
  } elseif ($error == 'notcompliant_password') {
		$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> Le mot de passe choisi ne respecte pas la politique de sécurité, il doit contenir au minimum 2 chiffres, une majuscule et un caractère spécial. </div> </div>';
  } elseif ($error == 'passwords_not_matching') {
		$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> Les mots de passe ne correspondent pas </div> </div>';
  } elseif ($error == 'invalid_email') {
		$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> L\'adresse email est invalide </div> </div>';
  } elseif ($error == 'emails_not_matching') {
		$message='<div class="form-group"> <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a> Les adresses email ne correspondent pas </div> </div>';
  }
}


/******** Finally, set Global var if $message isset, and simply redirect to HOME *********/
if (isset($message)) {
	$_SESSION['msg'] = $message;
}

redirect_to_page($baseUrl, $page);

?>
