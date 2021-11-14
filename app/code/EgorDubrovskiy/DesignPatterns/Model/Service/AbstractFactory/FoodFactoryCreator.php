<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\AbstractFactory;

use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\FoodAbstractFactoryInterface;
use EgorDubrovskiy\DesignPatterns\Model\Service\AbstractFactory\AmericanFoodFactoryFactory
    as AmericanFoodFactoryCreator;
use EgorDubrovskiy\DesignPatterns\Model\Service\AbstractFactory\JapaneseFoodFactoryFactory
    as JapaneseFoodFactoryCreator;
use InvalidArgumentException;

class FoodFactoryCreator
{
    public const AMERICAN_FOOD_FACTORY_NAME = 'AmericanFoodFactory';
    public const JAPANESE_FOOD_FACTORY_NAME = 'JapaneseFoodFactory';

    private AmericanFoodFactoryCreator $americanFoodFactoryCreator;

    private JapaneseFoodFactoryCreator $japaneseFoodFactoryCreator;

    public function __construct(
        AmericanFoodFactoryCreator $americanFoodFactoryCreator,
        JapaneseFoodFactoryCreator $japaneseFoodFactoryCreator
    ) {
        $this->japaneseFoodFactoryCreator = $japaneseFoodFactoryCreator;
        $this->americanFoodFactoryCreator = $americanFoodFactoryCreator;
    }

    public function createFactoryByName(string $name): FoodAbstractFactoryInterface
    {
        if ($name === self::AMERICAN_FOOD_FACTORY_NAME) {
            return $this->americanFoodFactoryCreator->create();
        } elseif ($name === self::JAPANESE_FOOD_FACTORY_NAME) {
            return $this->japaneseFoodFactoryCreator->create();
        }

        throw new InvalidArgumentException("Food Factory with name: $name was not found");
    }
}
