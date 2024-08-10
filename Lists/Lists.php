<?php

interface ListInterface {
    public function insert($index,$value);
    public function delete($index);
    public function clear();
    public function set($index,$value);
    public function get($index);
    public function size();
    public function isEmpty();
    public function contains($value);
    public function indexOf($value);
    public function add($index);
};

class ListElement implements ListInterface{
    private $list;
    
    public function __construct() {
        $this->list = array();
    }

    public function insert($index,$value) {
        if($index < 0 || $index > $this->size()) {
            return -1;
        }
        array_splice($this->list, $index, 0, $value);
    }

    public function clear() {
        $this->list = array();
    }

    public function set($index,$value){
        if($this->size() <= 0 || $index >= $this->size()) {
            return -1;
        }
        $this->list[$index] = $value;
    }

    public function get($index){
        if($this->size() <= 0 || $index >= $this->size()) {
            return -1;
        }
        return $this->list[$index];
    }

    public function size(){
        return count($this->list);
    }

    public function isEmpty(){
        return $this->size() == 0;
    }

    public function contains($value){
        return in_array($value, $this->list);
    }

    public function delete($index) {
        if($this->size() <= 0 || $index >= $this->size()) {
            return -1;
        }
        array_splice($this->list, $index, 1);
    }

    public function indexOf($value) {
        
        $el = array_search($value, $this->list);
        return $el === false? -1 : $el;  // return -1 if not found
    }

    public function add ($value) {
        array_push($this->list, $value);
    }
}

$list = new ListElement();
$list->add('Item 0');
$list->insert(1,'Item 1');
$list->insert(2,'Item 2');
$list->insert(3,'Item 3');
$list->insert(4,'Item 4');
$list->insert(3,'Item 10');

$list->delete(1);
$list->set(2,'New Item 2');
echo $list->get(2);
echo "\n";
echo $list->contains('Item 2');
echo "\n";
echo $list->indexOf('Item 3');
echo "\n";