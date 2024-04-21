<?php
declare(strict_types=1);

namespace App\Interface;

/**
 * Interface for classes that read data from a source and return it as an array.
 */
interface DataReader
{
    /**
     * Reads data from a source (e.g., file, database) and returns it as an array.
     *
     * @param string $filename The path to the source from which to read the data.
     * @return array The data read from the source.
     */
    public function readData(string $filename): array;
}