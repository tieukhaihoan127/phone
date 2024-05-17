<?php
    use Cloudinary\Configuration\Configuration;

    // configure an instance via a JSON object

    $cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'my_cloud_name',
        'api_key'  => 'my_key',
        'api_secret' => 'my_secret',
    'url' => [
        'secure' => true]]]);

?>