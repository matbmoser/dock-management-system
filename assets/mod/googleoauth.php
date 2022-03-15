<?php

define('BASE_URL', 'http://localhost/proyecto-IS2/');
// Social redirect URL
define('SOCIAL_REDIRECT_URL', 'http://localhost/proyecto-IS2/login/');
// Google
define('GOOGLE_API_KEY', 'AIzaSyAd-NdMnF5XA0cZm8l-qcg-WLy4hEbOZvU');

// Google API configuration
define('GP_CLIENT_ID', '315627951756-kn3c3r2ov986orc7ghf721vi350ir1ob.apps.googleusercontent.com');
define('GP_CLIENT_SECRET', '3NyTtRNAzAmASer8UHP1K_-1');
/*
* Google OAuth
*/
// Include Google client library
require_once 'google-php-client/Google_Client.php';
require_once 'google-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('UFVeats');
$gClient->setClientId(GP_CLIENT_ID);
$gClient->setClientSecret(GP_CLIENT_SECRET);
$gClient->setRedirectUri(SOCIAL_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);

if (isset($_GET['code'])) {
    $gClient->authenticate($_GET['code']);
    $_SESSION['google_access_token'] = $gClient->getAccessToken();
    header('Location: ');
    exit;
}

if (isset($_SESSION['google_access_token'])) {
    $gClient->setAccessToken($_SESSION['google_access_token']);
}

if ($gClient->getAccessToken() && !isset($_GET['logoutSubmit'])) {
// Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();


// Initialize User class
    $usuario = new Usuario();
// Getting user profile info
    $gpUserData = array();
    $gpUserData['oauth_uid'] = !empty($gpUserProfile['id']) ? $gpUserProfile['id'] : '';
    $gpUserData['user_name'] = !empty($gpUserProfile['user_name']) ? $gpUserProfile['user_name'] : '';
    $gpUserData['first_name'] = !empty($gpUserProfile['given_name']) ? $gpUserProfile['given_name'] : '';
    $gpUserData['last_name'] = !empty($gpUserProfile['family_name']) ? $gpUserProfile['family_name'] : '';
    $gpUserData['email'] = !empty($gpUserProfile['email']) ? $gpUserProfile['email'] : '';

    // Insert or update user data to the database
    $gpUserData['oauth_provider'] = 'google';
    $userData = $usuario->checkUser($gpUserData);

    $token = hash('sha256', "email" . $gpUserData['oauth_uid']);
// Redirect to my account
    header("Location: usuario/index.php?id=" . $gpUserData['user_name'] . "&token=" . $token);
    exit();
} else {
    $gpLoginURL = $gClient->createAuthUrl();
    $gpLoginURL = filter_var($gpLoginURL, FILTER_SANITIZE_URL);
}

