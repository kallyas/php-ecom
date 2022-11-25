<?php

require_once '../../includes/config.php';
require_once '../../includes/helpers.php';
require_once '../../includes/products.php';
require_once '../../includes/category.php';

$product = new Product($db);
$category = new Category($db);
$error = '';
if($_POST && isset($_POST['create__product'])) {
    error_log('submit');
    $product->name = $_POST['product__name'];
    $product->price = $_POST['product__price'];
    $product->description = $_POST['product__description'];
    $product->category_id = $_POST['product__category_id'];
    $product->image = uploadImage($_FILES['product__image']);
    $product->quantity = $_POST['product__quantity'];
    $product->status = $_POST['product__status'];

    // debug to see if data is assigned to object
    // echo '<pre>';
    // var_dump($product);
    // echo '</pre>';
    // exit;

    if($product->create()) {
        header('Location: products.php');
    } else {
        $error = 'Something went wrong. Please try again.';
    }
    
}


$products = $product->read();
$categories = $category->read();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products | Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/products.css">
</head>
<body>
    <?php include_once 'sidebar.php' ?>
    <section class="home-section">
        <?php include_once 'shared_dash.php' ?>
        <div class="home-content">
            <?php include_once 'overview_boxes.php' ?>
            <!-- create two divs, one div on left which has a products form then on right a table containing products -->
            <div class="product-boxes">
                <div class="new__product__container">
                    <div class="new__product__form">
                        <?php if($error) : ?>
                            <div class="error">
                                <p><?php echo $error ?></p>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                            <div class="form__group">
                                <label for="product__name">Product Name</label>
                                <input type="text" name="product__name" id="product__name" placeholder="Product Name" required>
                            </div>
                            <div class="form__group">
                                <label for="product__price">Product Price</label>
                                <input type="number" name="product__price" id="product__price" placeholder="Product Price" required>
                            </div>
                            <div class="form__group">
                                <label for="product__description">Product Description</label>
                                <textarea name="product__description" id="product__description" cols="10" rows="10" placeholder="Product Description" required></textarea>
                            </div>
                            <div class="form__group">
                                <label for="product__image">Product Image</label>
                                <input type="file" name="product__image" id="product__image" required>
                            </div>
                            <div class="form__group">
                                <label for="product__category">Product Category</label>
                                <select name="product__category_id" id="product__category" required>
                                    <?php while($row = $categories->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form__group">
                                <label for="product__quantity">Product Quantity</label>
                                <input type="number" name="product__quantity" id="product__quantity" placeholder="Product Quantity" required>
                            </div>
                            <div class="form__group">
                                <label for="product__status">Product Status</label>
                                <select name="product__status" id="product__status" required>
                                    <option value="1">Available</option>
                                    <option value="0">Unavailable</option>
                                </select>
                            </div>
                            <div class="form__group">
                                <input type="submit" name="create__product" value="Create Product">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="products__table__container">
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Description</th>
                                <th>Product Image</th>
                                <th>Product Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['description'] ?></td>
                                    <td><img src="<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>"></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td>
                                        <a href="edit_product.php?id=<?php echo $row['id'] ?>">Edit</a>
                                        <a href="delete_product.php?id=<?php echo $row['id'] ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/admin.js"></script>
</body>
</html>