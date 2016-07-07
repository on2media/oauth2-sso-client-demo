<?php

require_once __DIR__ . '/../bootstrap.php';

$client->checkSignedIn('page2.php');

?>

<a href="index.php">Index</a>

<p>
    This is page 2. If we try to visit this page and we're not signed in we should be redirected
    back here.
</p>
