<?php

require_once 'classes/Database.php';

class ProductRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addProduct(array $inputData): void
    {
        $this->db->query('INSERT INTO products (sku, type, name, price, size) VALUES(:sku, :type, :name, :price, :size)');

        $this->db->bind(':sku', $inputData['sku']);
        $this->db->bind(':type', $inputData['type']);
        $this->db->bind(':name', $inputData['name']);
        $this->db->bind(':price', $inputData['price']);
        $this->db->bind(':size', $inputData['size']);

        $this->db->execute();
    }

    public function deleteProducts(array $products): void
    {
        $products = implode(',', $products);

        $this->db->query("DELETE FROM products WHERE id IN ($products)");

        $this->db->execute();
    }
}