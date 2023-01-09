<?php

class Furniture extends Product implements ProductInterface
{
    public function __construct(int $id, string $sku, string $name, int $price,
        $size
    ) {
        $size = $this->setSize($size);

        parent::__construct($id, $sku, $name, $price, $size);
    }

    public function getSize()
    {
        return json_decode($this->size, true);
    }

    // Return Size for furniture as an array with it's dimensions
    public function formatSize()
    {
        $size = $this->getSize();

        return $size['width'] . ' W ' . $size['height'] . ' H ' . $size['length'] . ' L ';
    }

    private function setSize($size)
    {
        return json_encode($size);
    }
}