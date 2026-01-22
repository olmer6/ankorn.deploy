<?php

class logArray
{
    private static ?self $instance = null;
    public array $data = [];
    // Приватный конструктор
    private function __construct() {}
    // Запрещаем клонирование
    private function __clone() {}
    // Единственный способ получить экземпляр
    public static function getLogArray(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function add($value): void
    {
        $this->data[] = $value;
    }
    public function getData(): array
    {
        return $this->data;
    }
}