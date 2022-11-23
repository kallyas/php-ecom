<!-- admin dashboard -->
<?php
// start session
session_start();
// get database connection
require_once '../../includes/config.php';
require_once '../../includes/user.php';

// instantiate user object
$user = new User($db);

// check if user is logged in and has admin access
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['access_level'] != 'Admin'){
    header("Location: {$home_url}login.php?action=not_admin");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
</body>
</html>

