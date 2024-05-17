<?php
    require_once('./save-salesperson-information.php');
    require("vendor/autoload.php");
    use Cloudinary\Configuration\Configuration;
    use Cloudinary\Api\Upload\UploadApi;

    Configuration::instance([
        'cloud' => [
        'cloud_name' => 'dvvdcqzmn', 
        'api_key' => '326819667684664', 
        'api_secret' => 'uHtSnZNFq0uwvqrryB3t7EnnBJM'],
        'url' => [
        'secure' => true]]);

    if(isset($_FILES['avatar'])) {
        $imgName =  $_FILES['avatar']['name'];
        $imgPath = $_FILES['avatar']['tmp_name']; 
        $uploadApi = new UploadApi(); 
        $image = $uploadApi->upload($imgPath); 
        $avatarLink =  $image['secure_url']; 
    }

    $err='';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $conn = get_connection();
        $sql = 'SELECT * FROM accountallemployee WHERE UserName = ?';
        $stmt= $conn->prepare($sql);
        $username = substr($_POST['email'],0,strpos($_POST['email'],"@"));
        $stmt->execute(array($username));
        if($stmt->fetch()){
            $err="your email is used!";
        }else{
            $emailParts = explode('@', $_POST['email']);
            $pass = $emailParts[0];
            echo $pass;
            if(saveNewSaleperson($avatarLink,$pass,$_POST['fullname'],$_POST['email'],$_POST['address'],$_POST['gender'],$_POST['dob']))
            header('location: EmployeesList.php');
        }
}
?>  

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/AddEmployee.css">
    <link rel="stylesheet" href="./assets/css/AdminDashboard.css">
    <title>Add Employee</title>
</head>

<body>
    <div class="main">
        <div class="sider left">
            <a href="/" class="logo">
                <img src="./assets/images/logobig.png" alt="Website Icon">
            </a>
            <div class="menu">
                <ul>

                </ul>
            </div>
        </div>
        <div class="content right">
            <div class="header">
                <div class="header-content">
                    <div class="current-content">
                        Add Employee
                    </div>
                    <div class="current-content-smaller">
                        <div class="web-info">
                            <div class="logo-img">
                                <img src="./assets/images/small-icon.png" alt="">
                            </div>
                            <div class="navbar">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                        </div>
                        <div class="sider-info">
                            <ul>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <div class="text">
                                            Account Management
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-brands fa-product-hunt"></i>
                                        </span>
                                        <div class="text">
                                            Product Management
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <div class="text">
                                            Customer Management
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-solid fa-coins"></i>
                                        </span>
                                        <div class="text">
                                            Transaction Processing
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="menu-item">
                                        <span class="icon-sider">
                                            <i class="fa-solid fa-chart-simple"></i>
                                        </span>
                                        <div class="text">
                                            Reporting and Analytics
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu-content">
                        <div class="menu">
                            <span class="icon-bg">
                                <i class="fa-solid fa-moon"></i>
                            </span>
                            <span class="icon-cart">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div class="number-cart">
                                    5+
                                </div>
                            </span>
                        </div>
                        <div class="information">
                            <div class="admin">
                                <div class="image">
                                    <img src="./assets/images/avatar.jpg" alt="Admin Icon">
                                </div>
                                <div class="admin-info">
                                    <div class="admin-name">
                                        Tieu Khai Hoan
                                    </div>
                                    <div class="role">
                                        Admin
                                    </div>
                                </div>
                            </div>
                            <div class="admin-menu">
                                <div class="menu-desc">
                                    Welcome !
                                </div>
                                <div class="menu-info">
                                    <ul>
                                        <li>
                                            <div class="menu-item">
                                                <span class="icon-sider">
                                                    <i class="fa-solid fa-user"></i>
                                                </span>
                                                <div class="text">
                                                    My Account
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="menu-item">
                                                <span class="icon-sider">
                                                    <i class="fa-solid fa-gear"></i>
                                                </span>
                                                <div class="text">
                                                    Password
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="menu-item">
                                                <span class="icon-sider">
                                                    <i class="fa-solid fa-right-from-bracket"></i>
                                                </span>
                                                <div class="text">
                                                    Logout
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="container">
                    <div class="add-product">
                        <div class="content">
                            <div class="logo">
                                <img src="./assets/images/logobig.png" alt="">
                            </div>
                            <div class="title">
                                Add Employee
                            </div>
                            <form action="AddEmployee.php" method="post" enctype="multipart/form-data">
                                <div class="fifth">
                                    <div class="date-input">
                                        <label for="stock">Full Name</label>
                                        <input type="text" name="fullname" id="fullname" required>
                                    </div>
                                    <div class="barcode-input">
                                        <label for="barcode">Email</label>
                                        <input type="email" name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="third">
                                    <div class="left-input">
                                        <div class="dob">
                                            <label for="stock">Date of Birth</label>
                                            <input type="date" name="dob" id="dob" required>
                                        </div>
                                        <div class="gender">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender">
                                                <option value="male">Nam</option>
                                                <option value="female">Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="email-input">
                                        <label for="email">Phone</label>
                                        <input type="text" name="phone" id="phone" required>
                                    </div>
                                </div>
                                <div class="first">
                                    <div class="address-input">
                                        <label for="retail">Address</label>
                                        <input type="text" name="address" id="address" required>
                                    </div>
                                </div>
                                <div class="fourth">
                                    <div class="picture">
                                        <input name="avatar" type="file" class="custom-file-input" id="customFile" accept="image/gif, image/jpeg, image/png, image/bmp">
                                    </div>
                                    <div class="image">
                                        <img id="ava_preview" src="./assets/images/avatar.jpg" alt="">
                                    </div>
                                    <?php
                                        if($err !=''){
                                            echo '<div style="color: red; background-color: #f3a7a7; border-radius:10px;padding: 10px;"> <label >'.$err.'</label> </div>';
                                        }
                                    ?>
                                    
                                </div>
                                <button class="submit-product" id="submitBtn" type="submit">Done</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/script.js"></script>
    <script>
    const fileInput = document.getElementById('customFile');
    const imagePreview = document.querySelector('#ava_preview');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

</script>
</body>

</html>