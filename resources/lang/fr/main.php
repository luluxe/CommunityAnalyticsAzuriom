<?php
return [
    'name' => 'CommunityAnalytics',

    'permissions' => [
        'admin' => "Voir et pouvoir régénérer l'api token, pour CommunityAnalytics.",
    ],

    'cards' => [
        'marketing' => [
            'title' => 'Meilleur marketing',
            'message' => 'Gagnez de nouveaux joueurs plus facilement et à moindre coût.',
        ],
        'retention' => [
            'title' => 'Rétention',
            'message' => 'Détectez pourquoi et quand les joueurs arrêtent.',
        ],
        'more-money' => [
            'title' => 'Gagner plus d\'argent',
            'message' => 'Gagnez plus en trouvant comment vendre plus à vos joueurs.',
        ],
        'competition' => [
            'title' => 'Concurrence',
            'message' => "Détection de la performance de votre serveur par rapport au marché.",
        ],
    ],

    'success' => [
        'regenerate-api-key' => "Api token régénéré avec succès!",
    ],

    'admin' => [
        'why-api-key' => "Vous avez désormais une clé d'API et une URL qui va vous permettre de collecter les statistiques boutique de votre site Azuriom.",
        'go-add-store' => "Rendez vous sur notre site web pour ajouter Azuriom en boutique de votre communauté.",
        'regenerate' => "Régénérer",
        'api-key' => "Api key",
        'api-url' => "Api url",
    ],

    'follow-link' => 'suivez ce lien',
];
