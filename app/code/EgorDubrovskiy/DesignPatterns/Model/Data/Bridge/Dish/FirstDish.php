<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish;

class FirstDish extends Dish
{
    private float $amountOfWaterInLiters = 0;

    public function setAmountOfWaterInLiters(float $amount): FirstDish
    {
        $this->amountOfWaterInLiters = $amount;

        return $this;
    }
}
