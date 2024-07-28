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

    public function inorderTraversal($node) {
        if($node === null) {
            return;
        }

        $this->inorderTraversal($node->left);
        echo $node->data . " ";
        $this->inorderTraversal($node->right);
        
    }

    public function preOrderTraversal($node) {
        if($node === null) {
            return;
        }
        echo $node->data . " ";
        $this->preOrderTraversal($node->left);
        $this->preOrderTraversal($node->right);
    }

    public function postOrderTraversal($node) {
        if($node === null) {
            return;
        }
        $this->postOrderTraversal($node->left);
        $this->postOrderTraversal($node->right);
        echo $node->data. " ";
    }
}

$tree = new BinaryTree();
$tree->root = new Node(0);
$tree->root->left = new Node(1);
$tree->root->right = new Node(2);

$tree->root->left->left = new Node(3);
$tree->root->left->right = new Node(4);

$tree->root->right->left = new Node(5);
$tree->root->right->right = new Node(6);

// $tree->inorderTraversal($tree->root);
// $tree->preOrderTraversal($tree->root);
$tree->postOrderTraversal($tree->root);