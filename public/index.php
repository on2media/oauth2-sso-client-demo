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

<p>
    The time now is <strong><?=date('Y-m-d H:i:s');?></strong>.<br>
    Timeout at <strong><?=\DateTime::createFromFormat(\DateTime::ATOM, $_SESSION['auth']->getResourceOwner()['timeout']['due_at'])->format('Y-m-d H:i:s');?></strong>.
</p>

<div id="timeout" style="border: 1px solid black; padding: 10px; min-height: 2em;"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var checkTimeout = function(){
        $.get('check-timeout.php', function(data){
            console.log(data);
            if (!data.signed_in || typeof data.timeout_due_at == 'undefined') {
                $('#timeout').text('TIMED OUT OR SIGNED OUT ELSEWHERE');
                return;
            }
            $('#timeout').text('Time out at ' + data.timeout_due_at);
            setTimeout(checkTimeout, 30000);
        });
    }
    setTimeout(checkTimeout, 30000);
});
</script>
