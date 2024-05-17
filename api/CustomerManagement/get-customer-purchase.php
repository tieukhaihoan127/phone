<?php
require_once ('../Connection/data-provider.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM customer WHERE CustomerNumberphone = '$id'";
        $array_user = get_query($sql);

        $phone = $array_user["CustomerNumberphone"];
        $customer_name =  $array_user["CustomerName"];
        $customer_address = $array_user["CustomerAddress"];

        $sql_invoice = "SELECT InvoiceID, DATE_FORMAT(InvoiceDateTime, '%d/%m/%Y') AS InvoiceDateTime, AmountMoneyCustomerGiven, AmountMoneyBackCustomer FROM invoice WHERE CustomerNumberPhone = '$id'";
        $array_invoice = get_query_all($sql_invoice);
        $array_detail_invoice = array();

        if(!empty($array_invoice)) {
            for($i = 0;$i < count($array_invoice);$i++) {
                $invoice_id = $array_invoice[$i]['InvoiceID'];
                $invoice_date = $array_invoice[$i]['InvoiceDateTime'];
                $invoice_given = $array_invoice[$i]['AmountMoneyCustomerGiven'];
                $invoice_paid = $array_invoice[$i]['AmountMoneyBackCustomer'];
                
                $sql_get_product = "SELECT SUM(NumberOfItem) AS InvoiceQuantities FROM invoicedetail WHERE InvoiceID = '$invoice_id'";
                $arr = get_query($sql_get_product);
                $quantities = $arr["InvoiceQuantities"];

    
                $invoice_detail = new stdClass();
                
                $invoice_detail -> OrderID = $invoice_id;
                $invoice_detail -> OrderDateTime = $invoice_date;
                $invoice_detail -> OrderCustomerGivenMoney = $invoice_given;
                $invoice_detail -> OrderCustomerPaidBack = $invoice_paid;
                $invoice_detail -> OrderQuantities = $quantities;
                array_push($array_detail_invoice,$invoice_detail);
            }
        }

        $results = array(
            "CustomerName" => $customer_name,
            "CustomerPhone" => $phone,
            "CustomerAddress" => $customer_address,
            "OrderList" => $array_detail_invoice
        );

        echo json_encode($results);
    }
?>