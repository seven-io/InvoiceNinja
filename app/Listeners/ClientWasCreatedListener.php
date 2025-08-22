<?php

namespace Modules\Seven\Listeners;

use App\Events\Client\ClientWasCreated;
use Exception;
use Illuminate\Support\Facades\Http;

class ClientWasCreatedListener
{
    /**
     * Handle the given event.
     */
    public function handle(ClientWasCreated $event): void
    {
        $client = $event->client;
        $clientArr = $client->toArray();
        unset($clientArr['settings']);
        logger('client was created', $clientArr);


        $cfg = config('seven');
        //logger('seven config', $cfg);
        list('text' => $text, 'enabled' => $enabled, 'sms' => $smsConfig) = $cfg['events']['clientCreated'];
        list('from' => $from) = $smsConfig;

        $apiKey = $cfg['apiKey'];
        if (empty($apiKey)) {
            logger('stop sending message: apiKey is empty');
            return;
        }

        if (!$enabled) {
            logger('stop sending message: event is disabled');
            return;
        }

        if (empty($text)) {
            logger('stop sending message: text is empty');
            return;
        }

        foreach(array_keys($clientArr) as $key ){
            $value = $client->getAttribute($key);
            $text = str_replace('{{'.$key.'}}', $value, $text);
        }

        $to = $event->client->phone;
        if (empty($to)) {
            logger('stop sending message: to is empty');
            return;
        }

        $params = compact('from', 'text', 'to');
        logger('smsParams', $params);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'SentWith' => 'InvoiceNinja',
                'X-Api-Key' => $apiKey,
            ])->post('https://gateway.seven.io/api/sms', $params);
            logger($response);
        } catch (Exception $e) {
            logger($e->getMessage());
        }
    }
}
