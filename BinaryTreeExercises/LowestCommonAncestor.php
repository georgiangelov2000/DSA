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
        // If tree is empty, new node becomes the root
        if($root == null) {
            $this->root = new Node($data);
            return $root;
        }

        // queue to traverse the tree and find the position to
        // insert the node
        $queue = [];
        array_push($queue, $root);

        while(count($queue) !== 0) {
            $node = array_shift($queue);
            // Insert node as the left child of the parent node
            if($node->left == null) {
                $node->left = new Node($data);
                break;
            }

            // Insert node as the right child of the parent node
            if($node->right == null) {
                $node->right = new Node($data);
                break;
            }

            // If the parent node has both children, add the node to the queue for further processing
            array_push($queue, $node->left);
            array_push($queue, $node->right);
        }

        return $root;
    }

    public function findLCA($root,$n1,$n2) {
        if(!$root) {
            return;
        }

        if($root->data == $n1 || $root->data == $n2) {
            return $root->data;
        }

        $leftLCA = $this->findLCA($root->left, $n1, $n2);
        $rightLCA = $this->findLCA($root->right, $n1, $n2);

        if ($leftLCA && $rightLCA) {
            return $root->data;
        }

        return $leftLCA !== null ? $leftLCA : $rightLCA;
    } 
}

$tree = new BinaryTree();
$tree->root = new Node(1);
$tree->insert($tree->root,2);
$tree->insert($tree->root,3);
$tree->insert($tree->root,4);
$tree->insert($tree->root,5);
$tree->insert($tree->root,6);
$tree->insert($tree->root,7);
//echo"LCA(4, 5) = " . $tree->findLCA($tree->root,4,5);
echo"LCA(5, 6) = " . $tree->findLCA($tree->root,5,6);