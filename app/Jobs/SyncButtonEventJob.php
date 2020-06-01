<?php

namespace App\Jobs;

use App\Contact;
use App\DTO\API\Klaviyo\ButtonEventDTO;
use App\Util\KlaviyoApiClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncButtonEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Contact $contact;

    private string $timestamp;

    public function __construct(Contact $contact, string $timestamp)
    {
        $this->contact = $contact;
        $this->timestamp = $timestamp;
    }

    public function handle(KlaviyoApiClient $klaviyoApiClient)
    {
        $buttonEventDTO = new ButtonEventDTO(
            $this->timestamp, $this->contact->id
        );
        $klaviyoApiClient->syncButtonEvent($buttonEventDTO);
    }
}
