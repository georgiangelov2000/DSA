<?php

class Node {
    public $keys = [];       // Ключовете в възела
    public $children = [];   // Децата на възела
    public $isLeaf;          // Проверка дали възелът е лист

    public function __construct($isLeaf = true) {
        $this->isLeaf = $isLeaf;
    }
}

class BTree {
    private $root;
    private $t;  // Минимална степен на B-Tree

    public function __construct($t) {
        $this->t = $t; // Минималната степен на B-Tree
        $this->root = new Node(true); // Създава коренен възел, който е лист
    }

    // Вмъкване на ключ в B-Tree
    public function insert($key) {
        $root = $this->root;
        $res = (2 * $this->t - 1);
        // Ако коренният възел е пълен
        if (count($root->keys) == (2 * $this->t - 1)) {
            $s = new Node(false); // Нов възел, който не е лист
            $this->root = $s;
            $s->children[] = $root;
            $this->splitChild($s, 0);
            $this->insertNonFull($s, $key);
        } else {
            $this->insertNonFull($root, $key);
        }
    }

    // Вмъкване на ключ в възел, който не е пълен
    private function insertNonFull($node, $key) {
        $i = count($node->keys) - 1;

        if ($node->isLeaf) {
            // Намира правилната позиция за новия ключ
            while ($i >= 0 && $key < $node->keys[$i]) {
                $i--;
            }
            array_splice($node->keys, $i + 1, 0, $key);
        } else {
            // Намира правилното дете
            while ($i >= 0 && $key < $node->keys[$i]) {
                $i--;
            }
            $i++;
            if (count($node->children[$i]->keys) == (2 * $this->t - 1)) {
                $this->splitChild($node, $i);
                if ($key > $node->keys[$i]) {
                    $i++;
                }
            }
            $this->insertNonFull($node->children[$i], $key);
        }
    }

    // Разделя дете на възел
    private function splitChild($parent, $i) {
        $t = $this->t;
        $y = $parent->children[$i];
        $z = new Node($y->isLeaf);
        $parent->children[$i] = $y;
        $parent->children[] = $z;
        $parent->keys[] = null;
        
        // Прехвърля ключове и деца на новия възел
        for ($j = $t - 1; $j < count($y->keys); $j++) {
            $z->keys[] = $y->keys[$t + $j];
        }
        if (!$y->isLeaf) {
            for ($j = $t; $j < count($y->children); $j++) {
                $z->children[] = $y->children[$t + $j];
            }
        }

        // Прехвърля средния ключ на родителския възел
        array_splice($y->keys, $t - 1);
        array_splice($y->children, $t);
        array_splice($parent->keys, $i, 0, $y->keys[$t - 1]);
    }
    
    // Търсене на ключ в B-Tree
    public function search($key) {
        return $this->searchRecursive($this->root, $key);
    }

    // Рекурсивно търсене на ключ
    private function searchRecursive($node, $key) {
        $i = 0;
        while ($i < count($node->keys) && $key > $node->keys[$i]) {
            $i++;
        }
        
        if ($i < count($node->keys) && $node->keys[$i] == $key) {
            return true;
        }
        
        if ($node->isLeaf) {
            return false;
        }
        
        return $this->searchRecursive($node->children[$i], $key);
    }
}

$btree = new BTree(2);  // Създава B-Tree с ред 2

$btree->insert(10);
$btree->insert(20);
$btree->insert(5);
$btree->insert(6);