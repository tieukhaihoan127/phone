<?php
require_once ('../Connection/data-provider.php');
$name = $_GET['id'];

$get_invoice_id = "SELECT InvoiceID, CustomerNumberPhone, DATE_FORMAT(InvoiceDateTime, '%d/%m/%Y') AS InvoiceDate, AmountMoneyCustomerGiven, AmountMoneyBackCustomer FROM invoice WHERE InvoiceID = '$name' ORDER BY InvoiceID DESC LIMIT 1";
    $array = get_query($get_invoice_id);
    $phone = $array["CustomerNumberPhone"];
    $dop = $array["InvoiceDate"];
    $amcg = $array["AmountMoneyCustomerGiven"];
    $ambk = $array["AmountMoneyBackCustomer"];
    $totalSum = (int)$amcg - (int)$ambk;
    
    $sql_get_customer_info = "SELECT * FROM customer WHERE CustomerNumberphone = '$phone'";
    $array_customer = get_query($sql_get_customer_info);
    $customer_name = $array_customer["CustomerName"];

    $sql_get_invoice_detail = "SELECT * FROM invoicedetail WHERE InvoiceID = '$name'";
    $array_detail = get_query_all($sql_get_invoice_detail);
    $array_detail_product = array();
    if(!empty($array_detail)) {
        for($i = 0;$i < count($array_detail);$i++) {
            $barcode = $array_detail[$i]['ProductBarcode'];
            $numberItems = $array_detail[$i]['NumberOfItem'];
            $total = $array_detail[$i]['UnitPrice'];
            
            $sql_get_product = "SELECT * FROM product WHERE ProductBarcode = '$barcode'";
            $pro_info = get_query($sql_get_product);
            $pro_name = $pro_info['ProductName'];
            $pro_color = $pro_info['Color'];
            $pro_unit = $pro_info['ProductRetailPrice'];

            $product_detail = new stdClass();
            
            $product_detail -> ProductName = $pro_name;
            $product_detail -> ProductColor = $pro_color;
            $product_detail -> ProductQuantities = $numberItems;
            $product_detail -> ProductUnitPrice = $pro_unit;
            $product_detail -> ProductTotal = $total;
            array_push($array_detail_product,$product_detail);
        }
    }

    $results = array(
        "InvoiceID" => $name,
        "InvoiceDateTime" => $dop,
        "TotalSum" => $totalSum,
        "GivenMoney" => $amcg,
        "PaidBack" => $ambk,
        "CustomerName" => $customer_name,
        "CustomerPhone" => $phone,
        "CheckoutDetail" => $array_detail_product
    );
    
    echo json_encode($results);

?>