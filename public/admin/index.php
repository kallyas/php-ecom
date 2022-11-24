<!-- admin dashboard -->
<?php
// start session
session_start();
// get database connection
require_once '../../includes/config.php';
require_once '../../includes/user.php';
require_once '../../includes/products.php';
require_once '../../includes/helpers.php';

// instantiate user object
$user = new User($db);
$product = new Product($db);
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/';

// check if user is logged in and has admin access
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['access_level'] != 2) {
    header("Location: {$base_url}index.php");
}

// check if user is not logged in
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    error_log("User not logged in");
    header("Location: {$base_url}login.php");
}

$recent_users = $user->read();
$recent_products = $product->read();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
 <?php include_once 'sidebar.php' ?>
  <section class="home-section">
    <?php include_once 'shared_dash.php' ?>
    <div class="home-content">
      <?php include_once 'overview_boxes.php' ?>
      <div class="products-boxes">
        <div class="recent-orders">
          <div class="card-header">
            <h2>Recent Orders</h2>
          </div>
          <table>
            <thead>
              <tr>
                <td>Order ID</td>
                <td>Customer</td>
                <td>Order Date</td>
                <td>Total</td>
                <td>Status</td>
                <td>Invoice</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>12/12/2021</td>
                <td>$100</td>
                <td><span class="badge success">Delivered</span></td>
                <td><i class='bx bx-download' ></i></td>
              </tr>
              <tr>
                <td>2</td>
                <td>John Doe</td>
                <td>12/12/2021</td>
                <td>$100</td>
                <td><span class="badge success">Delivered</span></td>
                <td><i class='bx bx-download' ></i></td>
              </tr>
              <tr>
                <td>3</td>
                <td>John Doe</td>
                <td>12/12/2021</td>
                <td>$100</td>
                <td><span class="badge success">Delivered</span></td>
                <td><i class='bx bx-download' ></i></td>
              </tr>
              <tr>
                <td>4</td>
                <td>John Doe</td>
                <td>12/12/2021</td>
                <td>$100</td>
                <td><span class="badge success">Delivered</span></td>
                <td><i class='bx bx-download' ></i></td>
              </tr>
            </tbody>
          </table>
          <!-- table pagination -->
          <div class="pagination">
            <a href="#"><i class='bx bx-chevrons-left'></i></a>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#"><i class='bx bx-chevrons-right'></i></a>
          </div> 
        </div>
    </div>
    <div class="users-boxes">
      <div class="recent-customers">
        <div class="card-header">
          <h2>Recent Customers</h2>
        </div>
        <table>
          <thead>
            <tr>
              <td>User ID</td>
              <td>First Name</td>
              <td>Last Name</td>
              <td>Email</td>
              <td>Order</td>
            </tr>
          </thead>
          <tbody>
            <?php if($recent_users > 0){ ?>
              <?php foreach($recent_users as $user): ?>
            <tr>
              <td><?= $user['id']; ?></td>
              <td><?= $user['first_name'] ?></td>
              <td><?= $user['last_name'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><span class="badge success">View</span></td>
            </tr>
            <?php endforeach; ?>
            <?php }else{ ?>
              <tr>
                <td colspan="5">No Data Found</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <!-- table pagination -->
        <div class="pagination">
            <a href="#"><i class='bx bx-chevrons-left'></i></a>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#"><i class='bx bx-chevrons-right'></i></a>
          </div> 
      </div>
    </div>
  </section>

  <script src="../js/admin.js"></script>
    
</body>
</html>

