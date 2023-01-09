<?php

require_once 'classes/Database.php';
require_once 'classes/Validator.php';
require_once 'classes/products/Product.php';

$validator = new Validator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputData = [
        'sku' => trim($_POST['sku']),
        'name' => trim($_POST['name']),
        'price' => trim($_POST['price']),
        'size' => is_array($_POST['size']) ? json_encode($_POST['size']) : trim($_POST['size']),
        'type' => trim($_POST['type']),
    ];

    // Validate input data
    $validator->required('sku', $inputData['sku']);
    $validator->required('name', $inputData['name']);
    $validator->required('price', $inputData['price']);
    $validator->number('price', $inputData['price']);
    $validator->required('size', $inputData['size']);
    $validator->number('size', $inputData['size']);

    if ($validator->success()) {
        (new ProductRepository)->addProduct($inputData);

        header('Location: addBook.php?success');
    }
}

$errors = $validator->getErrors();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Add a Book</title>
</head>

<body>
    <header>
        <h1 class="main-header">
            Add a New Product
        </h1>
    </header>
    <main>
        <span class="product-add-nav">
            <a href="index.php">Product List</a>
        </span>
        <ul>
            <li class="active">
                <a href="addBook.php">Books</a>
            </li>
            <li>
                <a href="addDvd.php">DVD's</a>
            </li>
            <li>
                <a href="addFurniture.php">Furniture</a>
            </li>
        </ul>

        <?php if (isset($_GET['success'])) {?>
        <div>
            <h3 class="added-successfully">
                <center>Product Added!</center>
            </h3>
        </div>
        <?php }?>

        <form action="" method="POST">
            <div>
                <div class="product-tabs">
                    <input type="text" name="sku" placeholder="CFD" autocomplete="off"
                        value="<?php echo isset($_POST["sku"]) ? $_POST["sku"] : ''; ?>">
                </div>
                <div class="errors">
                    <?php if ($errors->has('sku')) {?>
                    <span><?php echo $errors->first('sku'); ?></span>
                    <?php }?>
                </div>
                <div class="product-tabs">
                    <input type="text" name="name" placeholder="Name of the product" autocomplete="off"
                        value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>">
                </div>
                <div class="errors">
                    <?php if ($errors->has('name')) {?>
                    <span><?php echo $errors->first('name'); ?></span>
                    <?php }?>
                </div>
                <div class="product-tabs">
                    <input type="text" name="price" placeholder="Product price" autocomplete="off"
                        value="<?php echo isset($_POST["price"]) ? $_POST["price"] : ''; ?>">
                </div>
                <div class="errors">
                    <?php if ($errors->has('price')) {?>
                    <span><?php echo $errors->first('price'); ?></span>
                    <?php }?>
                </div>
                <div class="product-tabs">
                    <input type="text" name="size" placeholder="Weight in KG" autocomplete="off"
                        value="<?php echo isset($_POST["size"]) ? $_POST["size"] : ''; ?>">
                </div>
                <div class="errors">
                    <?php if ($errors->has('size')) {?>
                    <span><?php echo $errors->first('size'); ?></span>
                    <?php }?>
                </div>
                <!-- Submit Buttons -->
                <div class="btn">
                    <input type="submit" value="Submit">
                    <input type="reset" value="Clear">
                    <input type="hidden" name="type" value="book">
                </div>
            </div>
        </form>
    </main>

</body>

</html>