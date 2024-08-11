<?php 
interface Comparator {
    public function compare ($left,$right);
}

class NumberComparator implements Comparator
{
    public function compare($a, $b): int
    {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }
}

class StringLengthComparator implements Comparator
{
    public function compare($a, $b): int
    {
        $lenA = strlen($a);
        $lenB = strlen($b);

        if ($lenA == $lenB) {
            return 0;
        }
        return ($lenA < $lenB) ? -1 : 1;
    }
}


class ReverseComparator implements Comparator
{
    private $comparator;

    public function __construct(Comparator $comparator)
    {
        $this->comparator = $comparator;
    }

    public function compare($a, $b): int
    {
        return -1 * $this->comparator->compare($a, $b);
    }
}

$numbers = [3, 2, 5, 1, 4];
$stringComparator = new NumberComparator();

usort($numbers, [$stringComparator, 'compare']);

print_r($numbers);

$strings = ["apple", "banana", "cherry", "date"];
$lengthComparator = new StringLengthComparator();

usort($strings, [$lengthComparator, 'compare']);

print_r($strings);