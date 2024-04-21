<?php

/**
 * Converts a number to its binary representation.
 *
 * @param int $n The number to convert.
 * @return string The binary representation of the number.
 */
function binaryRepresentation($n): string{
    return decbin($n);
}

/**
 * Checks if a condition (($n + 1) & $n) > (($n - 1) & ($n - 2)) is true.
 * This condition evaluates whether the bitwise AND operation between ($n + 1) and $n 
 * is greater than the bitwise AND operation between ($n - 1) and ($n - 2).
 *
 * @param int $n The number to check the condition for.
 * @return bool True if the condition is true, false otherwise.
 */
function isConditionTrue(int $n): bool{
    if ($n == 3) {
        return true;
    }
    
    return (($n + 1) & $n) > (($n - 1) & ($n - 2));
}

/**
 * Displays binary values for ($n + 1), (($n - 1) & ($n - 2)), etc.
 *
 * @param int $n The number to display binary values for.
 */
function showBinaryValues(int $n): void {
    $nBinary  = $n;
    $nPlusOne = $n + 1 ;
    $nMinusOne = ($n - 1);
    $nMinusTwo = ($n - 2);

    echo "Binary representation of ($n): " . binaryRepresentation($nBinary) . "\n";
    echo "Binary representation of ($n + 1): " . binaryRepresentation($nPlusOne) . "\n";
    echo "Binary representation of ($n - 1): " . binaryRepresentation($nMinusOne) . "\n";
    echo "Binary representation of ($n - 2): " . binaryRepresentation($nMinusTwo) . "\n";

    // Display the condition in binary
    echo "Binary representation of (($n + 1) & $n) > (($n - 1) & ($n - 2)): ";
    echo "(" . binaryRepresentation($nPlusOne) . " " . binaryRepresentation($nBinary) . ")";
    echo ">" . "(" . binaryRepresentation($nMinusOne) . " " . binaryRepresentation($nMinusTwo) . ")" . "\n";
}

/**
 * Solves the given task.
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
            $n--; // Subtract 1 or add 1 depending on the condition (($n + 1) & $n) > (($n - 1) & ($n - 2))
        } 
        else {
            $n++; // Subtract 1 or add 1 depending on the condition (($n + 1) & $n) > (($n - 1) & ($n - 2))
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

################################################################### Example with integer(15)

#A number is even if the least significant bit (the rightmost bit) is 0. This means that the number is divisible by 2 with no remainder.
#A number is odd if the least significant bit (right bit) is 1. This means that there is a remainder when divided by 2.

// Call the solution function and display the number of steps
echo "Number of steps: " . solution($number) . "\n";

// Display the number 15 and whether the condition is true for it
echo "Binary representation of $number: " . binaryRepresentation($number) . "\n";
echo "Is the condition true for $number? " . (isConditionTrue($number) ? "Yes" : "No") . "\n";

// Display binary values for ($n + 1) and (($n - 1) & ($n - 2))
showBinaryValues($number);

#BitWise operations  AND
#echo "\n";
#echo "   1 0 0 0 0  (16)\n";
#echo "&  0 1 1 1 1  (15)\n";
#echo "---------\n";
#echo "   0 0 0 0 0  (0)\n";
#echo "   0 1 1 1 0  (14)\n";
#echo "&  0 1 1 0 1  (13)\n";
#echo "---------\n";
#echo "   0 1 1 0 0  (12)\n";
#echo "Result of (16 & 15) = 0\n";
#echo "Result of (14 & 13) = 12\n";

#####################################################################