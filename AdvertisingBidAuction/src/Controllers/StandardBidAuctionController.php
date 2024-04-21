<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Interface\BidAuction;

class StandardBidAuctionController implements BidAuction
{
    
    /**
     * Find the best bid and the second best bid from the given data.
     *
     * @param array $data The array containing bid data.
     * @return array An array containing the best bid and the second best bid.
     */
    public function findBestBid(array $data): array
    {
        
        $memoryBefore = memory_get_usage(); // Save used memory before processing

        // Check if the $data array has at least two elements
        if (count($data) < 2) {
            return []; // Return an empty array if there is not enough data
        }

        #Memory data loading improvement(Old version) with associative array
            // Sort the array in descending order by the values ​​of 'bid'
            // usort($data, function($a, $b) {
            //     return $b['bid'] <=> $a['bid'];
            // });

            // Check if 'bid' keys exist on the first two elements of the array
            // if (!isset($data[0]['bid']) || !isset($data[1]['bid'])) {
            //     return []; // Return an empty array if 'bid' keys are missing
            // }

            //if (!isset($data[0]['bid']) || !isset($data[1]['bid'])) {
            //    return []; // Return an empty array if 'bid' keys are missing
            //}
        #-----------------------------------------------------------------------

        usort($data, function($a, $b) {
            return $b[1] - $a[1];
        });

        // Check if 'bid' keys exist on the first two elements of the array
        if (!isset($data[0][1],$data[1][1])) {
            return []; // Return an empty array if 'bid' keys are missing
        }

        #Memory data loading improvement (Peak memory usage: 3832272 bytes)
            // $bestBid = $data[0];
            // $secondBestBid = $data[1];
        #-------------------------------- 

        $memoryAfter = memory_get_usage(); // Save used memory after processing
        $memoryPeak = memory_get_peak_usage();  // // Record the maximum used memory

        echo "Memory usage before: " . $memoryBefore . " bytes\n";
        echo "Memory usage after: " . $memoryAfter . " bytes\n";
        echo "Peak memory usage: " . $memoryPeak . " bytes\n";
        echo "StandardBidAuctionController------------------------------------------\n";

        #(Peak memory usage: 3831744 bytes)
        return [$data[0], $data[1]];

        #(Peak memory usage: 3832272 bytes)
        #return [$bestBid, $secondBestBid];
    }
}