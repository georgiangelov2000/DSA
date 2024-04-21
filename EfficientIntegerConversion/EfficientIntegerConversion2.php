<?php

/**
 * Checks if a condition is true for the given number.
 * The condition evaluates whether the number is at a 'critical point' where the decrement
 * will lead to a smaller number than incrementing. 
 *
 * @param int $n The number to check the condition for.
 * @return bool True if the condition is true, false otherwise.
 */
function isConditionTrue(int $n): bool {
    // At a 'critical point' if $n is divisible by 4 or $n is 3
    return $n % 4 == 0 || $n == 3;
}

/**
 * Solves the given task with the modified condition.
 *
 * @param int $n The initial number.
 * @return int The number of steps required to reach 1.
 */
function solution($n) {
    $steps = 0; // Reset step counter

    while ($n != 1) { // Repeat until the number becomes 1
        echo "Step -> $steps : Number -> $n \n";

        if ($n % 2 == 0) { // If the number is even
            $n /= 2; // Divide it by 2
        } 
        elseif (isConditionTrue($n)) { // If the number is odd and the condition is true
            $n--; // Subtract 1
        } 
        else {
            $n++; // Add 1
        }
        $steps++; // Increment step counter
    }
    return $steps; // Return the number of steps
}

// Check if a command line argument is provided
if ($argc < 2 || !is_numeric($argv[1])) {
    echo "Usage: php index.php <number>\n";
    exit(1);
}

// Get the number from command line argument
$number = intval($argv[1]);


echo "Number of steps: " . solution($number) . "\n";