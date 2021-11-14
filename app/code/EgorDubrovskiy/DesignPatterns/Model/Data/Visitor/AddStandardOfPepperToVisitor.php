<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Visitor;

use EgorDubrovskiy\DesignPatterns\Api\Data\Builder\FoodInterface;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\Bacon;
use EgorDubrovskiy\DesignPatterns\Model\Data\Builder\Food\Cheese;

class AddStandardOfPepperToVisitor
{
    public const AMOUNT_OF_PAPER_IN_GRAMS_FOR_CHEESE = 10;
    public const AMOUNT_OF_PAPER_IN_GRAMS_FOR_BACON = 15;

    public function addPaper(FoodInterface $visitor): void
    {
        if ($visitor instanceof Cheese) {
            $visitor->addGramsOfPaper(self::AMOUNT_OF_PAPER_IN_GRAMS_FOR_CHEESE);
        } elseif ($visitor instanceof Bacon) {
            $visitor->addGramsOfPaper(self::AMOUNT_OF_PAPER_IN_GRAMS_FOR_BACON);
        }
    }
}
