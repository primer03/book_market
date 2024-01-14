<?php
include_once "../Model/UserModel.php";
// echo $_SESSION['user_status'];
if (!isset($_COOKIE['login'])) {
    header('location: ../index.php');
} else {
    $user = new UserModel();
    $userdata = $user->get_cookie($_COOKIE['login']);
    if ($userdata == 0) {
        setcookie('login', '', time() - 3600, '/');
        session_destroy();
        header('location: ../index.php');
    } else {
        if (isset($_SESSION['user_status'])) {
            if ($_SESSION['user_status'] == 0) {
                header('location: ../index.php');
            }
        }
    }
}
$page = 'แดชบอร์ด';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="https://i.imgur.com/gzvkzoJ.png" />
    <title>ระบบจัดการพื้นที่ขาย</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link href="./assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Hello!</h3>
        <p class="py-4">Press ESC key or click the button below to close</p>
        <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <?php include_once "widget/sidebar.php" ?>
    <main class="ease-soft-in-out xl:ml-68.5 relative overflow-auto h-full max-h-screen rounded-xl transition-all duration-200">
        <?php include_once "widget/navbar.php" ?>
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->
            <?php include_once "./widget/report.php" ?>
            <!-- end row 1 -->
            <?php include_once "./widget/area_report.php" ?>
        </div>
    </main>
</body>
<script src="./assets/js/plugins/chartjs.min.js" async></script>
<!-- <script src="./assets/js/plugins/perfect-scrollbar.min.js" async></script> -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="./assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>

</html>