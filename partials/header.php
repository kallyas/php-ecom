<?php
// css files are loaded from outside the public folder
// so we need to go back one level
$css_dir = '../public/css/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $css_dir . 'style.css' ?>">
    <script src="https://kit.fontawesome.com/0d67f6bb4c.js" crossorigin="anonymous"></script>
</head>
