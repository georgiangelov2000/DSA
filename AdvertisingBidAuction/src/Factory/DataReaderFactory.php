<?php
declare(strict_types=1);

namespace App\Factory;
use App\Interface\DataReader;
use App\Interface\DataReaderFactory as DataReaderFactoryInterface;
use App\Services\CsvDataReader;

class DataReaderFactory implements DataReaderFactoryInterface
{
    /**
     * Creates a data reader based on the given type.
     *
     * @param string $type The type of the data reader to create.
     * @return DataReader The created data reader.
     * @throws Exception If an invalid type is provided.
     */
    public function createDataReader(string $type): DataReader
    {
        return match ($type) {
            'csv' => new CsvDataReader(), // If the type is 'csv', create a CsvDataReader.
            default => throw new Exception("Invalid type"), // If the type is not recognized, throw an exception.
        };
    }
}