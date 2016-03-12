<?php

require_once __DIR__ . '/../bootstrap.php';

if (!isset($_GET['success'])) {

    // it's the first time at this page, so check if the visitor is signed in at the provider

    header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
    header('Location: ' . On2Media\OAuth2SSO\Client::buildSignInUrl());
    exit;

} elseif ($_GET['success'] == 'true') {

    // we're signed in, so let's get a token

    $authorizationUrl = $oAuth2Provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $oAuth2Provider->getState();

    header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
    header('Location: ' . $authorizationUrl);
    exit;

}

if (!isset($_GET['welcome'])) {

    // if `welcome` isn't set then a sign in attempt has been made
    $client->getEventListener()->failedSignIn();

}

// redirect to the sign in form

header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
header('Location: ' . On2Media\OAuth2SSO\Client::getSignInUrl());
exit;
