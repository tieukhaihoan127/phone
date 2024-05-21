<?php
require_once ('../Connection/data-provider.php');
// Lấy dữ liệu từ session đã lưu truyền tới checkout information
session_start();

$data = $_SESSION['order'];

$results = array(
    "EmployeeName" => $data['EmployeeName'],
    "InvoiceID" => $data['InvoiceID'],
    "InvoiceDateTime" => $data['InvoiceDateTime'],
    "TotalSum" => $data['TotalSum']
);

echo json_encode($results);

?>