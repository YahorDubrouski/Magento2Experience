<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Food;

use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish\Dish;
use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish\FirstDish;
use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish\SecondDish;
use Magento\Framework\Exception\LocalizedException;

abstract class NationalFood
{
    public function cookDish(Dish $dish): Dish
    {
        if ($dish instanceof FirstDish) {
            return $this->cookFirst($dish);
        } elseif ($dish instanceof SecondDish) {
            return $this->cookSecond($dish);
        }

        throw new LocalizedException(__('Unknown type of food'));
    }

    abstract protected function cookFirst(FirstDish $dish): Dish;

    abstract protected function cookSecond(SecondDish $dish): Dish;
}
