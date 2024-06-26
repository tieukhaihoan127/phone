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
    // Kiểm tra xem sản phẩm có xóa được không , nếu được thì xóa, nếu không thì trở về trang ProductsList và truyền param errorMessage, khi trang ProductsList được load sẽ nhận errorMessage in ra thông báo lỗi và xóa đi param đó 
    if(check_sql_query_statement($sql) == true) {
          pre_statement_without_param_non_query($sql);
          header("Location: /FinalWeb/ProductsList.php");
          exit();
    }
    else {
          header("Location: /FinalWeb/ProductsList.php?errorMessage=1");
          exit();
    }
?>