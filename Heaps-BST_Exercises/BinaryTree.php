<?php

class Node {
    public $data;
    public $left;
    public $right;
    public $parent;
    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

class BinaryTree {
    public $root;

    public function __construct($root) {
        $this->root = new Node($root);
    }

    // Insert elements in tree
    public function insert($root, $data) {
        if($root === null) {
            $this->root = new Node($data);
            return $root;
        }

        $queue = [];
        array_push($queue, $root);

        while(count($queue) > 0) {
            $temp = array_shift($queue);
            
            if($temp->left === null) { 
                $temp->left = new Node($data);
                break;
            }

            if($temp->right === null) {
                $temp->right = new Node($data);
                break;
            }

            array_push($queue, $temp->left);
            array_push($queue, $temp->right);
        }
        return ;
    }

    // gets the value of a node
    public function preorderTraversal($root, $value){
        if ($root === null) {
            return ;
        }

        echo $root->data . "\n";

        if($root->data === $value) {
            return "Node is found => " . $root->data . "\n";
        }

        // Recur on the left subtree
        return $this->preorderTraversal($root->left, $value);

        // Recur on the right subtree
        return $this->preorderTraversal($root->right, $value);
    }

    // returns the tree as a string - each inner level is idented with the requested number of spaces as padding
    public function AsIndentedPreOrder($root, $level = 0){
        if ($root === null) {
            return ;
        }

        echo str_repeat(' ', $level) . $root->data . "\n";

        // Recur on the left subtree
        $this->AsIndentedPreOrder($root->left, $level+1);

        // Recur on the right subtree
        $this->AsIndentedPreOrder($root->right, $level+1);
    }

    public function inorderTraversal($root) {
        if (!$root)
            return;
        $this->inorderTraversal($root->left);
        echo $root->data;
        $this->inorderTraversal($root->right);
    }

    public function postorderTraversal($root) {
        if ($root === null)
            return;
        $this->postorderTraversal($root->left);
        $this->postorderTraversal($root->right);
        echo $root->data;
    }

    public function ForEachInOrder($root){
        if (!$root)
            return;
        $this->ForEachInOrder($root->left);
        echo $this->incrementData($root);
        $this->ForEachInOrder($root->right);
    }

    private function incrementData(&$node) {
        return $node->data + 1;
    }
}

$tree = new BinaryTree(0);
$tree->insert($tree->root, 1);
$tree->insert($tree->root, 2);
$tree->insert($tree->root, 3);
$tree->insert($tree->root, 4);
$tree->insert($tree->root, 5);
$tree->insert($tree->root, 6);
$tree->insert($tree->root, 7);
// echo  $tree->preorderTraversal($tree->root, 7);
// $tree->AsIndentedPreOrder($tree->root);
// $tree->inorderTraversal($tree->root);
// $tree->postorderTraversal($tree->root);
$tree->ForEachInOrder($tree->root);