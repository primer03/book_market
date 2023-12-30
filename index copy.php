<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <title>Document</title>
</head>
<?php
include_once 'src/navbar.php';
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
    <?php
    include_once 'src/add_area_modal.php';
    ?>
    <div class="container p-5 mx-auto">
        <div class="flex gap-5 justify-center mb-3">
            <input type="number" id="Row" placeholder="Row" class="input input-bordered w-full max-w-xs" />
            <input type="number" id="Col" placeholder="Column" class="input input-bordered w-full max-w-xs" />
            <button id="btnrowcol" class="btn btn-outline btn-accent"><i class="fa-regular fa-floppy-disk"></i> บันทึก</button>
        </div>
        <button id="btn-openmodal" class="btn btn-success mb-3">เพิ่มข้อมูลที่ขาย <i class="fa-solid fa-plus"></i></button>
        <div class="card card-block">
            <div id="card-sale" class="grid gap-2 grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 ">
                <?php
                $datazone = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
                $databorder = ['border-slate-700', 'border-gray-700', 'border-zinc-700', 'border-neutral-700', 'border-stone-700', 'border-red-700', 'border-orange-700', 'border-amber-700', 'border-yellow-700', 'border-lime-700', 'border-green-700', 'border-emerald-700', 'border-teal-700', 'border-cyan-700', 'border-sky-700', 'border-blue-700', 'border-indigo-700', 'border-violet-700', 'border-purple-700', 'border-fuchsia-700', 'border-pink-700', 'border-rose-700'];

                foreach ($databorder as $key => $value) {
                    echo "<div class=\"flex flex-col gap-3 p-3 border-2 $value\"><p>$datazone[$key]</p></div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="src/index.js"></script>

</html>