<?php 

function factorial($n) {
    echo $n . "\n";
    if ($n === 0) { // базов случай
        return 1;
    }
    return $n * factorial($n - 1); // рекурсивен случай
}

echo factorial(5); // Извежда 120