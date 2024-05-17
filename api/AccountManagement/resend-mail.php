<?php
    require_once("../../PHPMailer/sendemail.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
                send_email($email);
                echo json_encode(['status' => 'success', 'message' => 'Email sent successfully.']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
        }
    }
?>