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
            'text' => 'Dear {{name}}, we are just trying to make sure that your phone number {{phone}} is correct.',
        ]
    ]
];
