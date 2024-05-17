<?php
    require_once ('../Connection/data-provider.php');
    if(isset($_GET['phone'])) {
        $status = $_GET['phone'];
    } else {
        $status = null;
    }


    $sql = "SELECT * FROM customer WHERE CustomerNumberphone = '$status'";

    $array = get_query($sql);
    $arr_empty = [];    
    if(!empty($array)) {
        $phone = $array["CustomerNumberphone"];
        $name = $array["CustomerName"];
        $address = $array["CustomerAddress"];
        $results = array(
            "CustomerPhoneNumber" => $phone,
            "CustomerName" => $name,
            "CustomerAddress" => $address
        );
        
        echo json_encode($results);
    }  
    else {
        echo json_encode($arr_empty);
    }

?>