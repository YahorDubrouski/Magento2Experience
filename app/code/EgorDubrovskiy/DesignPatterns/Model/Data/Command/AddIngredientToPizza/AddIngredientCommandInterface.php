<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Command\AddIngredientToPizza;

interface AddIngredientCommandInterface
{
    public function execute(): void;
}
