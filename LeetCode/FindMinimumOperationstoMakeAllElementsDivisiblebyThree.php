<?php 
$nums = [1,2,3,4];
$op = 0;
for ($i=0; $i < count($nums); $i++) { 
    if($nums[$i] % 3 !== 0 && ( ($nums[$i] + 1) % 3 == 0 || ($nums[$i] - 1) % 3 == 0) ) {
        $op++;
    }
}
return $op;
?>