<?php
return [
    'name' => 'CommunityAnalytics',

    'permissions' => [
        'admin' => 'See and be able to regenerate the api token, for CommunityAnalytics.',
    ],

    'cards' => [
        'marketing' => [
            'title' => 'Better marketing',
            'message' => 'Win new players more easily and more cheaply.',
        ],
        'retention' => [
            'title' => 'Retention',
            'message' => 'Detect why gamers stop and them hooked.',
        ],
        'more-money' => [
            'title' => 'Make more money',
            'message' => 'Earn more by finding your best packages and users.',
        ],
        'competition' => [
            'title' => 'Competition',
            'message' => "Detecting your server's market performance.",
        ],
    ],

    'success' => [
        'regenerate-api-key' => "Api token regenerated successfully!",
    ],

    'admin' => [
        'why-api-key' => "You now have an API key and Url that will allow you to collect your Azuriom site's store statistics.",
        'go-add-store' => "Go to our website to add Azuriom to your community's store.",
        'regenerate' => "Regenerate",
        'api-key' => "Api key",
        'api-url' => "Api url",
    ],

    'follow-link' => 'follow this link',
];
