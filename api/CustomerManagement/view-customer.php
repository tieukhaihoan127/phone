<?php
    require_once ('../Connection/data-provider.php');
    
    $id = $_GET["id"];

    $sql = "Select * FROM customer WHERE CustomerNumberphone = '$id'";

    echo get_data_convert_json_without_param($sql);  
?>