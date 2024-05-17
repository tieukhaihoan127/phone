<?php
require_once ('../Connection/data-provider.php');
header('Content-Type: application/json');
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

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
    
    $sql_update_invoice = "UPDATE invoice SET CustomerNumberPhone = '$phone', AmountMoneyCustomerGiven = '$givenMoney', AmoutMoneyBackCustomer = '$paidBack' WHERE InvoiceID = '$acc'";

    pre_statement_without_param_non_query($sql_update_invoice);

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}

?>