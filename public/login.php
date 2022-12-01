<?php
session_start();
// check if user is logged in and has admin access, redirect to admin dashboard
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['access_level'] == 2) {
    header("Location: {$home_url}admin/index.php");
}

// check if user is logged in and has customer access, redirect to customer dashboard
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['access_level'] == 1) {
    header("Location: {$home_url}customer/index.php");
}

require_once '../includes/config.php';
require_once '../includes/user.php';

// instantiate user object
$user = new User($db);
$error = "";
$redirect_to = "";

// check if there is a redirect_to parameter in the query string
if (isset($_REQUEST['redirect_to'])) {
    $redirect_to = urldecode($_GET['redirect_to']);
}

error_log(print_r($redirect_to, true));

// check if login form was submitted
if ($_POST) {
    if (isset($_REQUEST['redirect_to'])) {
        $redirect_to = urldecode($_GET['redirect_to']);
    }
    // set user property values
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    // login user
    if ($user->login()) {
        // set session values
        $_SESSION['logged_in'] = true;
        $_SESSION['access_level'] = $user->access_level;
        $_SESSION['name'] = $user->first_name . ' ' . $user->last_name;
        $_SESSION['email'] = $user->email;
        $_SESSION['user_id'] = $user->id;
        // redirect to admin dashboard
        if ($user->access_level == 2) {
            if ($redirect_to !== "") {
                header("Location: {$redirect_to}");
            } else {
                header("Location: {$home_url}admin/index.php");
            }
        } else {
            // redirect to customer dashboard
            if ($redirect_to !== "") {
                header("Location: {$redirect_to}");
            } else {
                header("Location: {$home_url}customer/index.php");
            }
        }
    }
    // login failed
    else {
        $error = "Login failed. Email or password is incorrect.";
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form__group">
                    <?php if ($error != "") { ?>
                        <div class="error"><?php echo $error; ?></div>
                    <?php } ?>
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
                <div class="form__group">
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>