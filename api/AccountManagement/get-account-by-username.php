<?php
    require_once ('../Connection/data-provider.php');
    session_start();
    $value = $_SESSION['username'];

    $checkType = "SELECT * FROM accountallemployee WHERE username = '" .$value. "'";
    $array_acc = get_query($checkType);
    $acc_type = $array_acc["AccountType"];

    $checkUser = "SELECT * FROM salesperson WHERE username = '" .$value. "'";
    $array_user = get_query($checkUser);
    $avatar = $array_user["SalesPersonAvatar"];
    $name = $array_user["SalesPersonFullName"];

    if($acc_type == 0) {
        $role = "Admin";
    }
    else {
        $role = "Employee";
    }

    $results = array(
        "Avatar" => $avatar,
        "Name" => $name,
        "Role" => $role
    );
    
    echo json_encode($results);
?>