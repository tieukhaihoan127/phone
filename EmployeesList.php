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
    <link rel="stylesheet" href="./assets/css/EmployeesList.css">
    <link rel="stylesheet" href="./assets/css/AdminDashboard.css">
    <title>Account Manangement</title>
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
                        <div class="body-content">
                            <div class="first">
                                <button class="add-account">
                                        <span>
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                        <div class="text">
                                            Add Account
                                        </div>
                                </button>
                                <div class="search-input">
                                    <div class="form">
                                        <span class="icon-search">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </span>
                                        <input type="text" value="" name="search">
                                        <button type="submit" class="search-button">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="second">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Employees Id</th>
                                            <th>Full Name</th>
                                            <th>Status</th>
                                            <th>Manage</th>
                                            <th>Resend Mail</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/EmployeesList.js"></script>
</body>
</html>