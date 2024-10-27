<?php 

$hashTable =  [];
$extraCandies = 3;
$candies = [2,3,5,1,3];
$max = max($candies);

for($i = 0; $i < count($candies); $i++) {
    $x = $candies[$i] + $extraCandies;
    if($x >= $max) {
        $hashTable[] = true;
    } else {
        $hashTable[] = false;
    }
}
?>