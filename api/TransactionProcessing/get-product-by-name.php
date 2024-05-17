<?php
require_once ('../Connection/data-provider.php');

    if(isset($_GET['search'])) {
        $name = $_GET['search'];
        $sql = "SELECT * FROM product WHERE ProductName = '$name'";
        echo $result = get_data_convert_json_without_param($sql); 
    }
    else if(isset($_GET['barcode'])) {
        $barcode= $_GET['barcode'];
        $sql = "SELECT * FROM product WHERE ProductBarcode = '$barcode'";
        echo $result = get_data_convert_json_without_param($sql); 
    }
?>