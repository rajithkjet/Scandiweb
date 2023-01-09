<?php

require_once 'classes/Database.php';
require_once 'classes/products/Product.php';

$db = new Database;

$productList = $db->query('SELECT * FROM products ORDER BY created_at DESC');
$results = $db->resultSet();
$products = [];

// For each prodyct type, create a new class instance and get the results in format necessary for the specific product
foreach ($results as $result) {
    switch ($result->type) {
        case Product::TYPE_BOOK:
            $product = new Book($result->id, $result->sku, $result->name, $result->price, $result->size);
            break;
        case Product::TYPE_DVD:
            $product = new DVD($result->id, $result->sku, $result->name, $result->price, $result->size);
            break;
        case Product::TYPE_FURNITURE:
            $product = new Furniture($result->id, $result->sku, $result->name, $result->price, json_decode($result->size));
            break;
    }

    $products[] = $product;
}

?>

<?php
// Prepare and delete products
if (isset($_POST['products']) && count($_POST['products']) > 0) {
    $products = array_map(function ($id) {
        $id = intval($id);

        if ($id === 0) {
            throw new RuntimeException('Deletion process failed');
        }

        return $id;
    }, $_POST['products']);

    (new ProductRepository)->deleteProducts($products);

    header('Location: productList.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Add a Product</title>
</head>

<body>
    <header>
        <h1 class="main-header">
            Product List
        </h1>
    </header>
    <main>
        <form action="" method="POST">
            <div class="product-list-nav">
                <input class="delete-button" type="submit" value="Delete Selected">
                <div class="dropdown">
                    <button class="dropbtn">Add Product</button>
                    <div class="dropdown-content">
                        <a href="addBook.php">Add Book</a>
                        <a href="addDvd.php">Add DVD</a>
                        <a href="addFurniture.php">Add Furniture</a>
                    </div>
                </div>
            </div>
            <div class="product-grid">

                <?php foreach ($products as $product): ?>

                <!-- Get products -->
                <div class="product-box">

                    <input type="checkbox" name="products[]" value="<?php echo $product->getId(); ?>" class="checkbox">
                    <p class="item">SKU: <?php echo $product->getSku(); ?></p>
                    <p class="item">Name: <?php echo $product->getName(); ?></p>
                    <p class="item">Price: <?php echo $product->getPrice(); ?></p>
                    <p class="item">Size: <?php echo $product->formatSize(); ?></p>
                </div>

                <?php endforeach;?>

            </div>
        </form>
    </main>
</body>

</html>