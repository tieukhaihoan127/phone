<?php
    require_once ('../Connection/data-provider.php');

    $referer = $_SERVER['HTTP_REFERER'];
    
    $name = $_POST['fullname'];
    $import = $_POST['import'];
    $retail = $_POST['retail'];
    $category = $_POST['category'];
    $color = $_POST['stock'];
    $currentDate = date("Y-m-d");


    $get_barcode = "SELECT ProductBarcode FROM product ORDER BY ProductBarcode DESC LIMIT 1";

    $array = get_query($get_barcode);
    $acc = $array["ProductBarcode"];
    $number = (int)substr($acc, 1);
    $number++;
    $id = "";
    if($number < 10) {
        $id = "P000000000".(string)$number;
    }
    else if($number < 100) {
        $id = "P00000000".(string)$number;
    }
    else if($number < 1000) {
        $id = "P0000000".(string)$number;
    }
    else if($number < 10000) {
        $id = "P0000000".(string)$number;
    }
    else if($number < 100000) {
        $id = "P000000".(string)$number;
    }
    else if($number < 1000000) {
        $id = "P00000".(string)$number;
    }
    else if($number < 10000000) {
        $id = "P0000".(string)$number;
    }
    else if($number < 100000000) {
        $id = "P000".(string)$number;
    }
    else if($number < 1000000000) {
        $id = "P00".(string)$number;
    }
    else if($number < 10000000000) {
        $id = "P0".(string)$number;
    }
    else if($number < 100000000000) {
        $id = "P".(string)$number;
    }

    $sql = "INSERT INTO product VALUES ('$id','$category','$name','$import','$retail','$currentDate','$color')";

    pre_statement_without_param_non_query($sql);

    header("Location: http://localhost:8080/FinalWeb/ProductsList.php");
    exit();
    
?>