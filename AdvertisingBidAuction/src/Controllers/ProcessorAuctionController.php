<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Factory\DataReaderFactory;
use App\Interface\BidAuction;
use App\Controllers\StandardBidAuctionController;

/**
 * Constructor for ProcessorAuctionController.
 *
 * @param StandardBidAuctionController $bidAuction The service handling bid auctions.
 * @param string $type The type of data reader to be used.
 */
class ProcessorAuctionController
{
    private StandardBidAuctionController $bidAuction;
    private string $type;

    public function __construct(
        StandardBidAuctionController $bidAuction,
        string $type
    )
    {
        $this->bidAuction = $bidAuction;
        $this->type = $type;
    }

    /**
     * Get the best bid from the given file.
     *
     * @param string $filename The path to the file containing bid data.
     * @return array An array containing the best and second best bid.
     */
    public function getBestBid(string $filename): array {
        // Create a data reader using the factory
        $dataReaderFactory = new DataReaderFactory();
        $dataReader = $dataReaderFactory->createDataReader($this->type);
        // Read data from the file
        $data = $dataReader->readData($filename);
        // Find the best bid using the bid auction service
        return $this->bidAuction->findBestBid($data);
    }
}