<?php
declare(strict_types=1);

namespace App\Interface;

use App\Interface\DataReader;

/**
 * Factory interface for creating data readers.
 */
interface DataReaderFactory
{
    /**
     * Creates a data reader.
     *
     * @return DataReader A data reader instance.
     */
    public function createDataReader(string $type): DataReader;
}