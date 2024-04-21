<?php
declare(strict_types=1);

namespace App\Services;
use App\Interface\DataReader;

class CsvDataReader implements DataReader
{
    /**
     * Reads data from a CSV file and returns it as an array.
     *
     * @param string $filename The path to the CSV file.
     * @return array The data read from the CSV file.
     */
    public function readData(string $filename): array
    {
        $memoryBefore = memory_get_usage(); // Save used memory before processing
        $timeStart = microtime(true); // Start the timer

        $data = [];

        if (($handle = fopen($filename, "r")) !== false) {
            // We skip the first row as it usually contains the column headings
            fgetcsv($handle);

            while (($rowData = fgetcsv($handle, 1000, ",")) !== false) {
                $data[] = [(int)$rowData[0], (float)$rowData[1]];
                
                #Memory data improvement loading from (5157296 bytes) to (2916664 bytes)
                    // $data[] = [
                    //     'ad_id' => $rowData[0],
                    //     'bid' => $rowData[1]
                    // ];
                #-----------------------------------------------------------------------
            }
            fclose($handle);
        }

        $memoryAfter = memory_get_usage(); // Save used memory after processing
        $memoryPeak = memory_get_peak_usage();  // // Record the maximum used memory
        $timeEnd = microtime(true); // End the timer

        echo "Memory usage before: " . $memoryBefore . " bytes\n";
        echo "Memory usage after: " . $memoryAfter . " bytes\n";
        echo "Peak memory usage: " . $memoryPeak . " bytes\n";
        echo "Time taken: " . ($timeEnd - $timeStart) . " seconds\n";
        echo "CsvDataReader------------------------------------------\n";
        
        return $data;
    }
}