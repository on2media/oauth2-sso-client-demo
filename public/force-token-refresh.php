<?php

require_once __DIR__ . '/../bootstrap.php';

$client->checkSignedIn();

$_SESSION['auth']['expires'] = 0;

header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
header('Location: ' . On2Media\OAuth2SSO\Client::getHomeUrl());
exit;
