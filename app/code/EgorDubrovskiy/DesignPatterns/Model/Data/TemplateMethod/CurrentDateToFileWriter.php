<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\TemplateMethod;

class CurrentDateToFileWriter extends FileWriter
{
    protected function getDataToWrite(): string
    {
        return date('d-m-y');
    }
}
