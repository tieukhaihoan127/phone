<?php
require_once("./api/Connection/data-provider.php");
session_start(); 

if (!isset($_SESSION['username'])) {
    header('Location: Login.php');
    exit();
}
else {
    $username = $_SESSION['username'];

    $sqlActive = "SELECT SalesPersonInactivate FROM salesperson WHERE UserName = '$username'";
    $check_arr = get_query($sqlActive);
    $inactiveCheck = $check_arr['SalesPersonInactivate'];

    if($inactiveCheck == 1) {
        header('Location: Login.php');
        exit();
    }

    $sqlLock = "SELECT SalesPersonLockAccount FROM salesperson WHERE UserName = '$username'";
    $check_lock = get_query($sqlLock);
    $lockCheck = $check_lock['SalesPersonLockAccount'];

    if($lockCheck == 1) {
        header('Location: Login.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/AdminDashboard.css">
    <link rel="stylesheet" href="./assets/css/CustomerDetail.css">
    <title>Customer Detail</title>
</head>
<body>
    <div class="main">
            <div class="sider left">
                    <a href="/" class="logo">
                        <img src="./assets/images/logobig.png" alt="Website Icon">
                    </a>
                    <div class="menu">
                        <ul>

                        </ul>
                    </div>
            </div>
            <div class="content right">
                <div class="header">
                    <div class="header-content">
                        <div class="current-content">
                            Account Management
                        </div>
                        <div class="current-content-smaller">
                            <div class="web-info">
                                <div class="logo-img">
                                    <img src="./assets/images/small-icon.png" alt="">
                                </div>
                                <div class="navbar">
                                    <i class="fa-solid fa-bars"></i>
                                </div>
                            </div>
                            <div class="sider-info">
                                <ul>

                                </ul>
                            </div>
                        </div>
                        <div class="menu-content">
                            <div class="menu">
                                <span class="icon-bg">
                                    <i class="fa-solid fa-moon"></i>
                                </span>
                            </div>
                            <div class="information">
                                <div class="admin">
                                    <div class="image">
                                        <img src="./assets/images/avatar.jpg" alt="Admin Icon">
                                    </div>
                                    <div class="admin-info">
                                        <div class="admin-name">
                                            Tieu Khai Hoan
                                        </div>
                                        <div class="role">
                                            Admin
                                        </div>
                                    </div>
                                </div>
                                <div class="admin-menu">
                                    <div class="menu-desc">
                                        Welcome !
                                    </div>
                                    <div class="menu-info">
                                        <ul>
                                            <li>
                                                <div class="menu-item">
                                                    <span class="icon-sider">
                                                        <i class="fa-solid fa-user"></i>
                                                    </span>
                                                    <div class="text">
                                                        My Account
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="menu-item">
                                                    <span class="icon-sider">
                                                        <i class="fa-solid fa-gear"></i>
                                                    </span>
                                                    <div class="text">
                                                        Password
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="menu-item">
                                                    <span class="icon-sider">
                                                        <i class="fa-solid fa-right-from-bracket"></i>
                                                    </span>
                                                    <div class="text">
                                                        Logout
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="container">
                        <div class="register-customer">
                            <div class="register-form">
                                <div class="logo">
                                    <img src="./assets/images/logobig.png" alt="">
                                </div>
                                <div class="title">
                                    Customer Detail
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/ViewCustomer.js"></script>
</body>
</html>