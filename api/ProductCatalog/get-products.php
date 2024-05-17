<?php
    require_once ('../Connection/data-provider.php');
    session_start();
    $value = $_SESSION['username'];
    $checkType = "SELECT AccountType FROM accountallemployee WHERE username = '" .$value. "'";
    $array = get_query($checkType);
    $acc = $array["AccountType"];

    if($acc == 0) 
    {
        $sql = "SELECT product.ProductBarcode AS ProductBarcode , product.ProductName AS ProductName, product.ProductImportPrice AS ProductImportPrice, product.ProductRetailPrice AS ProductRetailPrice, product.Color AS Color,DATE_FORMAT(product.ProductCreatedDate, '%d/%m/%Y') AS ProductCreatedDate, product.CategoryID AS CategoryName FROM product  ";
    }
    else
    {
        $sql = "SELECT product.ProductBarcode AS ProductBarcode , product.ProductName AS ProductName, product.ProductRetailPrice AS ProductRetailPrice, product.Color AS Color,DATE_FORMAT(product.ProductCreatedDate, '%d/%m/%Y') AS ProductCreatedDate, product.CategoryID AS CategoryName FROM product ";
    }
    echo get_data_convert_json_without_param($sql);
 
?>