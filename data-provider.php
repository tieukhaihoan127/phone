<?php
    // Add file connection
    require_once ('./connection.php');
    

    //Check parameters are valid
    function check_parameters_valid ($parameters) {
        
        foreach ($parameters as $parameter) {
            if (!isset($parameter)) {
            // if (!isset($_POST[$parameter])) {
                return false;
            }
        }
        return true;
    }

    // function check_parameters_valid ($parameters) {
        
    //     foreach ($parameters as $parameter) {
    //         if ($parameter == '') {
    //             print_r($parameter);
    //             return false;
    //         }
    //     }
    //     return true;
    // }

    // Get values from method
    function get_value_from_method ($parameters) {
        $data = array();
        foreach ($parameters as $parameter) {
            array_push($data,$parameter);
        }
        return $data;
    }

    // A prepared statement
    function pre_statement ($sql, $parameters) {
        $dbCon = get_connection();
        
        if ($dbCon) {
            try{
                $stmt = $dbCon->prepare($sql);
                $stmt->execute($parameters);
                return $stmt;
            }
            catch(PDOException $ex){
                return null;
            }
        }
        return null;
    }


    // Get data function is used for insert statement
    function get_data ($sql , $parameters) {
        
        if (check_parameters_valid($parameters)) {
            $stmt = pre_statement ($sql, get_value_from_method ($parameters));
            if ($stmt) {
                $data = array();
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    array_push($data,$row);
                }
                
                return $data;
            }
            return null;
        }
        return null;
    }

    
    // Get data convert to json
    function get_data_convert_json ($sql, $parameters = array()) {
        $result = get_data($sql, $parameters);
        if (is_array($result)) {
            return json_encode(array('status' => true, 'selected_rows' => count($result), 'data' => $result));
        }
        return json_encode(array('status' => false, 'data' => 'Failure'));

    }


    // Change data function is used for update, delete statement
    function change_data ($sql , $parameters) {
            // print_r($parameters);
        if (check_parameters_valid($parameters)) {
            $stmt = pre_statement ($sql, get_value_from_method ($parameters));
            // return $parameters;/
            if ($stmt) {
                return $stmt->rowCount();
            }   
            
            return null;
        }else {
            // print_r("ádas");
            # code...
        }
        return null;
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


    // Change data convert to json 
    function change_data_covert_json ($sql , $parameters) {
        
        $result = change_data ($sql , $parameters);
        // print_r($result);
        if ($result >= 0) {
            return json_encode(array('status' => true, 'affected_row' => $result , 'data' => 'Successfully'));
        }
        return json_encode(array('status' => false, 'data' => 'Failure'));
    }

    /*
        Process to convertson
        get_data_convert_json -> get_data -> check_parameters_valid -> get_value_from_method
        get_data_convert_json : lấy data dưới dạng json, tham số: câu lệnh sql và tham số
        
    */

?>