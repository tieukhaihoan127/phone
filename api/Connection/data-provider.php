<?php
// Add file connection
require_once('connection.php');


// Check parameters are valid
function check_parameters_valid($parameters)
{
    foreach ($parameters as $parameter) {
        if (!isset($_POST[$parameter])) {
            return false;
        }
    }
    return true;
}


// Get values from method
function get_value_from_method($parameters)
{
    $data = array();
    foreach ($parameters as $parameter) {
        $data[] = $_POST[$parameter];
    }
    return $data;
}


// A prepared statement
function pre_statement($sql, $parameters)
{
    $dbCon = get_connection();
    if ($dbCon) {
        try {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute($parameters);
            return $stmt;
        } catch (PDOException $ex) {
            return null;
        }
    }
    return null;
}

function updateLockData($sql, $parameters)
{
    $dbCon = get_connection();
    if ($dbCon) {
        try {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute($parameters);
            return $stmt;
        } catch (PDOException $ex) {
            return null;
        }
    }
    return null;
}

function pre_statement_without_param($sql)
{
    $dbCon = get_connection();
    if ($dbCon) {
        try {
            $stmt = $dbCon->query($sql);
            return $stmt;
        } catch (PDOException $ex) {
            return null;
        }
    }
    return null;
}

function pre_statement_without_param_non_query($sql)
{
    $dbCon = get_connection();
    if ($dbCon) {
        try {
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
        } catch (PDOException $ex) {
        }
    }
}

function check_sql_query_statement($sql) {
    $dbCon = get_connection();
    if ($dbCon) {
        try {
            $stmt = $dbCon->prepare($sql);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            return false;
        }
    }
    return false;
}

function get_query($sql)
{
    $dbCon = get_connection();
    if ($dbCon) {
        try {
            $stmt = $dbCon->query($sql);
            if ($stmt) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row; 
            } else {
                return null;
            }
        } catch (PDOException $ex) {
        }
    }
}

function get_query_all($sql)
{
    $dbCon = get_connection();
    if ($dbCon) {
        try {
            $stmt = $dbCon->query($sql);
            if ($stmt) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row; 
            } else {
                return null;
            }
        } catch (PDOException $ex) {
        }
    }
}


// Get data function is used for insert statement
function get_data($sql, $parameters)
{
    if (check_parameters_valid($parameters)) {
        $stmt = pre_statement($sql, get_value_from_method($parameters));
        if ($stmt) {
            $data = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }
    return null;
}

function get_data_without_param($sql)
{
    $stmt = pre_statement_without_param($sql);
    if ($stmt) {
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    echo "Khong";
    return null;
}


// Get data convert to json
function get_data_convert_json($sql, $parameters = array())
{
    $result = get_data($sql, $parameters);
    if (is_array($result)) {
        return json_encode(array('status' => true, 'selected_rows' => count($result), 'data' => $result));
    }
    return json_encode(array('status' => false, 'data' => 'Failure'));
}

function get_data_convert_json_without_param($sql, $parameters = array())
{
    $result = get_data_without_param($sql);
    if (is_array($result)) {
        return json_encode(array('status' => true, 'selected_rows' => count($result), 'data' => $result));
    }
    return json_encode(array('status' => false, 'data' => 'Failure'));
}


// Change data function is used for update, delete statement
function change_data($sql, $parameters)
{
    if (check_parameters_valid($parameters)) {
        $stmt = pre_statement($sql, get_value_from_method($parameters));
        if ($stmt) {
            return $stmt->rowCount();
        }
        return null;
    }
    return null;
}

function check_data_query($sql)
{
    $dbCon = get_connection();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return 0;
    } else {
        return 1;
    }
}

// function check_row_count($sql)
// {
//     $stmt = pre_statement_without_param_non_query($sql);
//     if ($stmt) {
//         return $stmt->rowCount();
//     }
//     return null;
// }


// Change data convert to json 
function change_data_covert_json($sql)
{
    $result = pre_statement_without_param_non_query($sql);
    if ($result >= 0) {
        return json_encode(array("status" => true, "message" => "Update data successfully"));
    }
    return json_encode(array('status' => false, 'message' => 'Update data unsuccessfully'));
}

/*
        Process to convertson
        get_data_convert_json -> get_data -> check_parameters_valid -> get_value_from_method

    */
