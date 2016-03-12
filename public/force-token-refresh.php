<?php

require_once __DIR__ . '/../bootstrap.php';

$client->checkSignedIn();

On2Media\OAuth2SSO\LocalStorage::getAuth()->setExpires(0);

header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
header('Location: ' . On2Media\OAuth2SSO\Client::getHomeUrl());
exit;
