<?php
// Node implementation
class Node {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class LinkedList {
    public $head;
    public $last;

    public function __construct($currentHead = null) {
        if($currentHead !== null) {
            $this->head = $currentHead;
        }
    }

    public function addBeginning($element){
        $newHead = new Node($element);
        $newHead->next = $this->head;
        if($this->head === null) {
            $this->last = $newHead;
        }
        $this->head = $newHead;
    }

    public function addLast($element) {
        $newLast = new Node($element);
        if($this->last === null) {
            $this->last = $newLast;
            $this->head = $newLast;
        } else {
            $this->last->next = $newLast;
            $this->last = $newLast;
        }
    }

    public function removeHead() {
        $oldHead = $this->head;
        $this->head = $oldHead->next;
        if($this->head === null) {
            $this->last = null;
        }
        return $oldHead->data;
    }
}

// $node1 = new Node(1);
// $node2 = new Node(2);
// $node3 = new Node(3);
// $node4 = new Node(4);

// $node1->next = $node2;
// $node2->next = $node3;
// $node3->next = $node4;

// $currentNode = $node1;

// $linkedList = new LinkedList($node1);
// $linkedList->add(12);

// Classic iteration of linked list
// while($currentNode !== null) {
//     echo $currentNode->data;
//     $currentNode = $currentNode->next;
// }

$linkedList = new LinkedList();
for ($i=0; $i < 3; $i++) { 
    $linkedList->addLast($i);
}
$currentNode = $linkedList->head;
while($currentNode !== null) {
    echo $currentNode->data;
    $currentNode = $currentNode->next;
}
echo "Head is: " .$linkedList->head->data;
echo "Last is: " .$linkedList->last->data;

// echo "Изтрита глава: " . $linkedList->removeHead() . "\n";
// echo "Изтрита глава: " . $linkedList->removeHead() . "\n";
// echo "Изтрита глава: " . $linkedList->removeHead() . "\n";