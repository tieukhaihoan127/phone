<?php
    require_once ('./api/Connection/data-provider.php');
    
    session_start();
    $userName = $_SESSION['username'];

    if(isset($_POST['password']) && isset($_POST['re-password'])) {
        $passwordOld = $_POST['password'];
        $passwordNew = $_POST['re-password'];
        $checkQuery = "SELECT * FROM accountallemployee WHERE UserName ='" .$userName. "' AND PASSWORD ='" .$passwordOld. "'";
        if(check_data_query($checkQuery) == 0) {
            $sql = "UPDATE accountallemployee SET PASSWORD = '" .$passwordNew. "' WHERE UserName = '"  .$userName. "'";
            pre_statement_without_param_non_query($sql);
            header("Location: /FinalWeb/AdminDashboard.php?successMessage=1");
        exit();
        }
        else { 
            header("Location: /FinalWeb/ChangePassword.php?errorMessage=1");
            exit();      
        }
    }
    else {
        echo "Vui lòng nhập đầy đủ thông tin !";
    }
?>