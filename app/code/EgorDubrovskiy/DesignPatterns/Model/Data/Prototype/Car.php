<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Prototype;

class Car
{
    private const TRUNK_SIZE_FOR_PASSENGER_CAR = 'Little';
    private const TRUNK_SIZE_FOR_MINIVAN_CAR = 'Big';
    private const TRUNK_SIZE_FOR_TRUCK_CAR = 'Very Big';

    private ?string $color;

    private ?int $number;

    private ?string $trunkSize;

    public function setColor(string $color): Car
    {
        $this->color = $color;

        return $this;
    }

    public function setNumber(int $number): Car
    {
        $this->number = $number;

        return $this;
    }

    public function setTrunkSize(string $trunkSize): Car
    {
        $this->trunkSize = $trunkSize;

        return $this;
    }

    public function getPassengerCarVersion(): Car
    {
        $car = clone $this;
        $car->setTrunkSize(self::TRUNK_SIZE_FOR_PASSENGER_CAR);

        return $car;
    }

    public function getMinivanCarVersion(): Car
    {
        $car = clone $this;
        $car->setTrunkSize(self::TRUNK_SIZE_FOR_MINIVAN_CAR);

        return $car;
    }

    public function getTruckCarVersion(): Car
    {
        $car = clone $this;
        $car->setTrunkSize(self::TRUNK_SIZE_FOR_TRUCK_CAR);

        return $car;
    }
}
