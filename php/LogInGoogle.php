<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once getcwd().'/../vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('698240652723-bog5gj1a3vhivhp1b9j9r9p2t60l7dt5.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('KxJHMosFMwVnZSVmDr8k0mx5');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://swjontelletxea.000webhostapp.com/jonterola-SWG10/php/LogIn.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>