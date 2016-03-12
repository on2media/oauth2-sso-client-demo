<?php

require_once __DIR__ . '/../bootstrap.php';

unset($_SESSION['auth']);
$client->getEventListener()->signedOut();

header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
header('Location: ' . On2Media\OAuth2SSO\Client::buildSignOutUrl());
exit;
