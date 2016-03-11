<?php

function getAuthenticateUrl()
{
    return 'authenticate.php';
}

function getSignInUrl()
{
    return 'sign-in.php';
}

function getHomeUrl()
{
    return 'index.php';
}

function buildSignInUrl()
{
    return buildAuthUrl(getenv('OAUTH2_URL_SSO_SIGN_IN'));
}

function buildSignOutUrl()
{
    return buildAuthUrl(getenv('OAUTH2_URL_SSO_SIGN_OUT'));
}

function buildAuthUrl($url)
{
    list($timeMid, $timeLow) = explode(' ', microtime());
    $nonce = dechex($timeLow) . sprintf('%04x', (int) substr($timeMid, 2) & 0xffff);
    $hash = hash_hmac(
        'sha1',
        getenv('OAUTH2_CLIENT_ID') . $nonce,
        getenv('OAUTH2_CLIENT_SECRET')
    );

    return $url . '?' . http_build_query(
        [
            'sso' => '1',
            'client' => getenv('OAUTH2_CLIENT_ID'),
            'nonce' => $nonce,
            'hash' => $hash,
        ]
    );
}

function checkSignedIn($oAuth2Provider)
{
    if (!isset($_SESSION['auth'])) {

        header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
        header('Location: ' . getAuthenticateUrl());
        exit;

    }

    if ($_SESSION['auth']['expires'] < time()) {

        try {

            $newAccessToken = $oAuth2Provider->getAccessToken(
                'refresh_token',
                [
                    'refresh_token' => $_SESSION['auth']['refresh_token']
                ]
            );

        } catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

            unset($_SESSION['auth']);

            if ($e->getMessage() != 'invalid_grant') {
                throw $e;
            }

            $_SESSION['timed_out'] = true;
            header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
            header('Location: ' . getAuthenticateUrl());
            exit;

        }

        $_SESSION['auth']['access_token'] = $newAccessToken->getToken();
        $_SESSION['auth']['expires'] = $newAccessToken->getExpires();

    }

    try {

        $accessToken = new \League\OAuth2\Client\Token\AccessToken(
            [
                'access_token' => $_SESSION['auth']['access_token'],
            ]
        );

        $resourceOwner = $oAuth2Provider->getResourceOwner($accessToken);

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

        if ($e->getMessage() != 'invalid_token' && $e->getMessage() != 'expired_token') {
            throw $e;
        }

        $_SESSION['timed_out'] = true;

        // the access token has prematurely expired due to inactivity
        $_SESSION['auth']['expires'] = 0;

        header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
        header('Location: ' . getAuthenticateUrl());
        exit;

    }
}
