<?php

require_once __DIR__ . '/../bootstrap.php';

if ($usingLite) {
    exit('Not available');
}

$client->handleAuthenticate();
