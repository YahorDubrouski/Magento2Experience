<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Visitor\AddStandardOfPepperToVisitor;

abstract class AbstractFood implements FoodInterface
{
    protected float $amountGramsOfSalt = 0;

    protected float $amountGramsOfSugar = 0;

    protected float $amountGramsOfPaper = 0;

    private AddStandardOfPepperToVisitor $addPepperToVisitor;

    public function __construct(AddStandardOfPepperToVisitor $addPepperToVisitor)
    {
        $this->addPepperToVisitor = $addPepperToVisitor;
    }

    public function addGramsOfSalt(float $amountOfGrams): FoodInterface
    {
        $this->amountGramsOfSalt = $amountOfGrams;

        return $this;
    }

    public function addGramsOfSugar(float $amountOfGrams): FoodInterface
    {
        $this->amountGramsOfSugar = $amountOfGrams;

        return $this;
    }

    public function addGramsOfPaper(float $amountOfGrams): FoodInterface
    {
        $this->amountGramsOfPaper = $amountOfGrams;

        return $this;
    }

    public function addStandardOfPaperInGrams(): FoodInterface
    {
        $this->addPepperToVisitor->addPaper($this);

        return $this;
    }
}
