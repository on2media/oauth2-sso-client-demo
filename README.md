# OAuth2 Single Sign-On Client Demo

A demo client utilising our [OAuth2 Single Sign-On Client][1] to show how to sign in using your own
custom sign in form.

This is our SSO equivalent of [Resource Owner Password Credentials][2] so should only be used for
your own applications. It is ideal during migration from direct authentication as providing that you
assign your client to it’s users (at the SSO service) the use of the SSO service should be invisible
to the end user.

If you would prefer to show your SSO service’s sign in form you can utilise the normal
[OAuth2 Authorization Code flow][3] to sign in.

# Setup

Add a client to the provider:

- **redirect_uri** - callback.php
- **sso_auth_url** - authenticate.php
- **sso_home_url** - index.php

[1]: https://github.com/on2media/oauth2-sso-client
[2]: http://bshaffer.github.io/oauth2-server-php-docs/grant-types/user-credentials/
[3]: http://oauth2-client.thephpleague.com/usage/
