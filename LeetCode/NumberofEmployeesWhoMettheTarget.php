<?php 
$hours = [0,1,2,3,4];
$target = 2;

$count = 0;
foreach ($hours as $key => $el) {
    if($el >= $target) {
        $count ++;
    }
}
return $count;

?>