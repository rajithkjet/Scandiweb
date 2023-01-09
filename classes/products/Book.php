<?php

class Book extends Product implements ProductInterface
{
    public function __construct(int $id, string $sku, string $name, int $price, string $size)
    {
        parent::__construct($id, $sku, $name, $price, $size);
    }

    // Return Size for books in KG
    public function formatSize(): string
    {
        $size = $this->getSize();

        return $size . ' KG';
    }
}