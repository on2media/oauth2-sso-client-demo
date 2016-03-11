<?php

require_once __DIR__ . '/../bootstrap.php';

checkSignedIn($oAuth2Provider);

$_SESSION['auth']['expires'] = 0;

header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
header('Location: ' . getHomeUrl());
exit;
