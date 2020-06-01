<?php

namespace App\Observers;

use App\Contact;
use App\Jobs\SyncContactJob;

class ContactObserver
{
    public function created(Contact $contact)
    {
        $this->dispatchSyncJob($contact);
    }

    public function updated(Contact $contact)
    {
        $this->dispatchSyncJob($contact);
    }

    private function dispatchSyncJob(Contact $contact): void
    {
        SyncContactJob::dispatch($contact);
    }
}
