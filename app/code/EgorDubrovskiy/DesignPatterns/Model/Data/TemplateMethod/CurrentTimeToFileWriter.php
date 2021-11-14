<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\TemplateMethod;

class CurrentTimeToFileWriter extends FileWriter
{
    protected function getDataToWrite(): string
    {
        return date('h:i:s');
    }
}
