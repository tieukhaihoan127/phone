<?php
require_once ('../Connection/data-provider.php');
session_start();
$get_invoice_id = "SELECT InvoiceID, CustomerNumberPhone, DATE_FORMAT(InvoiceDateTime, '%d/%m/%Y') AS InvoiceDate, AmountMoneyCustomerGiven, AmountMoneyBackCustomer FROM invoice ORDER BY InvoiceID DESC LIMIT 1";
    $array = get_query($get_invoice_id);
    $id = $array["InvoiceID"];
    $phone = $array["CustomerNumberPhone"];
    $dop = $array["InvoiceDate"];
    $amcg = $array["AmountMoneyCustomerGiven"];
    $ambk = $array["AmountMoneyBackCustomer"];
    $totalSum = (int)$amcg - (int)$ambk;
    
    $sql_get_customer_info = "SELECT * FROM customer WHERE CustomerNumberphone = '$phone'";
    $array_customer = get_query($sql_get_customer_info);
    $customer_name = $array_customer["CustomerName"];
    $customer_address = $array_customer["CustomerAddress"];

    $sql_get_invoice_detail = "SELECT * FROM invoicedetail WHERE InvoiceID = '$id'";
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
            $product_detail -> ProductUnitPrice = $pro_unit;
            $product_detail -> ProductQuantities = $numberItems;
            $product_detail -> ProductTotal = $total;
            array_push($array_detail_product,$product_detail);
        }
    }

    $value = $_SESSION['username'];
    $get_name = "SELECT SalesPersonFullName FROM salesperson WHERE SalesPersonID IN (SELECT SalesPersonID FROM accountallemployee WHERE UserName = '$value')";
    $array = get_query($get_name);
    $name = $array["SalesPersonFullName"];

    $results = array(
        "EmployeeName" => $name,
        "InvoiceID" => $id,
        "InvoiceDateTime" => $dop,
        "TotalSum" => $totalSum,
        "CustomerName" => $customer_name,
        "CustomerAddress" => $customer_address,
        "CustomerPhone" => $phone,
        "CheckoutDetail" => $array_detail_product
    );
    
    echo json_encode($results);

?>