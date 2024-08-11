<?php

class Stack{
    public $undoStack;
    public $redoStack;
    public $undoSize;
    public $redoSize;

    public function __construct(){
        $this->undoStack = [];
        $this->redoStack = [];
        $this->undoSize = 0;
        $this->redoSize = 0;
    }

    public function push($element)
    {
        if ($element === "UNDO") {
            return $this->undo();
        } elseif ($element === "REDO") {
            return $this->redo();
        } elseif ($element === "READ") {
            return $this->read();
        } else {
            array_push($this->undoStack, $element);
            $this->redoStack = [];
        }
    }

    private function undo()
    {
        if (empty($this->undoStack)) {
            return "Няма нищо за undo";
        }

        $element = array_pop($this->undoStack);
        array_push($this->redoStack, $element);
        return $element;
    }

    private function redo()
    {
        if (empty($this->redoStack)) {
            return "Няма нищо за redo";
        }

        $element = array_pop($this->redoStack);
        array_push($this->undoStack, $element);
        return $element;
    }

    public function read()
    {
        return $this->undoStack;
    }

    public function display()
    {
        echo "Undo Stack: " . implode(', ', $this->undoStack) . PHP_EOL;
        echo "Redo Stack: " . implode(', ', $this->redoStack) . PHP_EOL;
    }
}
$stack = new Stack();
$arr = ["WRITE A", "WRITE B", "WRITE C", "UNDO", "READ", "REDO", "READ"];
foreach ($arr as $value) {
    $stack->push($value);
}
$stack->display();