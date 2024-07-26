<?php 
class Node {
    public $value;
    public $children;

    public function __construct($value) {
        $this->value = $value;
        $this->children = [];
    }

    public function add($node) {
        $this->children[]=$node;
    }

    public function addSpecificPosition($key, $newNode) {
        $this->children[$key]->children[]= $newNode;
    }

    public function removeNode($el) {
        $searchedNode = $this->bfs($el);
        if ($searchedNode !== null) {
            unset($this->children[$el]);
            return $this;
        }
        return null;
    }

    public function swap() {
        
    }

    public function bfs($el = null){
        $queue = [];
        $this->enqueue($queue, $this);

        while (!empty($queue)) {
            $current = array_shift($queue);

            if ($current->value === $el) {
                return $current;
            }
            
            foreach ($current->children as $key => $node) {
                $this->enqueue($queue,$node);
            }

        }
    }

    public function orderDfs($startNode){
        foreach ($startNode->children as $key => $node) {
            $this->orderDfs($node);
        }
        $stack[] = $startNode->value;
        print_r($stack);
    }

    public function enqueue(&$queue, $item) {
        $queue[] = $item;  // Добавяме елемент в края на опашката
        echo "{$item->value} \n";
        // print_r($queue);
        return $queue;
    }
    
}

$node = new Node(0);
$child1 = new Node(1);
$child2 = new Node(2);
$child3 = new Node(3);

$node->add($child1);
$node->add($child2);
$node->add($child3);

$grandChild4 = new Node(4);
$grandChild5 = new Node(5);
$grandChild6 = new Node(6);

$grandChild7 = new Node(7);
$grandChild8 = new Node(8);
$grandChild9 = new Node(9);


$child1->add($grandChild4);
$child1->add($grandChild5);

$child2->add($grandChild6);
$child2->add($grandChild7);

$child3->add($grandChild8);
$child3->add($grandChild9);



$node->bfs();
$node->orderDfs($node);

// $newNode = new Node(4);
// $node->addSpecificPosition(1,$newNode);
var_dump($node->removeNode(5));