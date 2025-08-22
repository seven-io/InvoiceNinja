<?php

return [
    'apiKey' => $_ENV['SEVEN_API_KEY'] ?? '',
    'name' => 'Seven',
    'sms' => [
        'from' => 'InvoiceNinja'
    ],
    'events' => [
        'clientCreated' => [
            'enabled' => false,
            'text' => 'Client Created',
        ]
    ]
];
