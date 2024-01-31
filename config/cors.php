<?php

return [
    'paths' => ['*'],

    'allowed_methods' => ['*'],

    // 'allowed_origins' => ['https://knm-travels.com'],

    'allowed_origins' => ['http://localhost:3000', 'https://knm-travels.com'],

    'allowed_origins_patterns' => ['*'],

    'allowed_headers' => ['*'],

    'exposed_headers' => ['*'],

    'max_age' => 0,

    'supports_credentials' => true,
];
