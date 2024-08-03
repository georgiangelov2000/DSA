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
        $this->parent = null;
    }
}

class BinarySearchTree
{
    public $root;

    public function __construct($root) {
        $this->root = new Node($root);
    }

    public function insert($root, $val){
        if($root === null) {
            $root = new Node($val);
            $root->parent = $this->root;
            return $root;
        }

        if($root->data === $val) {
            echo $root->data  . " already exists"; 
            return;
        }

        if($root->data > $val) {
           $root->left = $this->insert($root->left,$val);
        } else {
           $root->right = $this->insert($root->right, $val);
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

    public function getRoot(){
        return $this->root;
    }

    public function getRootValue() {
        if ($this->root === null) {
            return null; 
        }
        return $this->root->data;
    }

    public function inOrderTraversal($node) {
        if ($node === null) {
            return;
        }

        // Обход в лявото поддърво
        $this->inOrderTraversal($node->left);
        
        // Отпечатване на стойността на текущия възел
        echo $node->data . "\n";
        
        // Обход в дясното поддърво
        $this->inOrderTraversal($node->right);
    }

    public function getLeft($root) {
        if ($root === null) {
            return null;
        }
        return $root->left;
    }

    public function getRight($root) {
        if ($root === null) {
            return null;
        }
        return $root->right;
    }
}

// Insert a new node with given key in BST
$bst = new BinarySearchTree(10);
$bst->insert($bst->root, 5);
$bst->insert($bst->root, 20);
$bst->insert($bst->root, 3);
$bst->insert($bst->root, 7);
$bst->insert($bst->root, 19);
$bst->insert($bst->root, 25);
// $bst->contains($bst->root,66666);
// echo $bst->bs($bst->root,5);
$leftSubtree = $bst->getLeft($bst->root);
if ($leftSubtree !== null) {
    echo "In-order traversal of the left subtree:\n";
    $bst->inOrderTraversal($leftSubtree);
} else {
    echo "There is no left subtree of the root.\n";
}

$rightSubtree = $bst->getRight($bst->root);
if ($rightSubtree !== null) {
    echo "In-order traversal of the right subtree:\n";
    $bst->inOrderTraversal($rightSubtree);
} else {
    echo "There is no right subtree of the root.\n";
}
$bst->getRoot();
echo $bst->getRootValue();