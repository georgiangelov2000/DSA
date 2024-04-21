<?php
declare(strict_types=1);

namespace App\Interface;

/**
 * Interface for classes that perform bid auctions and find the best bid.
 */
interface BidAuction
{
    /**
     * Finds the best bid among the given data.
     *
     * @param array $data The data containing bids.
     * @return array An array containing the best bid and the second best bid.
     */
    public function findBestBid(array $data): array;
}