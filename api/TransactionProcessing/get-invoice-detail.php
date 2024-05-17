<?php
require_once ('../Connection/data-provider.php');

session_start();

$get_invoice = "SELECT * FROM invoice ORDER BY InvoiceID DESC LIMIT 1";

$array_id = get_query($get_invoice);
$id = $array_id["InvoiceID"];


$get_date = "SELECT DATE_FORMAT(InvoiceDateTime, '%d/%m/%Y') AS InvoiceDate FROM invoice ORDER BY InvoiceID DESC LIMIT 1";

$array_date = get_query($get_date);
$dop = $array_date["InvoiceDate"];


$get_sum = "SELECT SUM(UnitPrice) as TotalSum FROM invoicedetail WHERE InvoiceID = '$id'";

$array_sum = get_query($get_sum);
$sum = $array_sum["TotalSum"];

$value = $_SESSION['username'];
$get_name = "SELECT SalesPersonFullName FROM salesperson WHERE SalesPersonID IN (SELECT SalesPersonID FROM accountallemployee WHERE UserName = '$value')";
$array = get_query($get_name);
$name = $array["SalesPersonFullName"];


$results = array(
    "EmployeeName" => $name,
    "InvoiceID" => $id,
    "InvoiceDateTime" => $dop,
    "TotalSum" => $sum
);

echo json_encode($results);

?>