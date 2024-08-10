<?php

class BlockingQueue {
    private $queue = [];
    private $maxSize;
    private $lock;

    public function __construct($maxSize = PHP_INT_MAX) {
        $this->maxSize = $maxSize;
        $this->lock = fopen(__FILE__, 'r'); // Използване на файлово заключване за синхронизация
    }

    public function enqueue($item) {
        while (true) {
            flock($this->lock, LOCK_EX); // Заключване за запис
            if (count($this->queue) < $this->maxSize) {
                array_push($this->queue, $item);
                flock($this->lock, LOCK_UN); // Освобождаване на заключването
                return;
            }
            flock($this->lock, LOCK_UN); // Освобождаване на заключването
            usleep(100000); // Задържане за 100ms, преди да проверим отново
        }
    }

    public function dequeue() {
        while (true) {
            flock($this->lock, LOCK_EX); // Заключване за запис
            if (!empty($this->queue)) {
                $item = array_shift($this->queue);
                flock($this->lock, LOCK_UN); // Освобождаване на заключването
                return $item;
            }
            flock($this->lock, LOCK_UN); // Освобождаване на заключването
            usleep(100000); // Задържане за 100ms, преди да проверим отново
        }
    }

    public function size() {
        flock($this->lock, LOCK_SH); // Заключване за четене
        $size = count($this->queue);
        flock($this->lock, LOCK_UN); // Освобождаване на заключването
        return $size;
    }

    public function isEmpty() {
        flock($this->lock, LOCK_SH); // Заключване за четене
        $isEmpty = empty($this->queue);
        flock($this->lock, LOCK_UN); // Освобождаване на заключването
        return $isEmpty;
    }
}

// Пример за използване на BlockingQueue
$queue = new BlockingQueue(5);

// Добавяне на елементи в опашката (симулирано)
for ($i = 0; $i < 10; $i++) {
    $queue->enqueue("Item $i");
    echo "Produced: Item $i\n";
    usleep(50000); // Задържане за 50ms
}

// Премахване на елементи от опашката (симулирано)
for ($i = 0; $i < 10; $i++) {
    $item = $queue->dequeue();
    echo "Consumed: $item\n";
    usleep(100000); // Задържане за 100ms
}
?>