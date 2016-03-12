<?php

require_once __DIR__ . '/../bootstrap.php';

if (empty($_GET['state']) || $_GET['state'] !== On2Media\OAuth2SSO\LocalStorage::getOAuth2State()) {
    On2Media\OAuth2SSO\LocalStorage::unsetOAuth2State();
    exit('Invalid or missing state');
}

On2Media\OAuth2SSO\LocalStorage::unsetOAuth2State();

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

    On2Media\OAuth2SSO\LocalStorage::setAuth(
        new On2Media\OAuth2SSO\Authorisation(
            $accessToken->getToken(),
            $accessToken->getRefreshToken(),
            $accessToken->getExpires(),
            $resourceOwner->toArray()
        )
    );

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
