<?php

require_once __DIR__ . '/../bootstrap.php';

$client->checkSignedIn();

?>

<a href="page2.php">Page 2</a> |
<a href="force-token-refresh.php">Refresh Token</a> |
<a href="sign-out.php">Sign Out</a>

<p>
    Hello, <strong><?=htmlspecialchars($_SESSION['auth']->getResourceOwner()['name']);?></strong>
    with email address <strong><?=htmlspecialchars($_SESSION['auth']->getResourceOwner()['email']);?></strong>.
    You have successfully signed in with username <strong><?=htmlspecialchars($_SESSION['auth']->getResourceOwner()['id']);?></strong>
    to the <strong><?=htmlspecialchars($_SESSION['auth']->getResourceOwner()['your_client_id']);?></strong>
    client.
</p>

<p>
    Your access token is <strong><?=htmlspecialchars($_SESSION['auth']->getAccessToken());?></strong>
    which expires at <strong><?=date('Y-m-d H:i:s', $_SESSION['auth']->getExpires());?></strong>.
    Your refresh token is <strong><?=htmlspecialchars($_SESSION['auth']->getRefreshToken());?></strong>.
</p>
