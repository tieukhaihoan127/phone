<?php
    // print_r($_GET);
    require_once ('./data-provider.php');
    require_once ('./PHPMailer/sendemail.php');
    
    function saveNewSaleperson($ava,$pass,$fullname,$email,$address,$gender,$dob){
        $paramenters = array ($ava,$pass,$fullname, $email,$address,$gender,$dob);
        $sql = 'CALL USP_SaveNewSalesperson (?,?,?,?,?,?,?)';

        $json_data = change_data_covert_json($sql, $paramenters);
        // echo $json_data; 
        print_r($json_data);
        // Send email in PHP
        $array_data = json_decode($json_data, true);
        if (is_array($array_data)){
            if ($array_data['affected_row'] > 1) {
                send_email($email);
                return true;
            }
        }
        return false;
    }
?>