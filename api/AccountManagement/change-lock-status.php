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
    $status = $params['status'];

    if($status == "lock") {
        $sql = "UPDATE Salesperson SET SalesPersonLockAccount = 0 WHERE SalesPersonID = '" . $id. "'";
    }
    else {
        $sql = "UPDATE Salesperson SET SalesPersonLockAccount = 1 WHERE SalesPersonID = '" . $id. "'";
    } 

    pre_statement_without_param_non_query($sql);
?>