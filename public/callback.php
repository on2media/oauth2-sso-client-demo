<?php

require_once __DIR__ . '/../bootstrap.php';

if (empty($_GET['state']) ||
    !isset($_SESSION['oauth2state']) ||
    $_GET['state'] !== $_SESSION['oauth2state']
) {
    unset($_SESSION['oauth2state']);
    exit('Invalid or missing state');
}

unset($_SESSION['oauth2state']);

if (isset($_GET['error'])) {
    echo $_GET['error'] . ': ' . $_GET['error_description'];
    exit('Unexpected errors');
}

if (!isset($_GET['code'])) {
    exit('No authorisation code');
}

try {

    $accessToken = $oAuth2Provider->getAccessToken(
        'authorization_code',
        [
            'code' => $_GET['code'],
        ]
    );

    $resourceOwner = $oAuth2Provider->getResourceOwner($accessToken);

    $_SESSION['auth'] = [
        'access_token' => $accessToken->getToken(),
        'refresh_token' => $accessToken->getRefreshToken(),
        'expires' => $accessToken->getExpires(),
        'resource_owner' => $resourceOwner->toArray(),
    ];

    // here we'd check if we have a linked account amongst our users

    header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
    header('Location: ' . On2Media\OAuth2SSO\Client::getHomeUrl());
    exit;

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

    $client->getEventListener()->failedSignIn();

    header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
    header('Location: ' . On2Media\OAuth2SSO\Client::getSignInUrl());
    exit;

}
