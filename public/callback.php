<?php

require_once __DIR__ . '/../bootstrap.php';

try {
    $client->handleCallback();
} catch (On2Media\OAuth2SSOClient\Exception $e) {
    echo 'Exception: ' . $e->getMessage();
    exit;
}

// here we'd check if we have a linked account amongst our users

$returnUrl = 'index.php';
if (isset($_SESSION['return_url'])) {
    $returnUrl = $_SESSION['return_url'];
    unset($_SESSION['return_url']);
}

header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
header('Location: ' . $returnUrl);
exit;
