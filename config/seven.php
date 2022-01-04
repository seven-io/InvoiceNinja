<?php

return [
    'apiKey' => $_ENV['SEVEN_API_KEY'] ?? '',
    'name' => 'Seven',
    'sms' => [
        'from' => 'InvoiceNinja'
    ],
    'events' => [
        'accountCreated' => [
            'enabled' => false,
            'text' => 'Account Created',
        ],
        'clientCreated' => [
            'enabled' => false,
            'text' => 'Client Created',
        ]
    ]
];
