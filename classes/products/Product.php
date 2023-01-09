<?php

require_once 'ProductRepository.php';
require_once 'ProductInterface.php';
require_once 'Book.php';
require_once 'DVD.php';
require_once 'Furniture.php';

class Product
{
    public const TYPE_BOOK = 'book';
    public const TYPE_DVD = 'dvd';
    public const TYPE_FURNITURE = 'furniture';

    private $id;
    private $sku;
    private $name;
    private $price;
    protected $size;

    public function __construct(int $id, string $sku, string $name, int $price, $size)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->size = $size;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price . ' € ';
    }

    public function getSize()
    {
        return $this->size;
    }

    public function formatSize()
    {
        return $this->getSize();
    }
}