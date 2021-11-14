<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Service\Builder;

use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\BaconFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\CheeseFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\MushroomFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\PineappleFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\SeafoodFactory;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Pizza;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\PizzaFactory;
use Magento\Framework\App\RequestInterface;

class PizzaByRequestBuilder
{
    public const REQUEST_PARAM_NAME_CHEESE = 'cheese';
    public const REQUEST_PARAM_NAME_BACON = 'bacon';
    public const REQUEST_PARAM_NAME_MUSHROOM = 'mushroom';
    public const REQUEST_PARAM_NAME_PINEAPPLE = 'pineapple';
    public const REQUEST_PARAM_NAME_SEAFOOD = 'seafood';

    private PizzaFactory $pizzaFactory;

    private CheeseFactory $cheeseFactory;

    private BaconFactory $baconFactory;

    private MushroomFactory $mushroomFactory;

    private PineappleFactory $pineappleFactory;

    private SeafoodFactory $seafoodFactory;

    private RequestInterface $request;

    public function __construct(
        PizzaFactory $pizzaFactory,
        CheeseFactory $cheeseFactory,
        BaconFactory $baconFactory,
        MushroomFactory $mushroomFactory,
        PineappleFactory $pineappleFactory,
        SeafoodFactory $seafoodFactory,
        RequestInterface $request
    ) {
        $this->pizzaFactory = $pizzaFactory;
        $this->cheeseFactory = $cheeseFactory;
        $this->baconFactory = $baconFactory;
        $this->mushroomFactory = $mushroomFactory;
        $this->pineappleFactory = $pineappleFactory;
        $this->seafoodFactory = $seafoodFactory;
        $this->request = $request;
    }

    public function build(): Pizza
    {
        /** @var Pizza $pizza */
        $pizza = $this->pizzaFactory->create();

        $this->buildBaconInPizza($pizza)
            ->buildCheeseInPizza($pizza)
            ->buildMushroomInPizza($pizza)
            ->buildPineappleInPizza($pizza)
            ->buildSeafoodInPizza($pizza);

        return $pizza;
    }

    private function buildCheeseInPizza(Pizza $pizza): self
    {
        if ($this->request->getParam(self::REQUEST_PARAM_NAME_CHEESE)) {
            $cheese = $this->cheeseFactory->create();
            $pizza->addIngredient($cheese);
        }

        return $this;
    }

    private function buildBaconInPizza(Pizza $pizza): self
    {
        if ($this->request->getParam(self::REQUEST_PARAM_NAME_BACON)) {
            $bacon = $this->baconFactory->create();
            $pizza->addIngredient($bacon);
        }

        return $this;
    }

    private function buildMushroomInPizza(Pizza $pizza): self
    {
        if ($this->request->getParam(self::REQUEST_PARAM_NAME_MUSHROOM)) {
            $mushroom = $this->mushroomFactory->create();
            $pizza->addIngredient($mushroom);
        }

        return $this;
    }

    private function buildPineappleInPizza(Pizza $pizza): self
    {
        if ($this->request->getParam(self::REQUEST_PARAM_NAME_PINEAPPLE)) {
            $pineapple = $this->pineappleFactory->create();
            $pizza->addIngredient($pineapple);
        }

        return $this;
    }

    private function buildSeafoodInPizza(Pizza $pizza): self
    {
        if ($this->request->getParam(self::REQUEST_PARAM_NAME_SEAFOOD)) {
            $seafood = $this->seafoodFactory->create();
            $pizza->addIngredient($seafood);
        }

        return $this;
    }
}
