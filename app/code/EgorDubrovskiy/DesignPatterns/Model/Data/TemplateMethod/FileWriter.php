<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\TemplateMethod;

abstract class FileWriter
{
    public const FILE_PATH = '/var/www/html/var/template_method_demonstration.txt';

    public function writeDataToFile(): void
    {
        $data = $this->getDataToWrite();
        file_put_contents(self::FILE_PATH, $data);
    }

    abstract protected function getDataToWrite(): string;
}
