<?php

namespace App\Util;

use App\DTO\API\Klaviyo\ButtonEventDTO;
use App\DTO\API\Klaviyo\ContactDTO;

interface KlaviyoApiClientInterface
{
    public function syncContact(ContactDTO $contactDTO): void;

    public function syncButtonEvent(ButtonEventDTO $buttonEventDTO): void;
}
