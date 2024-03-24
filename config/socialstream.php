<?php

use JoelButcher\Socialstream\Features;
use JoelButcher\Socialstream\Providers;

return [
    'middleware' => ['web'],
    'prompt' => 'Or Login Via',
    'providers' => [
        // Providers::twitter(),
        'google',
        // Providers::google(),
        Providers::facebook(),
    ],
    'features' => [
        Features::createAccountOnFirstLogin(),
        Features::loginOnRegistration(),
        // Features::generateMissingEmails(),
        Features::rememberSession(),
        Features::providerAvatars(),
        Features::refreshOAuthTokens(),
    ],
];
