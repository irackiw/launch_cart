<?php

namespace App\DTO\API\Klaviyo;

use Illuminate\Contracts\Support\Arrayable;

class ContactDTO implements Arrayable
{
    private int $id;

    private string $first_name;

    private string $email;

    private string $phone;

    public function __construct(int $id, string $first_name, string $email, string $phone)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'properties' => [
                '$id' => $this->getId(),
                '$first_name' => $this->getFirstName(),
                '$phone' => $this->getPhone(),
                '$email' => $this->getEmail(),
            ],
        ];
    }
}
