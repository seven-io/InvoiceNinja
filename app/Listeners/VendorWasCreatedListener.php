<?php

namespace Modules\Seven\Listeners;

use App\Events\Vendor\VendorWasCreated;
use Exception;
use Illuminate\Support\Facades\Http;

class VendorWasCreatedListener
{
    /**
     * Handle the given event.
     */
    public function handle(VendorWasCreated $event): void
    {
        $to = $event->vendor->phone;
        if (empty($to)) {
            logger('stop sending message: to is empty');
            return;
        }

        $vendor = $event->vendor;
        $vendorArr = $vendor->toArray();
        unset($vendorArr['settings']);
        logger('vendor was created', $vendorArr);

        list('apiKey' => $apiKey, 'events' => $events, 'sms' => $smsConfig) = config('seven');
        list('text' => $text, 'enabled' => $enabled) = $events['vendorCreated'];
        list('from' => $from) = $smsConfig;

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

        foreach(array_keys($vendorArr) as $key ){
            $value = $vendor->getAttribute($key);
            $text = str_replace('{{'.$key.'}}', $value, $text);
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
