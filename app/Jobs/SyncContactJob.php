<?php

namespace App\Jobs;

use App\Contact;
use App\DTO\API\Klaviyo\ContactDTO;
use App\Util\KlaviyoApiClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function handle(KlaviyoApiClient $klaviyoApiClient): void
    {
        $contactDTO = new ContactDTO(
            $this->contact->id,
            $this->contact->first_name,
            $this->contact->email,
            $this->contact->phone,
        );

        $klaviyoApiClient->syncContact($contactDTO);
    }
}
