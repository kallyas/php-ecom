<?php
session_start();
// check if user is logged in and has admin access, redirect to admin dashboard
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['access_level'] == 'Admin'){
    header("Location: {$home_url}admin/index.php");
} 

// check if user is logged in and has customer access, redirect to customer dashboard
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['access_level'] == 'Customer'){
    header("Location: {$home_url}customer/index.php");
}

require_once '../includes/config.php';
require_once '../includes/user.php';

// instantiate user object
$user = new User($db);

// check if login form was submitted
if($_POST){
    // set user property values
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    // login user
    if($user->login()){
        // set session values
        $_SESSION['logged_in'] = true;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        // redirect to admin dashboard
        header("Location: {$home_url}admin/index.php");
    }
    // login failed
    else{
        echo "<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login__container">
        <div class="login__form">
            <h1>Login</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form__group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form__group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form__group">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
