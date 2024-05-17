<?php
    require_once ('../Connection/data-provider.php');

    $paramenters = array ('InvoiceID');
    $sql = 'CALL USP_GetInforInvoice(?)';
    $array_data_invoice = json_decode(get_data_convert_json($sql, $paramenters), true);

    $paramenters = array ('InvoiceID');
    $sql = 'CALL USP_GetInforAllProductInInvoice(?)';
    $array_data_product = json_decode(get_data_convert_json($sql, $paramenters), true);

    $paramenters = array ('InvoiceID');
    $sql = 'CALL USP_GetTotalMoneyAllProduct(?)';
    $array_data_total_money = json_decode(get_data_convert_json($sql, $paramenters), true);


    $_POST['CustomerNumberPhone'] = $array_data_invoice['data'][0]['CustomerNumberPhone'];
    $paramenters = array ('CustomerNumberPhone');
    $sql = 'CALL USP_GetCustomerBasedOnNumberPhone(?)';
    $array_data_customer = json_decode(get_data_convert_json($sql, $paramenters), true);

    echo json_encode(array(
        'InvoiceID' => $array_data_invoice['data'][0]['InvoiceID'], 
        'InvoiceDateTime' => $array_data_invoice['data'][0]['InvoiceDateTime'],
        'AmountMoneyCustomerGiven' => $array_data_invoice['data'][0]['AmountMoneyCustomerGiven'], 
        'AmoutMoneyBackCustomer' => $array_data_invoice['data'][0]['AmoutMoneyBackCustomer'], 
        'Product' => $array_data_product['data'],
        'TotalMoney' => $array_data_total_money['data'][0]['TotalMoney'],
        'CustomerNumberPhone' => $array_data_customer['data'][0]['CustomerNumberphone'],  
        'CustomerName' => $array_data_customer['data'][0]['CustomerName'], 
        'CustomerAddress' => $array_data_customer['data'][0]['CustomerAddress']
    ));
?>