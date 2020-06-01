<?php

namespace App\DTO\API\Klaviyo;

use Illuminate\Contracts\Support\Arrayable;

class ButtonEventDTO implements Arrayable
{
    const EVENT_NAME = 'Button clicked';

    private string $timestamp;

    private int $user_id;

    public function __construct(string $time, int $user_id)
    {
        $this->timestamp = $time;
        $this->user_id = $user_id;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'event' => self::EVENT_NAME,
            'time' => $this->getTimestamp(),
            'customer_properties' => [
                '$id' => $this->getUserId(),
            ],
        ];
    }
}
