<?php

require_once __DIR__ . '/../bootstrap.php';

if (isset($_SESSION['auth'])) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
    header('Location: index.php');
    exit;
}

$failedSignIn = false;
if (isset($_SESSION['failed_sign_in']) && $_SESSION['failed_sign_in'] == true) {
    $failedSignIn = true;
    unset($_SESSION['failed_sign_in']);
}

$justSignedOut = false;
if (isset($_SESSION['just_signed_out']) && $_SESSION['just_signed_out'] == true) {
    $justSignedOut = true;
    unset($_SESSION['just_signed_out']);
}

$timedOut = false;
if (isset($_SESSION['timed_out']) && $_SESSION['timed_out'] == true) {
    $timedOut = true;
    unset($_SESSION['timed_out']);
}

?>

<?php if ($failedSignIn == true): ?>
    <div>
        <strong>Your credentials were incorrect.</strong>
    </div>
<?php endif; ?>

<?php if ($justSignedOut == true): ?>
    <div>
        <strong>You have signed out.</strong>
    </div>
<?php endif; ?>

<?php if ($timedOut == true): ?>
    <div>
        <strong>Your session has timed out or you signed out of another service.</strong>
    </div>
<?php endif; ?>

<form action="<?=$client->buildSignInUrl();?>" method="post">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="" id="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" value="" id="password">
    </div>
    <input type="submit" value="Sign In">
</form>
