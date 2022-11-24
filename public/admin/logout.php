<?php
session_start();
// destroy everything in session and then destry session
session_destroy();
header("Location: ../login.php");