<?php

namespace Modules\Seven\Listeners;

use App\Events\Account\AccountCreated;

class AccountCreatedListener
{
    /**
     * Handle the given event.
     */
    public function handle(AccountCreated $event): void
    {
        dd($event);
    }
}
