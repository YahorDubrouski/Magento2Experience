<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\JapaneseFood;

use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish\DessertInterface;

class JapaneseDessert implements DessertInterface
{
    private float $amountGramsOfSugar = 0;

    /**
     * @inheritdoc
     */
    public function addGramsOfSugar(float $amountOfGrams): DessertInterface
    {
        $this->amountGramsOfSugar += $amountOfGrams;

        return $this;
    }
}
