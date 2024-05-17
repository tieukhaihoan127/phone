<?php
    require_once ('../Connection/data-provider.php');
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

    $sql = "Select * FROM Salesperson WHERE SalesPersonID = '" . $id . "'";

    echo get_data_convert_json_without_param($sql);  
?>