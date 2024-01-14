<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://i.imgur.com/gzvkzoJ.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <title>MNA</title>
</head>
<!-- <style>
    @font-face {
        font-family: 'Tonphai';
        src: url('fonts/TonphaiThin.ttf') format('truetype');
    }

    .font-kumo {
        font-family: 'Tonphai';
    }
</style> -->
<?php
//include_once 'src/navbar.php';
include_once "Model/UserModel.php";
$userdata = null;
if (isset($_COOKIE['login'])) {
    $user = new UserModel();
    $userdata = $user->get_cookie($_COOKIE['login']);
}
?>

<body>
    <?php
    if (isset($_SERVER['REQUEST_URI'])) {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $url = array_filter($url);
        $url = array_merge($url, array());
        //print_r($url);
        //print_r($url);
        if (isset($url[2])) {
            if ($url[2] == 'register') {
                include_once 'auth/register.php'; 
            }else if($url[2] == 'area'){
                // $area_id = $url[3];
                // include_once 'src/page/area.php';

                if($userdata == 0){
                    setcookie('login', '', time() - 3600, '/');
                    session_destroy();
                    header('location: ../../index.php');
                }else{
                    $area_id = $url[3];
                    include_once 'src/page/area.php';
                }
            }else if($url[2] == 'itembook'){
                if($userdata == 0){
                    setcookie('login', '', time() - 3600, '/');
                    session_destroy();
                    header('location: ../../index.php');
                }else{
                    include_once 'src/page/book.php';
                }
            }else if($url[2] == 'forgot'){
                include_once 'auth/forgot.php';
            }else if($url[2] == 'verifly'){
                include_once 'auth/verifly.php';
            }
        } else {
            if (!isset($_COOKIE['login'])) {
                include_once 'auth/login.php';
            } else {
                if ($userdata == 0) {
                    setcookie('login', '', time() - 3600, '/');
                    session_destroy();
                    header('location: index.php');
                } else {
                    include_once 'src/page/home.php';
                }
            }
        }
    }
    ?>
</body>
<!-- <script src="src/index.js"></script> -->

</html>