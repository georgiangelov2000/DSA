<?php

namespace App\Controllers;
class Scanner 
{
    private $code;
    private $offers = [
        'RA' => ['price' => 1.50], //Малина
        'AP' => ['price' => 3.50], //Ябълка
        'WA' => ['price' => 5.00], //Диня
    ];
    private $scannedProducts = [];

    /**
     * Scans a product and adds it to the list of scanned products.
     *
     * @param string $code Product code to scan.
     * @return void
     */
    public function scann(string $code){
        $this->code = $code;
        if (array_key_exists($this->code, $this->offers)) {
            $this->scannedProducts[$this->code][] = $this->offers[$this->code];
        }
    }

    /**
     * Calculates the total price of the scanned products and displays a message about the final price.
     *
     * @return void
     */
    public function total(){
        $message = '';
        $totalPrice = 0;
        
        foreach ($this->scannedProducts as $key => $items) {
            $count = count($items);
            $message .= "($count x $key = ";
            $groupedPrice = 0;

            foreach($items as $index => $item) {
                if($key === 'RA' && $index > 2) {
                    $item['price'] = 1.00;
                } elseif ($key === 'WA' && ($index + 1) % 2 == 0 && $index > 0){
                    $item['price'] = 0.00;
                }
                $groupedPrice += $item['price'];
                $totalPrice += $item['price'];
            }

            $totalPrice = number_format($totalPrice,2,'.');

            $message .= "$groupedPrice) + ";
            $message = "" . rtrim($message, '+ ') . " = $totalPrice";
        }

        echo $message;
    }
}