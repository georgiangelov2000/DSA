<?php
// // First Example
// class Queue {
//     private $queue;
//     private $size;

//     public function __construct() {
//         $this->queue = array();
//         $this->size = 0;
//     }

//     public function enqueue($element) {
//         $this->queue[$this->size++] = $element;
//     }

//     public function dequeue() {
//         if ($this->isEmpty()) {
//             return "Опашката е празна";
//         }
//         $element = $this->queue[0];
//         for ($i = 0; $i < $this->size - 1; $i++) {
//             $this->queue[$i] = $this->queue[$i + 1];
//         }
//         unset($this->queue[--$this->size]);
//         return $element;
//     }

//     public function peek() {
//         if ($this->isEmpty()) {
//             return "Опашката е празна";
//         }
//         return $this->queue[0];
//     }

//     public function isEmpty() {
//         return $this->size == 0;
//     }

//     public function display() {
//         for ($i = 0; $i < $this->size; $i++) {
//             echo $this->queue[$i] . " ";
//         }
//         echo "\n";
//     }
// }

// $queue = new Queue();

// $queue->enqueue(1);
// $queue->enqueue(2);
// $queue->enqueue(3);

// echo "Елементите в опашката: ";
// $queue->display();

// echo "Първият елемент е: " . $queue->peek() . "\n";

// echo "Изваден елемент: " . $queue->dequeue() . "\n";
// echo "Изваден елемент: " . $queue->dequeue() . "\n";

// echo "Елементите в опашката след изваждане: ";
// $queue->display();

// // Second example

// class Queue {
//     private $elements = array();

//     public function enqueue($element) {
//         array_push($this->elements, $element);
//     }

//     public function dequeue() {
//         if (!$this->isEmpty()) {
//             return array_shift($this->elements);
//         } else {
//             throw new UnderflowException("Опашката е празна.");
//         }
//     }

//     public function isEmpty() {
//         return empty($this->elements);
//     }

//     public function size() {
//         return count($this->elements);
//     }

//     public function peek() {
//         if (!$this->isEmpty()) {
//             return $this->elements[0];
//         } else {
//             throw new UnderflowException("Опашката е празна.");
//         }
//     }
// }

// $queue = new Queue();

// $queue->enqueue("Първи елемент");
// $queue->enqueue("Втори елемент");
// $queue->enqueue("Трети елемент");

// echo "Първи елемент: " . $queue->dequeue() . "\n";
// echo "Втори елемент: " . $queue->dequeue() . "\n";
// echo "Трети елемент: " . $queue->dequeue() . "\n";

// try {
//     $queue->dequeue();
// } catch (UnderflowException $e) {
//     echo $e->getMessage() . "\n";
// }

// Third example

// class Queue {
//     private $queue;
//     private $front;
//     private $rear;
//     private $size;

//     public function __construct() {
//         $this->queue = array();
//         $this->front = 0;
//         $this->rear = 0;
//         $this->size = 0;
//     }

//     public function enqueue($element) {
//         $this->queue[$this->rear] = $element;
//         $this->rear++;
//         $this->size++;
//     }

//     public function dequeue() {
//         if ($this->isEmpty()) {
//             return "Опашката е празна";
//         }

//         $element = $this->queue[$this->front];
//         unset($this->queue[$this->front]);
//         $this->front++;
//         $this->size--;

//         return $element;
//     }

//     public function isEmpty() {
//         return $this->size === 0;
//     }

//     public function size() {
//         return $this->size;
//     }

//     public function peek() {
//         if ($this->isEmpty()) {
//             return "Опашката е празна";
//         }
//         return $this->queue[$this->front];
//     }
// }

// $queue = new Queue();

// $queue->enqueue("Първи елемент");
// $queue->enqueue("Втори елемент");
// $queue->enqueue("Трети елемент");

// echo "Първи елемент: " . $queue->dequeue() . "\n";
// echo "Втори елемент: " . $queue->dequeue() . "\n";
// echo "Трети елемент: " . $queue->dequeue() . "\n";

// if ($queue->isEmpty()) {
//     echo "Опашката е празна\n";
// }