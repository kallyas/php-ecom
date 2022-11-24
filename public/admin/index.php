<!-- admin dashboard -->
<?php
// start session
session_start();
// get database connection
require_once '../../includes/config.php';
require_once '../../includes/user.php';
require_once '../../includes/products.php';

// instantiate user object
$user = new User($db);
$product = new Product($db);
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/';

// check if user is logged in and has admin access
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && $_SESSION['access_level'] != 'Admin') {
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
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Admin</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-box' ></i>
            <span class="links_name">Products</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Order list</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Stock</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Total order</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Settings</span>
          </a>
        </li>
        <li class="log_out">
          <a href="#">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <!--<img src="images/profile.jpg" alt="">-->
        <span class="admin_name">Prem Shahi</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Orders</div>
            <div class="number">40,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Sales</div>
            <div class="number">38,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Return</div>
            <div class="number">11,086</div>
            <div class="indicator">
              <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Down From Today</span>
            </div>
          </div>
          <i class='bx bxs-cart-download cart four' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Revenue</div>
            <div class="number">1,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-money cart three' ></i>
        </div>
      </div>
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

