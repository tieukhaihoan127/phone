<?php
    require_once ('../Connection/data-provider.php');

    $search = $_GET['search'];
    $sql = "Select * FROM product WHERE ProductBarcode = '$search' OR ProductName = '$search' OR CategoryID = '$search'";

    echo get_data_convert_json_without_param($sql);  
?>