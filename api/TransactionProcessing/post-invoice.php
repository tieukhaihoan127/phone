<?php
require_once ('../Connection/data-provider.php');
session_start();
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

    $get_date = "SELECT DATE_FORMAT(CURRENT_DATE(), '%d/%m/%Y') AS InvoiceDate";
    $array_date = get_query($get_date);
    $date = $array_date["InvoiceDate"];

    $value = $_SESSION['username'];
    $get_name = "SELECT SalesPersonFullName FROM salesperson WHERE SalesPersonID IN (SELECT SalesPersonID FROM accountallemployee WHERE UserName = '$value')";
    $array = get_query($get_name);
    $name = $array["SalesPersonFullName"];

    $sum = 0;

    for ($i = 0; $i < count($data); $i++) {
        $sum+=$data[$i]['ProductTotal'];
    }

    $results = array(
        "EmployeeName" => $name,
        "InvoiceID" => $id,
        "InvoiceDateTime" => $date,
        "TotalSum" => $sum,
        "CheckoutList" => $data
    );

    // Lưu thông tin sản phẩm vào session
    $_SESSION['order'] = $results;
    echo json_encode($results);

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}

?>