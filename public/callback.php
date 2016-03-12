<?php

require_once __DIR__ . '/../bootstrap.php';

try {
    $client->handleCallback();
} catch (On2Media\OAuth2SSO\Exception $e) {
    echo 'Exception: ' . $e->getMessage();
    exit;
}

// here we'd check if we have a linked account amongst our users

header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
header('Location: index.php');
exit;
