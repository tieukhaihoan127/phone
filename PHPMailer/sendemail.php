<?php
    require_once ('exceptions.php');
    require_once ('phpmailer.php');
    require_once ('smtp.php');

    function get_connect () {
        header('Access-Control-Allow-Origin: *');
    
        $host = '127.0.0.1:3306';
        $dbName = 'PhoneSystemMangement';
        $username = 'root';
        $password = '';
        try{
            $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $dbCon;
        }
        catch(PDOException $ex){
            return null;
        }
    }
    
    function send_email ($email) {
        $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'nlgbaosw@gmail.com';
            $mail->Password = 'rgnf iqfm eynb auuv';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('nlgbaosw@gmail.com');
            $mail->addAddress($email);
            $mail->Subject = 'DE';
            $token = createToken($email);
            $mail->Body = "Bạn phải truy cập đường dẫn sau đây để đăng nhập vào trang web : <br> 'http://localhost:8080/FinalWeb/Login.php?email=$email&token=$token'";
            $mail->send();
    }
    function createToken($email){
        $rand = random_int(0,1000);
        $token = md5($rand);
        $conn = get_connect();
        $sql='INSERT INTO active(email,token,time) VALUES (?,?,?)';
        $stmt = $conn->prepare($sql);
        $expiryTime = time() + 1200;
        // Ràng buộc các tham số
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $token, PDO::PARAM_STR);
        $stmt->bindParam(3, $expiryTime, PDO::PARAM_INT);
        $stmt->execute();
        return $token;
    }
?>