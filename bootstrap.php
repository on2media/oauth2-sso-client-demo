<?php

// use this to toggle Client and ClientLite demos
$usingLite = false;

require __DIR__ . '/vendor/autoload.php';

session_name('oauth2-sso-client-demo');
session_start();

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$params = [
    'client_id' => getenv('OAUTH2_CLIENT_ID'),
    'client_secret' => getenv('OAUTH2_CLIENT_SECRET'),
    'authorize_url' => getenv('OAUTH2_URL_AUTHORIZE'),
    'access_token_url' => getenv('OAUTH2_URL_ACCESS_TOKEN'),
    'resource_owner_details_url' => getenv('OAUTH2_URL_RESOURCE_OWNER_DETAILS'),
    'sso_sign_in_url' => getenv('OAUTH2_URL_SSO_SIGN_IN'),
    'sso_sign_out_url' => getenv('OAUTH2_URL_SSO_SIGN_OUT'),
];

if (!$usingLite) {
    $params['sign_in_url'] = 'sign-in.php';
    $params['authenticate_url'] = 'authenticate.php';
    $client = new On2Media\OAuth2SSOClient\Client($params);
} else {
    $client = new On2Media\OAuth2SSOClient\ClientLite($params);
}
