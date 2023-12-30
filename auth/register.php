<?php
 if(isset($_COOKIE['login'])){
    echo '<script>';
    echo 'window.history.back();';
    echo '</script>';
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <title>register</title>
</head>
<style>
    @font-face {
        font-family: 'Tonphai';
        src: url('../fonts/TonphaiThin.ttf') format('truetype');
    }

    .font-kumo {
        font-family: 'Tonphai';
    }
</style>
<?php
//include_once 'src/navbar.php';
$userdata = ['username' => 'admin', 'password' => '1234'];
// $iv = openssl_random_pseudo_bytes(16);
//$key = "kamenrider123456";

//$cipherText = openssl_encrypt(json_encode($userdata), 'aes-256-cbc', $key, 0, $key);

//setcookie('userdata', $cipherText, time() + (86400 * (30 * 30)), '/');

// $encryptedData = $_COOKIE['userdata'];
// $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $key);
// print_r(json_decode($decryptedData, true));
?>

<body>
    <div class="h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex justify-center items-center">
        <div class="card w-[35rem] p-3 h-auto border-2 bg-white shadow-2xl overflow-auto border-[0.4rem] border-purple-800">
            <div class="flex flex-col w-full items-center gap-4 font-mono">
                <div class="border-[4px] animate-zoomInDown cursor-pointer overflow-hidden border-purple-600 border-dashed h-48 w-48 rounded-full flex relative justify-center items-center">
                    <input accept="image/*" class=" cursor-pointer w-48 h-48 absolute top-0 right-0 opacity-0 rounded-full" type="file" name="" id="">
                    <div id="showimge" class="w-48 h-48 rounded-full flex justify-center items-center">
                        <span class="text-6xl text-violet-600"><i class="fa-solid fa-camera"></i></span>
                        <!-- <img class="w-full h-full object-cover rounded-full" src="https://i.imgur.com/l0KNong.jpg" alt=""> -->
                    </div>
                </div>
                <p class=" text-3xl animate-zoom-animation font-bold font-mono">สมัครสมาชิก</p>
                <form method="post" class="flex flex-col w-full items-center gap-4">
                    <input type="email" name="email" placeholder="Email" class="input input-bordered input-primary w-full" />
                    <div class=" block relative w-full">
                        <span class=" cursor-pointer absolute top-3 right-2 text-xl"><i class="fa-solid fa-eye"></i></span>
                        <input type="password" placeholder="Password" class="input input-bordered input-primary w-full" />
                        <span class="text-red-600 text-xs">*ต้องขิ้นต้นโดยอักษรตัวใหญ่แล้วต้องมีอย่าน้อย 8 ตัว</span>
                    </div>
                    <div class=" block relative w-full">
                        <span class=" cursor-pointer absolute top-3 right-2 text-xl"><i class="fa-solid fa-eye"></i></span>
                        <input type="password" placeholder="Password Confirm" class="input input-bordered input-primary w-full" />
                    </div>
                    <button id="btnsave" type="submit" class="btn  bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500  w-full text-xl text-white">สมัครสมาชิก</button>
                </form>
                <div class="flex w-full gap-3 items-center">
                    <div class="w-full h-[1px] bg-zinc-400"></div>
                    <p class="text-slate-400 font-bold">OR</p>
                    <div class="w-full h-[1px] bg-zinc-400"></div>
                </div>
                <a class=" font-kumo font-bold text-lg  text-purple-800" href="../index.php">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<script src="../src/register.js"></script>

</html>