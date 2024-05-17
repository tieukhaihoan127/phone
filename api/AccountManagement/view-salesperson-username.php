<?php
    require_once ('../Connection/data-provider.php');
    
    session_start();
    $userName = $_SESSION['username'];

    $sql = "Select * FROM Salesperson WHERE UserName = '$userName'";

    echo get_data_convert_json_without_param($sql);  
?>