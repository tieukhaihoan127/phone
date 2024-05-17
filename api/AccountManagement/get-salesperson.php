<?php
    require_once ('../Connection/data-provider.php');
    $sql = 'Select * FROM Salesperson';

    echo get_data_convert_json_without_param($sql);  
?>