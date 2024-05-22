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
    <link rel="stylesheet" href="./assets/css/AdminDashboard.css">
    <link rel="stylesheet" href="./assets/css/Reporting.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <title>Reporting and Analytics</title>
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
                        Reporting and Analytics
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
                        <div class="reporting-content">
                            <div class="search-time">
                                <label for="time">Filter :</label>
                                <select name="" id="time">
                                    <option value="" selected disabled>--- Chọn dịch vụ ---</option>
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="week">The last 7 days</option>
                                    <option value="month">This month</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                            <div class="specific-time">
                                <div class="from">From</div>
                                <input type="date" placeholder="dd/mm/yyyy">
                                <div class="to">To</div>
                                <input type="date" placeholder="dd/mm/yyyy">
                                <button class="search">Search</button>
                            </div>

                        </div>
                        <div class="reporting-current">
                            <div class="title">
                                Reporting Information
                            </div>
                            <div class="report-current-content">
                                
                            </div>

                        </div>
                        <div class="order-list">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Total Amount</th>
                                        <th>Date Of Purchase</th>
                                        <th>Quantities</th>
                                        <th>View Detail</th>
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
    <script src="./assets//js/Reporting.js"></script>
</body>

</html>