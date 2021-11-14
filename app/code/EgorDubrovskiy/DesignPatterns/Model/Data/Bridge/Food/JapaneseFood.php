<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Food;

use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish\FirstDish;
use EgorDubrovskiy\DesignPatterns\Model\Data\Bridge\Dish\SecondDish;

class JapaneseFood extends NationalFood
{
    private const AMOUNT_OF_SALT_FOR_FIRST_DISH_IN_GRAMS = 10;
    private const AMOUNT_OF_SUGAR_FOR_FIRST_DISH_IN_GRAMS = 5;
    private const AMOUNT_OF_WATER_FOR_FIRST_DISH_IN_LITERS = 1.5;

    private const AMOUNT_OF_SALT_FOR_SECOND_DISH_IN_GRAMS = 7;
    private const AMOUNT_OF_SUGAR_FOR_SECOND_DISH_IN_GRAMS = 3;
    private const AMOUNT_OF_BREAD_FOR_SECOND_DISH_IN_CHUNKS = 1.5;

    protected function cookFirst(FirstDish $dish): FirstDish
    {
        $dish->setGramsOfSalt(self::AMOUNT_OF_SALT_FOR_FIRST_DISH_IN_GRAMS)
            ->setGramsOfSugar(self::AMOUNT_OF_SUGAR_FOR_FIRST_DISH_IN_GRAMS)
            ->setAmountOfWaterInLiters(self::AMOUNT_OF_WATER_FOR_FIRST_DISH_IN_LITERS);

        return $dish;
    }

    protected function cookSecond(SecondDish $dish): SecondDish
    {
        $dish->setGramsOfSalt(self::AMOUNT_OF_SALT_FOR_SECOND_DISH_IN_GRAMS)
            ->setGramsOfSugar(self::AMOUNT_OF_SUGAR_FOR_SECOND_DISH_IN_GRAMS)
            ->setAmountOfBreadInChunks(self::AMOUNT_OF_BREAD_FOR_SECOND_DISH_IN_CHUNKS);

        return $dish;
    }
}
