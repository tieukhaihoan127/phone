<?php
require_once ('../Connection/data-provider.php');
header('Content-Type: application/json');
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (is_array($data)) {
    $get_invoice_id = "SELECT InvoiceID FROM invoice ORDER BY InvoiceID DESC LIMIT 1";
    $array = get_query($get_invoice_id);
    $acc = $array["InvoiceID"];
    $number = (int)substr($acc, 1);
    $number++;
    $id = "";

    if($number < 10) {
        $id = "T0000000000".(string)($number);
    }
    else if($number < 100) {
        $id = "T000000000".(string)$number;
    }
    else if($number < 1000) {
        $id = "T00000000".(string)$number;
    }
    else if($number < 10000) {
        $id = "T0000000".(string)$number;
    }
    else if($number < 100000) {
        $id = "T000000".(string)$number;
    }
    else if($number < 1000000) {
        $id = "T00000".(string)$number;
    }
    else if($number < 10000000) {
        $id = "T0000".(string)$number;
    }
    else if($number < 100000000) {
        $id = "T000".(string)$number;
    }
    else if($number < 1000000000) {
        $id = "T00".(string)$number;
    }
    else if($number < 10000000000) {
        $id = "T0".(string)$number;
    }
    else if($number < 100000000000) {
        $id = "T".(string)$number;
    }

    $sqlAddInvoice = "INSERT INTO invoice VALUES ('$id','0000000000',CURRENT_DATE(),0,0)";

    pre_statement_without_param_non_query($sqlAddInvoice);

    for ($i = 0; $i < count($data); $i++) {
        $barcode = $data[$i]['ProductBarcode'];
        $numberItems = $data[$i]['ProductQuantities'];
        $total = $data[$i]['ProductTotal'];


        $sqlAddInvoiceDetail = "INSERT INTO invoicedetail VALUES ('$id','$barcode',$numberItems,$total)";
        pre_statement_without_param_non_query($sqlAddInvoiceDetail);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}

?>