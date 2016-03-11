<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes.php';

session_name('oauth2-sso-demo-client');
session_start();

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$oAuth2Provider = new \League\OAuth2\Client\Provider\GenericProvider(
    [
        'clientId'                => getenv('OAUTH2_CLIENT_ID'),
        'clientSecret'            => getenv('OAUTH2_CLIENT_SECRET'),
        'urlAuthorize'            => getenv('OAUTH2_URL_AUTHORIZE'),
        'urlAccessToken'          => getenv('OAUTH2_URL_ACCESS_TOKEN'),
        'urlResourceOwnerDetails' => getenv('OAUTH2_URL_RESOURCE_OWNER_DETAILS')
    ]
);
