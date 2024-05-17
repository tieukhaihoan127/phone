<?php
    require_once ('../Connection/data-provider.php');
    session_start();
    $value = $_SESSION['username'];
    $checkType = "SELECT AccountType FROM accountallemployee WHERE username = '" .$value. "'";

    echo get_data_convert_json_without_param($checkType); 
?>