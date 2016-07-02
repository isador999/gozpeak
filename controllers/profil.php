<?php

session_start();

require_once(CONTROLLERS.'init.php');
require_once(MODELS.'dbconnect.php');
require_once(MODELS.'profile_functions.php');
require_once(LIB.'display.php');
require_once(VIEWS.'styles.php');
require_once(MODALS.'modal-navbar.php');


$query = "gozpeak";

$pseudo = $_SESSION['profil'];
$infos = profile_info($DB, $pseudo);

//COUNT NUMBER OF EVENTS POSTED BY USER //
$nb_events = count_events ($DB, $pseudo);


$logged = check_logged();


if ($logged == 1) {
        require_once(VIEWS.'header-logged.php');
        echo "USER LOGGED !";
} else {
        require_once(VIEWS.'header-notlogged.php');
        echo "USER unlogged !";
}

if ($infos['premium'] == 0) {
	$infos['premium'] == 'Non';
} else {
	$infos['premium'] == 'Oui';
}

require_once(VIEWS.'profil.php');
require_once(VIEWS.'footer.php');
require_once(MODALS.'modal-profile.php');
require_once(VIEWS.'scripts.php');

?>

