<?php
require_once ('../Connection/data-provider.php');
session_start();
header('Content-Type: application/json');
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

$order = $_SESSION['order'];
$id = $order['InvoiceID'];
$dataOrder = $order['CheckoutList'];

if (is_array($data)) {
    $get_invoice_id = "SELECT InvoiceID FROM invoice ORDER BY InvoiceID DESC LIMIT 1";
    $array = get_query($get_invoice_id);
    $acc = $array["InvoiceID"];

    $phone = $data['CustomerPhoneNumber'];
    $givenMoney = $data['CustomerGivenMoney'];
    $paidBack = $data['CustomerPaidBack'];

    if(isset($data['CustomerName']) && isset($data['CustomerAddress']) ){
        $name = $data['CustomerName'];
        $address = $data['CustomerAddress'];
        
        $sql_add_customer = "INSERT INTO customer VALUES ('$phone','$name','$address')";
        pre_statement_without_param_non_query($sql_add_customer);
    }
    
    $sql_add_invoice = "INSERT INTO invoice VALUES ('$id','$phone',CURRENT_DATE(),$givenMoney,$paidBack,'')";
    pre_statement_without_param_non_query($sql_add_invoice);

    for ($i = 0; $i < count($dataOrder); $i++) {
        $barcode = $dataOrder[$i]['ProductBarcode'];
        $numberItems = $dataOrder[$i]['ProductQuantities'];
        $total = $dataOrder[$i]['ProductTotal'];


        $sqlAddInvoiceDetail = "INSERT INTO invoicedetail VALUES ('$id','$barcode',$numberItems,$total)";
        pre_statement_without_param_non_query($sqlAddInvoiceDetail);
    }

    echo json_encode($dataOrder);

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}

?>