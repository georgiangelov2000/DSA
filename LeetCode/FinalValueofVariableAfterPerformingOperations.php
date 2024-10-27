<?php 

$inputOperations = [
    "--X","X++","X++"
];

$x = 0;
// for ($i=0; $i < count($inputOperations) ; $i++) { 
//     if($inputOperations[$i] == "--X" || $inputOperations[$i]  === 'X--') {
//         $x--;
//     } else if($inputOperations[$i] === '++X' || $inputOperations[$i] === "X++") {
//         $x++;
//     }
// }

for ($i=0; $i < count($inputOperations) ; $i++) { 
    if(str_contains($inputOperations[$i],'--')) {
        $x--;
    } else if(str_contains($inputOperations[$i],'++')) {
        $x++;
    }
}

return $x;

?>