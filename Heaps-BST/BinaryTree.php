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

    // function to delete the given deepest node
    public function deleteDeepest($root, $d_node) {
        $q = [];
        array_push($q, $root);
    
        // Do level order traversal until last node
        while (!empty($q)) {
            $temp = array_shift($q);
    
            if ($temp === $d_node) {
                $temp = null;
                unset($d_node);
                return;
            }
    
            if ($temp->right !== null) {
                if ($temp->right === $d_node) {
                    $temp->right = null;
                    unset($d_node);
                    return;
                } else {
                    array_push($q, $temp->right);
                }
            }
    
            if ($temp->left !== null) {
                if ($temp->left === $d_node) {
                    $temp->left = null;
                    unset($d_node);
                    return;
                } else {
                    array_push($q, $temp->left);
                }
            }
        }
    }
    
    function deletion($root, $key) {
        if ($root === null)
            return null;
    
        if ($root->left === null && $root->right === null) {
            if ($root->data === $key)
                return null;
            else
                return $root;
        }
    
        $q = [];
        array_push($q, $root);
        $temp = null;
        $key_node = null;
    
        // Do level order traversal to find deepest
        // node (temp) and node to be deleted (key_node)
        while (!empty($q)) {
            $temp = array_shift($q);
    
            if ($temp->data === $key)
                $key_node = $temp;
    
            if ($temp->left !== null)
                array_push($q, $temp->left);
    
            if ($temp->right !== null)
                array_push($q, $temp->right);
        }
    
        if ($key_node !== null) {
            $x = $temp->data;
            $key_node->data = $x;
            $this->deleteDeepest($root, $temp);
        }
    
        return $root;
    }

    // Inorder tree traversal (Left - Root - Right)
    public function inorderTraversal($root) {
        if (!$root)
            return;
        $this->inorderTraversal($root->left);
        echo $root->data;
        $this->inorderTraversal($root->right);
    }

    // Preorder tree traversal (Root - Left - Right)
    public function preorderTraversal($root) {
        if (!$root)
            return;
        echo $root->data;
        $this->preorderTraversal($root->left);
        $this->preorderTraversal($root->right);
    }

    // Postorder tree traversal (Left - Right - Root)
    public function postorderTraversal($root) {
        if ($root === null)
            return;
        $this->postorderTraversal($root->left);
        $this->postorderTraversal($root->right);
        echo $root->data;
    }

    // Function for Level order tree traversal
    public function levelorderTraversal($root) {
        if ($root === null)
            return;

        // Queue for level order traversal
        $q = [];
        array_push($queue,$root);
        while (count($q) !== 0) {
            $temp = array_shift($q);
            echo $temp->data + " ";
            // Push left child in the queue
            if ($temp->left)
               array_push($q,$temp->left);
            // Push right child in the queue
            if ($temp->right)
               array_push($q,$temp->right);
        }
    }
}

$tree = new BinaryTree();
$tree->root = new Node(0);
$tree->insert($tree->root,1);
$tree->insert($tree->root,2);
$tree->insert($tree->root,3);
$tree->insert($tree->root,4);
$tree->insert($tree->root,5);
// $tree->deletion($tree->root,5);

// Manually building of BINARY TREE
// $tree->root = new Node(0);
// $tree->root->left = new Node(1);
// $tree->root->right = new Node(2);

// $tree->root->left->left = new Node(3);
// $tree->root->left->right = new Node(4);

// $tree->root->right->left = new Node(5);
// $tree->root->right->right = new Node(6);

echo "Preorder traversal: ";
$tree->preorderTraversal($tree->root);

echo "\nInorder traversal: ";
$tree->inorderTraversal($tree->root);

echo "\nPostorder traversal: ";
$tree->postorderTraversal($tree->root);

echo "\nLevel order traversal: ";
$tree->levelorderTraversal($tree->root);