<?php

class DVD extends Product implements ProductInterface
{
    public function __construct(int $id, string $sku, string $name, int $price, string $size)
    {
        parent::__construct($id, $sku, $name, $price, $size);
    }

    // Return size for DVDs in MB
    public function formatSize(): string
    {
        $size = $this->getSize();

        return $size . ' MB';
    }
}