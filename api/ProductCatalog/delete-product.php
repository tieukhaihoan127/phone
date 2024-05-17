<?php
    require_once ('../Connection/data-provider.php');

    $referer = $_SERVER['HTTP_REFERER'];

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
    
    $url_components = parse_url($url); 
    parse_str($url_components['query'], $params);
    
    $id = $params['id'];

    $sql = "DELETE FROM product WHERE ProductBarcode = '$id'";
    pre_statement_without_param_non_query($sql);
    header("Location: /FinalWeb/ProductsList.php");
    exit();
?>