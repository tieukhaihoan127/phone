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
    <link rel="stylesheet" href="./assets/css/CheckoutInformation.css">
    <link rel="stylesheet" href="./assets/css/AdminDashboard.css">
    <title>Checkout Information</title>
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
                            Checkout Information
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
                        <div class="order-detail">
                            <div class="order-first">
                                <div class="order-info">
                                    <div class="title">
                                        Order Information
                                    </div>
                                    <div class="detail-table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Information</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="order-detail-info">
                                    <div class="title">
                                        Order Summary
                                    </div>
                                    <div class="detail-table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="order-second">
                                <div class="order-customer-info">
                                    <div class="head-title">
                                        Customer Information
                                    </div>
                                    <div class="detail-customer">
                                        <div class="first">
                                            <div class="phone-input">
                                                <div class="phone">
                                                    <div class="name">Phone Number</div>
                                                    <button class="check">Check</button>
                                                </div>
                                                <input type="text" name="phone" id="phone" required>
                                            </div>
                                            <div class="fullname-input">
                                                <div class="fullname">
                                                    Full Name
                                                </div>
                                                <input type="text" name="fullname" id="fullname" required>
                                            </div>
                                        </div>
                                        <div class="second">
                                            <div class="address-input">
                                                <div class="address">
                                                    Address
                                                </div>
                                                <input type="text" name="address" id="address" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-function">
                                    <div class="title">
                                        Order Description
                                    </div>
                                    <div class="detail-function">
                                        <div class="note">
                                            <div class="desc">
                                                Note :
                                            </div>
                                            <textarea name="" id="" cols="69" rows="5"></textarea>
                                        </div>
                                        <div class="button">
                                            <button class="confirm">Confirm</button>
                                            <button class="back">Back</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script src="./assets/js/script.js"></script>
    <script src="./assets//js/CheckoutInformation.js"></script>
</body>
</html>