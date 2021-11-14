<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\AbstractFactory;

use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish\DessertInterface;
use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\Dish\SoupInterface;
use EgorDubrovskiy\DesignPatterns\Api\Data\AbstractFactory\FoodAbstractFactoryInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\JapaneseFood\JapaneseSoup;
use EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\JapaneseFood\JapaneseSoupFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\JapaneseFood\JapaneseDessert;
use EgorDubrovskiy\DesignPatterns\Model\Data\AbstractFactory\JapaneseFood\JapaneseDessertFactory;

class JapaneseFoodFactory implements FoodAbstractFactoryInterface
{
    private JapaneseSoupFactory $soupFactory;

    private JapaneseDessertFactory $dessertFactory;

    public function __construct(
        JapaneseSoupFactory $soupFactory,
        JapaneseDessertFactory $dessertFactory
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

        /** @var JapaneseSoup $soup */
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

        /** @var JapaneseDessert $dessert */
        $dessert = $this->dessertFactory->create();
        $dessert->addGramsOfSugar($amountGramsOfSugar);

        return $dessert;
    }
}
