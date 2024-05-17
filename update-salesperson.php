<?php
    require_once ('./api/Connection/data-provider.php');
    require("vendor/autoload.php");
    use Cloudinary\Configuration\Configuration;
    use Cloudinary\Api\Upload\UploadApi;
    
    session_start();
    $userName = $_SESSION['username'];

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

    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE salesperson SET SalesPersonAvatar = '$avatarLink', SalesPersonFullName = '$fullName', SalesPersonEmailAddress = '$email', SalesPersonAddress = '$address', SalesPersonGender = '$gender' , SalesPersonDateOfBirth = '$dob' WHERE UserName = '$userName'";
    pre_statement_without_param_non_query($sql);
    header("Location: /FinalWeb/AdminDashboard.php");

?>