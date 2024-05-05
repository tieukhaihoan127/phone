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
        <form action="">
            <input type="text" placeholder="Username" name="username" required>
            <input type="text" placeholder="Password" name="password" required>
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