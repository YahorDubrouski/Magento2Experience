<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\AbstractFactory;

use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish\DessertInterface;
use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish\SoupInterface;
use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\FoodAbstractFactoryInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\AmericanFood\AmericanSoup;
use EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\AmericanFood\AmericanSoupFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\AmericanFood\AmericanDessert;
use EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\AmericanFood\AmericanDessertFactory;

class AmericanFoodFactory implements FoodAbstractFactoryInterface
{
    private AmericanSoupFactory $soupFactory;

    private AmericanDessertFactory $dessertFactory;

    public function __construct(
        AmericanSoupFactory $soupFactory,
        AmericanDessertFactory $dessertFactory
    ) {
        $this->soupFactory = $soupFactory;
        $this->dessertFactory = $dessertFactory;
    }

    /**
     * @inheritdoc
     */
    public function createSoup(array $params): SoupInterface
    {
        $amountGramsOfSalt = $params['amountGramsOfSalt'] ?? 0;

        /** @var AmericanSoup $soup */
        $soup = $this->soupFactory->create();
        $soup->addGramsOfSalt($amountGramsOfSalt);

        return $soup;
    }

    /**
     * @inheritdoc
     */
    public function createDessert(array $params): DessertInterface
    {
        $amountGramsOfSugar = $params['amountGramsOfSugar'] ?? 0;

        /** @var AmericanDessert $dessert */
        $dessert = $this->dessertFactory->create();
        $dessert->addGramsOfSugar($amountGramsOfSugar);

        return $dessert;
    }
}
