<?php

class Node 
{
  public $key;
  public $left;
  public $right;

  public function __construct($key) {
    $this->key = $key;
    $this->left = null;
    $this->right = null;
  }

  // function to search a key in a BST
    public function search($root, $key) {
        if ($root == null || $root->key === $key) {
            return $root;
        }

        // Key is greater than root's key
        if($root->key < $key) {
            return $this->search($root->right, $key);
        }

        // Key is smaller than root's key
        return $this->search($root->left, $key);
    }

    // If the tree is empty, return a new node
    public function insert($root, $key){
        if($root == null){
            $root = new Node($key);
            return $root;
        }

        if($root->key == $key) {
            return $root;
        }

        if($root->key < $key) {
            $root->right = $this->insert($root->right, $key);
        } else {
            $root->left = $this->insert($root->left, $key);
        }

        return $root;
    }

    // This function deletes a given key x from the 
    // given BST  and returns the modified root of 
    // the BST (if it is modified).
    public function delete($root,$x) {
        // Base case
        if($root == null) {
            return $root;
        }

        // If key to be searched is in a subtree
        if($root->key > $x) {
            $root->left = $this->delete($root->left, $x);
        } else if($root->key < $x) {
            $root->right = $this->delete($root->right, $x);
        } else {
            // If root matches with the given key

            // Cases when root has 0 children or
            // only right child
            if($root->left == null) {
                return $root->right;
            }

            // When root has only left child
            if($root->right == null) {
                return $root->left;
            }

            // When both children are present
            $succ = $this->getSuccessor($root);
            $root->key = $succ->key;
            $root->right = $this->delete($root->right, $succ->key);
        }
        return $root;
    }

    // Note that it is not a generic inorder successor 
    // function. It mainly works when the right child
    // is not empty, which is the case we need in BST
    // delete. 
    public function getSuccessor($curr) {
        $succ = $curr->right;
        while($succ != null && $succ->left!= null) {
            $succ = $succ->left;
        }
        return $succ;
    }

    public function inOrder($root) {
        if($root != null) {
            $this->inOrder($root->left);
            echo $root->key." ";
            $this->inOrder($root->right);
        }
    }
}

// $root = new Node(50);
// $root->left = new Node(30);
// $root->right = new Node(70);
// $root->left->left = new Node(20);
// $root->left->right = new Node(40);
// $root->right->left = new Node(60);
// $root->right->right = new Node(80);

// // Searching for keys in the BST
// echo $root->search($root, 19) !== null ? "Found"
//                                       : "Not Found";
// echo $root->search($root, 80) !== null ? "Found"
//                                       : "Not Found";

$root = new Node(10);
$root->insert($root,40);
$root->insert($root,60);
$root->insert($root,30);
$root->insert($root,20);
$root->insert($root,5);
$root->insert($root,6);
$root->insert($root,1);
$root->insert($root,2);
$root->delete($root, 40);
$root->inOrder($root);