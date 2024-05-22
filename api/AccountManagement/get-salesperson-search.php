<?php
    require_once ('../Connection/data-provider.php');

    $search = $_GET['search'];
    $sql = "Select * FROM Salesperson WHERE SalesPersonID = '$search' OR SalesPersonFullName = '$search'";

    echo get_data_convert_json_without_param($sql);  
?>