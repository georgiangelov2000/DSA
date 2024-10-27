<?php 
$accounts = [[1,2,3],[3,2,1]];
$maxWealth = 0;

for($i = 0; $i < count($accounts); $i++) {
    $localWealth = 0;
    for($j = 0; $j < count($accounts[$i]); $j++) {
        $localWealth += $accounts[$i][$j];
    }
    if($localWealth > $maxWealth) {
        $maxWealth = $localWealth;
    }
}
return $maxWealth;
?>