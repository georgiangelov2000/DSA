<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\ProcessorAuctionController;
use App\Controllers\StandardBidAuctionController;
use App\Helpers\FileHelper;


// Check if a command line argument is provided
if ($argc < 2) {
    echo "Usage: php index.php <input_file>\n";
    exit(1);
}

// Get the input file path from command line argument
$inputFile = $argv[1];

// Check if the input file is a valid CSV file
if (!FileHelper::isFile($inputFile)) {
    echo "Error: The input file is not a valid.\n";
    exit(1);
}

$ext = FileHelper::getFileExtension($inputFile);

// Create an object of the AdvertisingBidAuction class, passing in the necessary auction factory and class
$auction = new ProcessorAuctionController(new StandardBidAuctionController(),$ext);

// We get the result of the highest and second highest bids
[$bestBid, $secondBestBid] = $auction->getBestBid($inputFile);

# Old version
        //Checking that the $bestBid and $secondBestBid arrays contain the keys we're trying to access
        // if (!isset($bestBid['ad_id'], $secondBestBid['ad_id'], $secondBestBid['bid'])) {
        //     echo "Error: Invalid data returned from the auction.\n";
        //     exit(1);
        // }

        // // Output the result
        // echo "{$bestBid['ad_id']}, {$secondBestBid['bid']}\n";
        // echo "Ad with ID {$bestBid['ad_id']} offers the best {$bestBid['bid']}, but the AD with ID {$secondBestBid['ad_id']} second-best bid is {$secondBestBid['bid']}.";
#---------------------------------------------------------------------------------------------

#new Version
// Checking that the $bestBid and $secondBestBid arrays contain the keys we're trying to access
if (!isset($bestBid[0], $secondBestBid[0], $secondBestBid[1])) {
    echo "Error: Invalid data returned from the auction.\n";
    exit(1);
}

// Output the result
echo "{$bestBid[0]}, {$secondBestBid[1]}\n";
echo "Ad with ID {$bestBid[0]} offers the best {$bestBid[1]}, but the AD with ID {$secondBestBid[0]} second-best bid is {$secondBestBid[1]}.";