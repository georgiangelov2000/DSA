<?php

class Node {
    public $value;
    public $left;
    public $right;
    
    public function __construct($value) {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }
}

class BinarySearchTree {
    public $root;
    public $count;
    public $smallerThanCount;

    public function __construct($root) {
        $this->root = new Node($root);
        $this->count = 1;
        $this->smallerThanCount = 0;
    }

    public function insert($root, $value){
        if($root == null){
            $root = new Node($value);
            $this->count++;
            return $root;
        }
        if($value < $root->value){
            $root->left = $this->insert($root->left, $value);
        } else {
            $root->right = $this->insert($root->right, $value);
        }
        return $root;
    }

    public function contains($root,$val) {
        if($root === null) {
            echo "Value: {$val} is  not found \n";
            return false;
        }

        if($root->data === $val) {
            echo "Value: {$root->data} is found \n";
            return true;
        }

        if($root->data > $val) {
            return $this->contains($root->left, $val);
        } else {
            return $this->contains($root->right, $val);
        }

    }

    public function bs($root,$val) {
        if($root === null) {
            return null;
        }

        if($root->data === $val) {
            return $root->data;
        }

        if($root->data > $val) {
            return $this->bs($root->left, $val);
        } else {
            return $this->bs($root->right, $val);
        }
    }

    public function ForEachInOrder($root){
        if (!$root)
            return;
        $this->ForEachInOrder($root->left);
        echo $this->incrementData($root);
        $this->ForEachInOrder($root->right);
    }

    public function range(){}

    public function deleteMin($root){
        if(!$root || !$root->left) {
            return;
        }

        $this->leftTraversal($root->left);
    }

    public function deleteMax($root){
        if(!$root || !$root->right) {
            return;
        }  
        $this->RightTraversal($root->right);
    }

    public function count() {
        echo $this->count;
    }

    public function rank($root,$val, $smallerThanCount = 0) {
        $this->rankRecursive($root,$val);
        return $smallerThanCount;
    }

    public function rankRecursive($root,$val){
        if(!$root) {
            return;
        }
        if($root && $root->value < $val) {
            $this->smallerThanCount +=1;
        }
        $this->rankRecursive($root->left,$val,$this->smallerThanCount);
        $this->rankRecursive($root->right,$val,$this->smallerThanCount);
    }

    private function rightTraversal($root) {
        if(!$root->right) {
            $root = null;
            $this->count --;
            return;
        }
        $root->right = $this->rightTraversal($root->right);
    }

    private function leftTraversal($root) {
        if(!$root->left) {
            $root = null;
            $this->count --;
            return;
        }
        $root->left = $this->leftTraversal($root->left);
    }

    private function incrementData(&$node) {
        return $node->data + 1;
    }
    
}

$bst = new BinarySearchTree(10);
$bst->insert($bst->root, 5);
$bst->insert($bst->root, 20);
$bst->insert($bst->root, 3);
$bst->insert($bst->root, 7);
$bst->insert($bst->root, 19);
$bst->insert($bst->root, 25);
//$bst->deleteMin($bst->root);
//$bst->deleteMax($bst->root);
//$bst->count($bst->root);
echo $bst->rank($bst->root,20);