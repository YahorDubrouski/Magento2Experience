<?php

declare(strict_types=1);

namespace EgorDubrovskiy\EnterprisePatterns\Model\DevelopmentPrinciples;

class Namer implements FirstFirst, LastFirst
{
    private string $firstName;

    private string $lastName;

    public function __construct(
        string $firstName,
        string $lastName
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function firstFirst(string $name): void
    {
        // TODO: Implement firstFirst() method.
    }

    public function lastFirst(string $name): void
    {
        // TODO: Implement lastFirst() method.
    }
}
