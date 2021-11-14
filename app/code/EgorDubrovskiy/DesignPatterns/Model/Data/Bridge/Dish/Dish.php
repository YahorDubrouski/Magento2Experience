<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish;

abstract class Dish
{
    private float $gramsOfSalt = 0;

    private float $gramsOfSugar = 0;

    public function setGramsOfSalt(float $amount): Dish
    {
        $this->gramsOfSalt = $amount;

        return $this;
    }

    public function setGramsOfSugar(float $amount): Dish
    {
        $this->gramsOfSugar = $amount;

        return $this;
    }
}
