<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/AddProduct.css">
    <link rel="stylesheet" href="./assets/css/AdminDashboard.css">
    <title>Update Product</title>
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
                                <div class="product-title">
                                    Product name :  Iphone 9
                                </div>
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
                                        <label for="import">Import Price :</label>
                                        <input type="text" name="import" id="import" value="19.99$" disabled>
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