<?php

class Node {
    public $data;
    public $left;
    public $right;

    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

class BinaryTree {
    public $root;

    public function __construct() {
        $this->root = null;
    }

    public function insert($root,$data) {
        if($root == null) {
            $this->root = new Node($data);
            return $root;
        }

        $queue = [];
        array_push($queue, $root);

        while(count($queue) !== 0) {
            $node = array_shift($queue);

            if($node->left == null) {
                $node->left = new Node($data);
                break;
            }

            if($node->right == null) {
                $node->right = new Node($data);
                break;
            }

            array_push($queue, $node->left);
            array_push($queue, $node->right);
        }

        return $root;
    }

    public function printTop($root){
        if($root === null) {
            return;
        }
        
        $result = [];
        $queue = [];
        $queue[]=[$root,0];

        $horizontalDistanceMap = [];

        while (!empty($queue)) {
            list($node, $hd) = array_shift($queue);

            if (!isset($horizontalDistanceMap[$hd])) {
                $horizontalDistanceMap[$hd] = $node->data;
            }

            if($node->left !== null) {
                $queue[]=[$node->left ,$hd - 1];
            }
            if($node->right !== null) {
                $queue[]=[$node->right ,$hd + 1];
            }
        }
        ksort($horizontalDistanceMap);

    }
}

$tree = new BinaryTree();
$tree->insert($tree->root, 1);
$tree->insert($tree->root, 2);
$tree->insert($tree->root, 3);
$tree->insert($tree->root, 4);
$tree->insert($tree->root, 5);
$tree->insert($tree->root, 6);
$tree->insert($tree->root, 7);
$tree->printTop($tree->root);