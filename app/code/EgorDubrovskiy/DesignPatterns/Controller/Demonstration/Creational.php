<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Controller\Demonstration;

use EgorDubrovskiy\DesignPatterns\Api\Service\FactoryMethod\FoodFactoryInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Prototype\Car;
use EgorDubrovskiy\DesignPatterns\Model\Data\Prototype\CarFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Singleton\AdvertisingBanner;
use EgorDubrovskiy\DesignPatterns\Model\Service\AbstractFactory\FoodFactoryCreator;
use EgorDubrovskiy\DesignPatterns\Model\Service\Builder\PizzaByRequestBuilder;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Raw as ResultRaw;
use Magento\Framework\Controller\Result\RawFactory as ResultRawFactory;
use Magento\Framework\Exception\LocalizedException;

/**
 * This class was created just for test and a simple demonstration
 * The class may contain HTML tags that is not good for doing it in Controller, but we do it to make it faster
 */
class Creational implements HttpGetActionInterface
{
    public const REQUEST_PARAM_NAME_PATTERN = 'pattern';
    public const PATTERN_NAME_FACTORY_METHOD = 'factory_method';
    public const PATTERN_NAME_ABSTRACT_FACTORY = 'abstract_factory';
    public const PATTERN_NAME_PROTOTYPE = 'prototype';
    public const PATTERN_NAME_BUILDER = 'builder';
    public const PATTERN_NAME_SINGLETON = 'singleton';

    private FoodFactoryInterface $foodFactory;

    private RequestInterface $request;

    private ResultRawFactory $resultRawFactory;

    private FoodFactoryCreator $foodFactoryCreator;

    private CarFactory $carFactory;

    private PizzaByRequestBuilder $pizzaByRequestBuilder;

    private AdvertisingBanner $advertisingBanner;

    public function __construct(
        FoodFactoryInterface $foodFactory,
        RequestInterface $request,
        ResultRawFactory $resultRawFactory,
        FoodFactoryCreator $foodFactoryCreator,
        CarFactory $carFactory,
        PizzaByRequestBuilder $pizzaByRequestBuilder,
        AdvertisingBanner $advertisingBanner
    ) {
        $this->foodFactory = $foodFactory;
        $this->request = $request;
        $this->resultRawFactory = $resultRawFactory;
        $this->foodFactoryCreator = $foodFactoryCreator;
        $this->carFactory = $carFactory;
        $this->pizzaByRequestBuilder = $pizzaByRequestBuilder;
        $this->advertisingBanner = $advertisingBanner;
    }

    public function execute()
    {
        $patternName = $this->request->getParam(self::REQUEST_PARAM_NAME_PATTERN);

        if ($patternName === self::PATTERN_NAME_FACTORY_METHOD) {
            return $this->demonstrateFactoryMethod();
        } elseif ($patternName === self::PATTERN_NAME_ABSTRACT_FACTORY) {
            return $this->demonstrateAbstractFactory();
        } elseif ($patternName === self::PATTERN_NAME_PROTOTYPE) {
            return $this->demonstratePrototype();
        } elseif ($patternName === self::PATTERN_NAME_BUILDER) {
            return $this->demonstrateBuilder();
        } elseif ($patternName === self::PATTERN_NAME_SINGLETON) {
            return $this->demonstrateSingleton();
        }

        return $this->resultRawFactory->create();
    }

    private function demonstrateFactoryMethod(): ResultRaw
    {
        $resultContent = '<div><b>Factory Method</b></div>';

        $salad = $this->foodFactory->createFoodByName(FoodFactoryInterface::FOOD_NAME_SALAD);
        $resultContent .= 'You ordered: ' . $salad->getName() . '<br>';
        $meat = $this->foodFactory->createFoodByName(FoodFactoryInterface::FOOD_NAME_MEAT);
        $resultContent .= 'You ordered: ' . $meat->getName() . '<br>';

        /** @var ResultRaw $result */
        $result = $this->resultRawFactory->create();
        return $result->setContents($resultContent);
    }

    private function demonstrateAbstractFactory(): ResultRaw
    {
        $resultContent = '<div><b>Abstract Factory</b></div>';

        $resultContent .= $this->demonstrateAmericanFoodFactory();
        $resultContent .= $this->demonstrateJapaneseFoodFactory();

        /** @var ResultRaw $result */
        $result = $this->resultRawFactory->create();
        return $result->setContents($resultContent);
    }

    private function demonstrateAmericanFoodFactory(): string
    {
        $americanFoodFactory = $this->foodFactoryCreator->createFactoryByName(
            FoodFactoryCreator::AMERICAN_FOOD_FACTORY_NAME
        );
        $soup = $americanFoodFactory->createSoup(['amountGramsOfSalt' => 3]);
        $dessert = $americanFoodFactory->createDessert(['amountGramsOfSugar' => 7]);

        $output = '<pre>' . var_export($soup, true) . '</pre>';
        $output .= '<pre>' . var_export($dessert, true) . '</pre>';

        return $output;
    }

    private function demonstrateJapaneseFoodFactory(): string
    {
        $japaneseFoodFactory = $this->foodFactoryCreator->createFactoryByName(
            FoodFactoryCreator::JAPANESE_FOOD_FACTORY_NAME
        );
        $soup = $japaneseFoodFactory->createSoup(['amountGramsOfSalt' => 2]);
        $dessert = $japaneseFoodFactory->createDessert(['amountGramsOfSugar' => 5]);

        $output = '<pre>' . var_export($soup, true) . '</pre>';
        $output .= '<pre>' . var_export($dessert, true) . '</pre>';

        return $output;
    }

    private function demonstratePrototype(): ResultRaw
    {
        /** @var Car $car */
        $car = $this->carFactory->create();
        $car->setColor('White')
            ->setNumber(1);

        $passengerCar = $car->getPassengerCarVersion();
        $minivanCar = $car->getMinivanCarVersion();
        $truckCar = $car->getTruckCarVersion();

        $resultContent = '<div><b>Prototype</b></div>';
        $resultContent .= '<pre>Passenger Car Version: ' . var_export($passengerCar, true) . '</pre>';
        $resultContent .= '<pre>Minivan Car Version: ' . var_export($minivanCar, true) . '</pre>';
        $resultContent .= '<pre>Truck Car Version: ' . var_export($truckCar, true) . '</pre>';

        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    private function demonstrateBuilder(): ResultRaw
    {
        $pizza = $this->pizzaByRequestBuilder->build();

        $resultContent = '<div><b>Builder</b></div>';
        $resultContent .= '<pre>' . var_export($pizza, true) . '</pre>';

        return $this->resultRawFactory->create()->setContents($resultContent);
    }

    private function demonstrateSingleton(): ResultRaw
    {
        $resultContent = '<div><b>Singleton</b></div>';

        for ($i = 0; $i < AdvertisingBanner::BANNERS_LIMIT + 1; $i++) {
            try {
                $banner = $this->advertisingBanner->createBannerInstance();
                $resultContent .= '<div>Banner with number: ' . $banner->getNumber() . ' was created</div>';
            } catch (LocalizedException $localizedException) {
                $resultContent .= '<div>' . $localizedException->getMessage() . '</div>';
                $banners = $this->advertisingBanner->getCurrentBannerInstances();
                $resultContent .= '<div><b>Created amount of banners: ' . count($banners) . '</b></div>';
            }
        }

        /** @var ResultRaw $result */
        $result = $this->resultRawFactory->create();
        return $result->setContents($resultContent);
    }
}
