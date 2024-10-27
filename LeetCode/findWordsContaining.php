<?php 
    $hashTable = [];
    $words = ["leet","code"];
    $char = "e";

    // for ($i=0; $i < count($words) ; $i++) { 
    //     for ($x=0; $x < strlen($words[$i]) ; $x++) { 
    //         if($words[$i][$x] === $char) {
    //             $hashTable[]=$i;
    //             break;
    //         }
    //     }
    // }

    $hashTable=[];

    for ($i=0; $i < count($words) ; $i++) { 
       if(str_contains($words[$i],$char)) {
            $hashTable[]=$i;
       }
    }
    return $hashTable;    
?>