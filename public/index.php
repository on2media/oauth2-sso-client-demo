<?php

require_once __DIR__ . '/../bootstrap.php';

checkSignedIn($oAuth2Provider);

?>

<a href="force-token-refresh.php">Refresh Token</a> | <a href="sign-out.php">Sign Out</a>

<p>
    Hello, <strong><?=htmlspecialchars($_SESSION['auth']['resource_owner']['name']);?></strong>
    with email address <strong><?=htmlspecialchars($_SESSION['auth']['resource_owner']['email']);?></strong>.
    You have successfully signed in with username <strong><?=htmlspecialchars($_SESSION['auth']['resource_owner']['id']);?></strong>
    to the <strong><?=htmlspecialchars($_SESSION['auth']['resource_owner']['your_client_id']);?></strong>
    client.
</p>

<p>
    Your access token is <strong><?=htmlspecialchars($_SESSION['auth']['access_token']);?></strong>
    which expires at <strong><?=date('Y-m-d H:i:s', $_SESSION['auth']['expires']);?></strong>.
    Your refresh token is <strong><?=htmlspecialchars($_SESSION['auth']['refresh_token']);?></strong>.
</p>
