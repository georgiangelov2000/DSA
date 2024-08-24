<?php 

class Map {
    private $elements = [];

    public function get($key) {
        if ($this->contains($key)) {
            return $this->elements[$key];
        }
        return null;
    }

    public function set($key, $value) {
        $this->elements[$key] = $value;
    }

    public function delete($key) {
        if ($this->contains($key)) {
            unset($this->elements[$key]);
        }
    }

    public function contains($key) {
        return isset($this->elements[$key]);
    }

    public function clear() {
        $this->elements = [];
    }

    public function size() {
        return count($this->elements);
    }

    public function isEmpty() {
        return empty($this->elements);
    }

    public function keys() {
        return array_keys($this->elements);
    }
}

$map = new Map();

// Добавяне на ключове и стойности
$map->set('key1', 'value1');
$map->set('key2', 'value2');