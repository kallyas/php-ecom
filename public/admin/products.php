<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products | Dashboard</title>
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
                        <form action="products.php" method="POST" enctype="multipart/form-data">
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
                                <textarea name="product__description" id="product__description" cols="30" rows="10" placeholder="Product Description" required></textarea>
                            </div>
                            <div class="form__group">
                                <label for="product__image">Product Image</label>
                                <input type="file" name="product__image" id="product__image" required>
                            </div>
                            <div class="form__group">
                                <label for="product__category">Product Category</label>
                                <select name="product__category" id="product__category" required>
                                    <option value="1">Category 1</option>
                                    <option value="2">Category 2</option>
                                    <option value="3">Category 3</option>
                                    <option value="4">Category 4</option>
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
                            <tr>
                                <td>Product 1</td>
                                <td>1000</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</td>
                                <td><img src="../images/products/product1.jpg" alt="Product 1"></td>
                                <td>Category 1</td>
                                <td>
                                    <a href="products.php?edit=1">Edit</a>
                                    <a href="products.php?delete=1">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Product 2</td>
                                <td>2000</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</td>
                                <td><img src="../images/products/product2.jpg" alt="Product 2"></td>
                                <td>Category 2</td>
                                <td>
                                    <a href="products.php?edit=2">Edit</a>
                                    <a href="products.php?delete=2">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Product 3</td>
                                <td>3000</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</td>
                                <td><img src="../images/products/product3.jpg" alt="Product 3"></td>
                                <td>Category 3</td>
                                <td>
                                    <a href="products.php?edit=3">Edit</a>
                                    <a href="products.php?delete=3">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Product 4</td>
                                <td>4000</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</td>
                                <td><img src="../images/products/product4.jpg" alt="Product 4"></td>
                                <td>Category 4</td>
                                <td>
                                    <a href="products.php?edit=4">Edit</a>
                                    <a href="products.php?delete=4">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>