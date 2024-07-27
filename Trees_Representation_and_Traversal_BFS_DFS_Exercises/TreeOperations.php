<?php

class Node {
    public $value;
    public $children;
    public $parent;
    
    public function __construct($value) {
        $this->value = $value;
        $this->parent = null;
        $this->children = [];
    }

    public function add($node) {
        $this->children[]=$node;
        $node->parent = $this;
    }

    public function addSpecificPosition($key, $newNode) {
        $this->children[$key]->children[]= $newNode;
    }

    public function findNode($node) {
        $targetNode = $this->bfs($node);
        if($targetNode === null) {
            $this->children[] = $targetNode;
        }
        return $targetNode;
    }

    public function bfs($val){
        $queue = [];
        $this->enqueue($queue, $this);

        while (!empty($queue)) {
            $current = array_shift($queue);

            echo "{$current->value} \n";

            if ($current->value === $val) {
                return $current;
            }

            foreach ($current->children as $key => $node) {
                $this->enqueue($queue,$node);
            }
        }

        return null;
    }
    
    public function enqueue(&$queue, $item) {
        $queue[] = $item;  // Добавяме елемент в края на опашката
        // echo "{$item->value} \n";
        // print_r($queue);
        return $queue;
    }

    public function treeAsStringDFSrecursively($node, $level = 0){
        echo str_repeat(' ', $level) . $node->value . "\n";
        foreach ($node->children as $neighbor) {
            $this->treeAsStringDFSrecursively($neighbor, $level + 1);
        }
    }

    public function leafNodes($node, &$leaves = []) {
        // Base case: If the node is a leaf, print its value
        if (empty($node->children)) {
            #echo $node->value . "\n";
            $leaves[]=$node->value;
            return;
        }

        // Recursively call leafNodes for each child
        foreach ($node->children as $child) {
            $this->leafNodes($child, $leaves);
        }
    }

    public function printLeafNodesInAscendingOrder() {
        $leaves = [];
        $this->leafNodes($this, $leaves);
        sort($leaves);

        foreach ($leaves as $leaf) {
            echo $leaf . "\n";
        }
    }

    public function deepestNode() {
        $deepest = null;
        $maxDepth = -1;
        $this->findDeepestNode($this, 0, $deepest, $maxDepth);
        
        if ($deepest !== null) {
            echo "Deepest node value: " . $deepest->value . "\n";
            echo "Deepest node depth: " . $maxDepth . "\n";
        } else {
            echo "Tree is empty.\n";
        }
    }

    private function findDeepestNode($node, $depth, &$deepest, &$maxDepth) {
        if ($node === null) {
            return;
        }

        if ($depth > $maxDepth) {
            $deepest = $node;
            $maxDepth = $depth;
        }

        foreach ($node->children as $child) {
            $this->findDeepestNode($child, $depth + 1, $deepest, $maxDepth);
        }
    }

    public function longestPath() {
        $maxLength = 0;
        $currentLength = 0;
        $currentSide = [];
        $origSide = [];

        $this->findLongestPath($this, $currentLength, $currentSide, $origSide, $maxLength);

        echo "Longest path: " . implode(' -> ', $origSide) . "\n";
    }

    private function findLongestPath($node, $currentLength, $currentSide, &$origSide, &$maxLength) {
        $currentSide[]=$node->value;
        if($currentLength > $maxLength) {
            $maxLength = $currentLength;
            $origSide = $currentSide;
        }
        foreach ($node->children as $child) {
            $this->findLongestPath($child, $currentLength + 1, $currentSide, $origSide, $maxLength);
        }
    }

    public function givenSum() {
        $leftSum = $this->findLeftMostSum($this, 0);
        $rightSum = $this->findRightMostSum($this, 0);
        echo "Left sum $leftSum \nRight sum $rightSum\n";
    }

    private function findLeftMostSum($node, $sum) {
        if ($node === null) {
            return $sum;
        }

        // Add the current node's value to the sum
        $sum += $node->value;

        // Recursively call findLeftMostSum for the leftmost child if it exists
        if (!empty($node->children)) {
            return $this->findLeftMostSum($node->children[0], $sum);
        }

        return $sum;
    }

    private function findRightMostSum($node, $sum) {
        if ($node === null) {
            return $sum;
        }

        // Add the current node's value to the sum
        $sum += $node->value;

        // Recursively call findLeftMostSum for the leftmost child if it exists
        if (!empty($node->children)) {
            return $this->findRightMostSum(end($node->children), $sum);
        }

        return $sum;
    }

    public function SubtreesGivenSum($node, $sum){
        if ($node === null) {
            return $sum;
        }
        $sum += $node->value;
        foreach ($node->children as $key => $child) {
            $sum += $child->value;
        }

        return $sum;
    }
}

//7
$node = new Node(7);

$child1 = new Node(19);
$child2 = new Node(21);
$child3 = new Node(14);

//7; children: 19/21/14;
$node->add($child1);
$node->add($child2);
$node->add($child3);

$grandChild4 = new Node(1);
$grandChild5 = new Node(12);
$grandChild6 = new Node(31);

$grandChild7 = new Node(23);
$grandChild8 = new Node(6);

//19; children:1/12/31
$child1->add($grandChild4);
$child1->add($grandChild5);
$child1->add($grandChild6);

//14; children:23/6
$child3->add($grandChild7);
$child3->add($grandChild8);

//$node->findNode(6);

// Print the entire tree
//echo "Tree Structure:\n";
//$root->treeAsStringDFSRecursively($root);

// Print only the leaf nodes in ascending order
//echo "\nLeaf Nodes in Ascending Order:\n";
//$node->printLeafNodesInAscendingOrder();

// Middle nodes
// echo "\nMiddle Nodes:\n";
// $node->middleNotes();


// Deepest node
//echo "\nDeepest Node:\n";
// $node->deepestNode();


// Longest path
//echo "\nLongest Path:\n";
//$node->longestPath();


// Sum of all nodes
//echo "\nSum of All Nodes:\n";
// $node->givenSum();


// Subtrees with given sum
echo "\nSubtrees with Sum :\n";
echo " " . $node->SubtreesGivenSum($child1, 0);
echo " " . $node->SubtreesGivenSum($child3, 0);