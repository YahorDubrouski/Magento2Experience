<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\AmericanFood;

use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish\SoupInterface;

class AmericanSoup implements SoupInterface
{
    private float $amountGramsOfSalt = 0;

    /**
     * @inheritdoc
     */
    public function addGramsOfSalt(float $amountOfGrams): SoupInterface
    {
        $this->amountGramsOfSalt += $amountOfGrams;

        return $this;
    }
}
