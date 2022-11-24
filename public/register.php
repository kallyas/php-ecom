<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/user.php';

// check if user is logged in and has admin access, redirect to admin dashboard
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['access_level'] == 2){
    header("Location: {$home_url}admin/index.php");
} 

// check if user is logged in and has customer access, redirect to customer dashboard
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['access_level'] == 1){
    header("Location: {$home_url}customer/index.php");
}
// instantiate user object
$user = new User($db);

// check if register form was submitted
if ($_POST) {
    // set user property values
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->access_level = 1;
    // create user
    if ($user->create()) {
        // set session values
        $_SESSION['logged_in'] = true;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['first_name'] = $user->first_name;
        $_SESSION['last_name'] = $user->last_name;
        $_SESSION['email'] = $user->email;
        // redirect to index page
        header("Location: {$home_url}index.php");
    }
    // registration failed
    else {
        echo "<div class='alert alert-danger'>Registration failed. Email already exists.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login__container">
    <div class="login__form">
            <h1>Register</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form__group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form__group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" required>
                </div>
                <div class="form__group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" required>
                </div>
                <div class="form__group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form__group">
                    <input type="submit" value="Register">
                </div>
                <div class="form__group">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>