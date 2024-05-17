<?php
session_start();
require_once('./PHPMailer/sendemail.php');
require_once('./data-provider.php');
function checkToken($email, $token) {
    $sql = 'SELECT * FROM active WHERE email = ? AND token = ?';
    $conn = get_connection();
    $stmt = $conn->prepare($sql);
    if ($stmt->execute(array($email, $token))) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (time() < $data['time']) {
            return true;
        }
        return false;
    }
    return false;
}
if(isset($_SESSION['token'])){
    $flag = checkToken($_SESSION['email'],$_SESSION['token']);
}else if (isset($_GET['email']) && isset($_GET['token'])) {
    $flag = checkToken($_GET['email'], $_GET['token']);
    if($flag){
        $_SESSION['email'] = $_GET['email'];
        $_SESSION['token'] = $_GET['token'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = get_connection();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'SELECT * FROM accountallemployee as a, salesperson as s WHERE a.UserName = ? AND a.UserName = s.UserName';
    $stmt = $conn->prepare($sql);
    if ($stmt->execute(array($username))) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data && $data['PASSWORD'] == $password) {
            if ($data['SalesPersonInactivate'] == 1) {
                if (isset($flag) && $flag) {
                    $_SESSION['username'] = $username;
                    header('location: ChangePassword.php');
                    exit();
                } else {
                    $error = 'Tài khoản chưa xác thực';
                    echo $error;
                }
            } else {
                $_SESSION['username'] = $username;
                header('location: AdminDashboard.php');
                exit();
            }
        } else {
            $error = 'Tên người dùng hoặc mật khẩu không đúng';
            echo $error;
        }
    } else {
        $error = 'Lỗi cơ sở dữ liệu';
        echo $error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/Login.css">
    <link rel="stylesheet" href="./assets/css/base.css">

    <title>Login</title>
</head>

<body>
    <div class="login">
        <div class="first-content">
            <div class="image">
                <img src="./assets/images/logobig.png" alt="">
            </div>
            <div class="title">Sign In</div>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>
        <input type="text" placeholder="Username" name="username" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <div class="func">
                <div class="remember">
                    <input type="checkbox" id="remember" name="remember" value="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div class="forget">Forget Password</div>
            </div>
            <button class="sign-in">Sign In</button>
        </form>
    </div>

    <script src="./script.js"></script>
</body>

</html>