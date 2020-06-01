<?php

namespace App\Util;

use App\DTO\API\Klaviyo\ButtonEventDTO;
use App\DTO\API\Klaviyo\ContactDTO;
use App\Exceptions\KlaviyoApiClientException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Http;

class KlaviyoApiClient implements KlaviyoApiClientInterface
{
    CONST TRACK_ENDPOINT = 'track';

    CONST IDENTIFY_ENDPOINT = 'identify';

    public function syncContact(ContactDTO $contactDTO): void
    {
        Http::get(
            sprintf('%s/%s', $this->getUrl(), self::IDENTIFY_ENDPOINT), $this->getRequestData($contactDTO)
        );
    }

    public function syncButtonEvent(ButtonEventDTO $buttonEventDTO): void
    {
         Http::get(
            sprintf('%s/%s', $this->getUrl(), self::TRACK_ENDPOINT),$this->getRequestData($buttonEventDTO)
        );
    }

    private function getRequestData(Arrayable $DTO): array
    {
       $data  = array_merge($DTO->toArray(), ['token' => $this->getApiToken()]);

       return ['data' => base64_encode(json_encode($data))];
    }

    private function getUrl(): string
    {
        return env('KLAVIYO_API_URL', 'https://a.klaviyo.com/api');
    }

    private function getApiToken(): string
    {
        $token = env('KLAVIYO_API_TOKEN', null);
        if (!$token) {
            throw new KlaviyoApiClientException('Token not found.');
        }

        return $token;
    }
}
