<?php 
   $consistentStringsCount = 0;
   $allowed = "ab";
   $words = ["ad","bd","aaab","baa","badab"];

   for($i = 0; $i<count($words);$i++) {
    $consistent = true;
    for($j = 0; $j < strlen($words[$i]); $j++) {
        $a = $words[$i][$j];
        $b = strpos($allowed,$words[$i][$j]);
        if(strpos($allowed,$a) === false) {
            $consistent = false;
            break;
        }
    }
    if($consistent) {
        $consistentStringsCount++;
    }
   }

?>