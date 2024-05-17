<?php
    require_once ('../Connection/data-provider.php');
    
    if(isset($_GET['status'])) {
        $status = $_GET['status'];
    } else {
        $status = null;
    }

    if(isset($_GET['first']) && isset($_GET['second'])){
        $first = $_GET['first'];
        $second = $_GET['second'];
        $sql = "SELECT invoice.InvoiceID, customer.CustomerName, invoice.AmountMoneyCustomerGiven, invoice.AmountMoneyBackCustomer, DATE_FORMAT(invoice.InvoiceDateTime, '%d/%m/%Y') AS InvoiceDateTime, SUM(invoicedetail.NumberOfItem) AS InvoiceQuantites FROM invoice,customer,invoicedetail  WHERE customer.CustomerNumberphone = invoice.CustomerNumberPhone AND invoice.InvoiceID = invoicedetail.InvoiceID AND invoice.InvoiceDateTime BETWEEN '$first' AND '$second' GROUP BY(invoice.InvoiceID) ORDER BY invoice.InvoiceDateTime DESC";
        echo get_data_convert_json_without_param($sql);  
        exit();
    }
    else {
        if($status == null) {
            $sql = "SELECT invoice.InvoiceID, customer.CustomerName, invoice.AmountMoneyCustomerGiven, invoice.AmountMoneyBackCustomer, DATE_FORMAT(invoice.InvoiceDateTime, '%d/%m/%Y') AS InvoiceDateTime, SUM(invoicedetail.NumberOfItem) AS InvoiceQuantites FROM invoice,customer,invoicedetail  WHERE customer.CustomerNumberphone = invoice.CustomerNumberPhone AND invoice.InvoiceID = invoicedetail.InvoiceID GROUP BY(invoice.InvoiceID) ORDER BY invoice.InvoiceDateTime DESC";
        }
        else {
            if($status == "today"){
                $sql = "SELECT invoice.InvoiceID, customer.CustomerName, invoice.AmountMoneyCustomerGiven, invoice.AmountMoneyBackCustomer, DATE_FORMAT(invoice.InvoiceDateTime, '%d/%m/%Y') AS InvoiceDateTime, SUM(invoicedetail.NumberOfItem) AS InvoiceQuantites FROM invoice,customer,invoicedetail  WHERE customer.CustomerNumberphone = invoice.CustomerNumberPhone AND invoice.InvoiceID = invoicedetail.InvoiceID AND invoice.InvoiceDateTime = CURRENT_DATE() GROUP BY(invoice.InvoiceID) ORDER BY invoice.InvoiceDateTime DESC";
            }
            else if($status == "yesterday"){
                $sql = "SELECT invoice.InvoiceID, customer.CustomerName, invoice.AmountMoneyCustomerGiven, invoice.AmountMoneyBackCustomer, DATE_FORMAT(invoice.InvoiceDateTime, '%d/%m/%Y') AS InvoiceDateTime, SUM(invoicedetail.NumberOfItem) AS InvoiceQuantites FROM invoice,customer,invoicedetail  WHERE customer.CustomerNumberphone = invoice.CustomerNumberPhone AND invoice.InvoiceID = invoicedetail.InvoiceID AND DATE(invoice.InvoiceDateTime) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) GROUP BY(invoice.InvoiceID) ORDER BY invoice.InvoiceDateTime DESC";
            }
            else if($status == "week") {
                $sql = "SELECT invoice.InvoiceID, customer.CustomerName, invoice.AmountMoneyCustomerGiven, invoice.AmountMoneyBackCustomer, DATE_FORMAT(invoice.InvoiceDateTime, '%d/%m/%Y') AS InvoiceDateTime, SUM(invoicedetail.NumberOfItem) AS InvoiceQuantites FROM invoice,customer,invoicedetail  WHERE customer.CustomerNumberphone = invoice.CustomerNumberPhone AND invoice.InvoiceID = invoicedetail.InvoiceID AND InvoiceDateTime > DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND InvoiceDateTime <= CURRENT_DATE() GROUP BY(invoice.InvoiceID) ORDER BY invoice.InvoiceDateTime DESC";
            }
            else if($status == "month"){
                $sql = "SELECT invoice.InvoiceID, customer.CustomerName, invoice.AmountMoneyCustomerGiven, invoice.AmountMoneyBackCustomer, DATE_FORMAT(invoice.InvoiceDateTime, '%d/%m/%Y') AS InvoiceDateTime, SUM(invoicedetail.NumberOfItem) AS InvoiceQuantites FROM invoice,customer,invoicedetail  WHERE customer.CustomerNumberphone = invoice.CustomerNumberPhone AND invoice.InvoiceID = invoicedetail.InvoiceID AND MONTH(invoice.InvoiceDateTime) = MONTH(CURRENT_DATE()) GROUP BY(invoice.InvoiceID) ORDER BY invoice.InvoiceDateTime DESC";
            }
            else {
                $sql = "SELECT invoice.InvoiceID, customer.CustomerName, invoice.AmountMoneyCustomerGiven, invoice.AmountMoneyBackCustomer, DATE_FORMAT(invoice.InvoiceDateTime, '%d/%m/%Y') AS InvoiceDateTime, SUM(invoicedetail.NumberOfItem) AS InvoiceQuantites FROM invoice,customer,invoicedetail  WHERE customer.CustomerNumberphone = invoice.CustomerNumberPhone AND invoice.InvoiceID = invoicedetail.InvoiceID GROUP BY(invoice.InvoiceID) ORDER BY invoice.InvoiceDateTime DESC";
            }
        }
        echo get_data_convert_json_without_param($sql);  
        exit();
    }
?>