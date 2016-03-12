<?php

require_once __DIR__ . '/../bootstrap.php';

$client->checkSignedIn();
$client->handleForceRefreshToken();
