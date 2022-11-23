<?php

require_once "../includes/config.php";
require_once "../includes/products.php";

$product_id = $_GET['id'];
$product = new Product($db);
$product->id = $product_id;
$product_details = $product->readOne();
?>
<?php include_once "../includes/header.php"; ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1><?php echo $product_details['name']; ?></h1>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p><img src="http://placehold.it/350x150" alt="" class="img-responsive"></p>
                    </div>
                    <div class="col-md-8">
                        <p><?php echo $product_details['description']; ?></p>
                        <p><strong>Price: </strong><?php echo $product_details['price']; ?></p>
                        <p><a href="index.php" class="btn btn-primary">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once "../includes/footer.php"; ?>