<?php
declare(strict_types=1);

namespace App\Helpers;
// Singleton instance

class FileHelper {

    private function __construct()
    {
        // Private constructor to prevent instantiation
    }
    /**
     * Checks if the input file is a valid CSV file.
     *
     * @param string $filename The path to the CSV file.
     * @return bool True if the file is a valid CSV, false otherwise.
     */
    static function isValidCsv(string $filename): bool {
        // Check if the file exists
        if (!file_exists($filename)) {
            return false;
        }
        
        // Try to open the file
        if (($handle = fopen($filename, "r")) === false) {
            return false;
        }

        // Check if the first row contains valid CSV data
        $data = fgetcsv($handle);

        fclose($handle);

        return $data !== false;
    }

    /**
     * Checks if the input path points to a file and if the file exists.
     *
     * @param string $filePath The path to check.
     * @return bool True if the path points to an existing file, false otherwise.
     */
    static function isFile(string $filePath): bool {
        return is_file($filePath) && file_exists($filePath);
    }

    /**
     * Retrieves the extension of a file.
     *
     * @param string $filePath The path to the file.
     * @return string|false The extension of the file, or false if the file does not exist or has no extension.
     */
    static function getFileExtension(string $filePath) {
        // Return the file extension
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }
}