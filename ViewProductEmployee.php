<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/AddProduct.css">
    <link rel="stylesheet" href="./assets/css/AdminDashboard.css">
    <title>View Product</title>
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
                    <div class="add-product">
                        <div class="content">
                            <div class="logo">
                                <img src="./assets/images/logobig.png" alt="">
                            </div>
                            <div class="title">
                                View Product
                            </div>
                            <form action="">
                                <div class="fifth">
                                    <div class="barcode-input">
                                        <label for="barcode">Barcode :</label>
                                        <input type="text" name="barcode" id="barcode" value="0705632441947" disabled>
                                    </div>
                                    <div class="date-input">
                                        <label for="stock">Creation Date :</label>
                                        <input type="text" name="date" id="date" value="14/12/2023" disabled>
                                    </div>
                                </div>
                                <div class="second">
                                    <div class="import-input">
                                        <label for="import">Product Name :</label>
                                        <input type="text" name="import" id="import" value="Iphone 9" disabled>
                                    </div>
                                    <div class="retail-input">
                                        <label for="retail">Retail Price :</label>
                                        <input type="text" name="retail" id="retail" value="23.33$" disabled>
                                    </div>
                                </div>
                                <div class="third">
                                    <div class="category-input">
                                        <label for="category">Category :</label>
                                        <input type="text" name="category" id="category" value="Apple" disabled>
                                    </div>
                                    <div class="stock-input">
                                        <label for="stock">Color :</label>
                                        <input type="text" name="stock" id="stock" value="Green" disabled>
                                    </div>
                                </div>
                                <div class="fourth">
                                    <div class="picture">
                                        <label for="choose=pic">Picture :</label>
                                    </div>
                                    <div class="image">
                                        <img src="./assets/images/avatar.jpg" alt="">
                                    </div>
                                </div>
                                <div class="submit-product" type="submit">Done</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="./assets/js/script.js"></script>
</body>
</html>