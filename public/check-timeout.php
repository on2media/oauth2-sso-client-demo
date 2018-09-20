<?php

require_once __DIR__ . '/../bootstrap.php';

header('Content-Type: application/json');

if (!$client->isSignedIn(null, true)) {

    echo json_encode(
        [
            'signed_in' => false,
        ]
    );
    exit;

}

echo json_encode(
    [
        'signed_in' => true,
        'timeout_due_at' => $_SESSION['auth']->getResourceOwner()['timeout']['due_at'],
    ]
);
