<?php
    require_once ('../Connection/data-provider.php');
    $sql = "SELECT * FROM customer WHERE CustomerNumberphone != '0000000000'";

    echo get_data_convert_json_without_param($sql);  
?>