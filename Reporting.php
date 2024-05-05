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
                    <li>
                        <div class="menu-item">
                            <span class="icon-sider">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <div class="text">
                                Account Management
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="menu-item">
                            <span class="icon-sider">
                                <i class="fa-brands fa-product-hunt"></i>
                            </span>
                            <div class="text">
                                Product Management
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="menu-item">
                            <span class="icon-sider">
                                <i class="fa-solid fa-circle-user"></i>
                            </span>
                            <div class="text">
                                Customer Management
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="menu-item">
                            <span class="icon-sider">
                                <i class="fa-solid fa-coins"></i>
                            </span>
                            <div class="text">
                                Transaction Processing
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="menu-item">
                            <span class="icon-sider">
                                <i class="fa-solid fa-chart-simple"></i>
                            </span>
                            <div class="text">
                                Reporting and Analytics
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content right">
            <div class="header">
                <div class="header-content">
                    <div class="current-content">
                        View Product
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
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <div class="text">
                                            Account Management
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-brands fa-product-hunt"></i>
                                        </span>
                                        <div class="text">
                                            Product Management
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <div class="text">
                                            Customer Management
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-solid fa-coins"></i>
                                        </span>
                                        <div class="text">
                                            Transaction Processing
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-solid fa-chart-simple"></i>
                                        </span>
                                        <div class="text">
                                            Reporting and Analytics
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu-content">
                        <div class="menu">
                            <span class="icon-bg">
                                <i class="fa-solid fa-moon"></i>
                            </span>
                            <span class="icon-cart">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div class="number-cart">
                                    5+
                                </div>
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
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="7-days">The last 7 days</option>
                                    <option value="month">This month</option>
                                </select>
                            </div>
                            <div class="specific-time">
                                <div class="from">From</div>
                                <input type="date">
                                <div class="to">To</div>
                                <input type="date">
                                <button class="search">Search</button>
                            </div>

                        </div>
                        <div class="reporting-current">
                            <div class="title">
                                Reporting Information
                            </div>
                            <div class="report-current-content">
                                <div class="total">
                                    Total amount received : 100000000000 VND
                                </div>
                                <div class="number-orders">
                                    Number of orders : 10
                                </div>
                                <div class="number-products">
                                    Number of products : 10
                                </div>
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
                                    <tr>
                                        <td>
                                            <div class="order-id">
                                                HD00001
                                            </div>
                                        </td>
                                        <td>
                                            <div class="customer-name">
                                                Tieu Khai Hoan
                                            </div>
                                        </td>
                                        <td>
                                            <div class="total-amount">
                                                6000000 VND
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date">
                                                29/02/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantities">
                                                5
                                            </div>
                                        </td>
                                        <td>
                                            <button class="view-detail">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="order-id">
                                                HD00001
                                            </div>
                                        </td>
                                        <td>
                                            <div class="customer-name">
                                                Tieu Khai Hoan
                                            </div>
                                        </td>
                                        <td>
                                            <div class="total-amount">
                                                6000000 VND
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date">
                                                29/02/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantities">
                                                5
                                            </div>
                                        </td>
                                        <td>
                                            <button class="view-detail">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="order-id">
                                                HD00001
                                            </div>
                                        </td>
                                        <td>
                                            <div class="customer-name">
                                                Tieu Khai Hoan
                                            </div>
                                        </td>
                                        <td>
                                            <div class="total-amount">
                                                6000000 VND
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date">
                                                29/02/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantities">
                                                5
                                            </div>
                                        </td>
                                        <td>
                                            <button class="view-detail">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="order-id">
                                                HD00001
                                            </div>
                                        </td>
                                        <td>
                                            <div class="customer-name">
                                                Tieu Khai Hoan
                                            </div>
                                        </td>
                                        <td>
                                            <div class="total-amount">
                                                6000000 VND
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date">
                                                29/02/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantities">
                                                5
                                            </div>
                                        </td>
                                        <td>
                                            <button class="view-detail">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="order-id">
                                                HD00001
                                            </div>
                                        </td>
                                        <td>
                                            <div class="customer-name">
                                                Tieu Khai Hoan
                                            </div>
                                        </td>
                                        <td>
                                            <div class="total-amount">
                                                6000000 VND
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date">
                                                29/02/2024
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantities">
                                                5
                                            </div>
                                        </td>
                                        <td>
                                            <button class="view-detail">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/script.js"></script>
</body>

</html>