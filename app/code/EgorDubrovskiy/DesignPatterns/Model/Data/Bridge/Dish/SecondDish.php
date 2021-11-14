<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish;

class SecondDish extends Dish
{
    private float $amountOfBreadInChunks = 0;

    public function setAmountOfBreadInChunks(float $amount): SecondDish
    {
        $this->amountOfBreadInChunks = $amount;

        return $this;
    }
}
