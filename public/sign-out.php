<?php

require_once __DIR__ . '/../bootstrap.php';

unset($_SESSION['auth']);
$_SESSION['just_signed_out'] = true;

header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
header('Location: ' . buildSignOutUrl());
exit;
