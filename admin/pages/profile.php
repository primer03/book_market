<?php
include_once "../../Model/UserModel.php";
include_once "../../Model/AreaModel.php";
// echo $_SESSION['user_status'];
if (!isset($_COOKIE['login'])) {
    header('location: ../index.php');
} else {
    $user = new UserModel();
    $userdata = $user->get_cookie($_COOKIE['login']);
    if (isset($_SESSION['user_status'])) {
        if ($_SESSION['user_status'] == 0) {
            header('location: ../index.php');
        }
    }
}
$page = 'โปรไฟล์'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../dist/output.css">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="https://i.imgur.com/gzvkzoJ.png" />
    <title>ระบบจัดการพื้นที่ขาย</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Main Styling -->
    <link href="../assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css" integrity="sha512-d0olNN35C6VLiulAobxYHZiXJmq+vl+BGIgAxQtD5+kqudro/xNMvv2yIHAciGHpExsIbKX3iLg+0B6d0k4+ZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<?php
$gradient_b = [
    "bg-gradient-to-b from-purple-700 to-cyan-400",
    "bg-gradient-to-b from-blue-700 to-green-400",
    "bg-gradient-to-b from-indigo-700 to-yellow-400",
    "bg-gradient-to-b from-pink-700 to-amber-400",
    "bg-gradient-to-b from-red-700 to-teal-400",
    "bg-gradient-to-b from-orange-700 to-blue-400",
    "bg-gradient-to-b from-yellow-700 to-indigo-400",
    "bg-gradient-to-b from-green-700 to-purple-400",
    "bg-gradient-to-b from-teal-700 to-red-400",
    "bg-gradient-to-b from-blue-700 to-orange-400",
    "bg-gradient-to-b from-cyan-700 to-purple-400",
    "bg-gradient-to-b from-rose-700 to-amber-400",
    "bg-gradient-to-b from-lime-700 to-violet-400",
    "bg-gradient-to-b from-fuchsia-700 to-yellow-400",
    "bg-gradient-to-b from-emerald-700 to-red-400",
    "bg-gradient-to-b from-indigo-700 to-rose-400",
    "bg-gradient-to-b from-cyan-700 to-fuchsia-400",
    "bg-gradient-to-b from-purple-700 to-lime-400",
    "bg-gradient-to-b from-amber-700 to-emerald-400",
    "bg-gradient-to-b from-teal-700 to-blue-400",
    "bg-gradient-to-b from-red-700 to-yellow-400",
    "bg-gradient-to-b from-green-700 to-indigo-400",
    "bg-gradient-to-b from-orange-700 to-pink-400",
    "bg-gradient-to-b from-yellow-700 to-rose-400",
    "bg-gradient-to-b from-blue-700 to-lime-400",
    "bg-gradient-to-b from-purple-700 to-indigo-400",
    "bg-gradient-to-b from-pink-700 to-amber-400",
    "bg-gradient-to-b from-teal-700 to-red-400",
    "bg-gradient-to-b from-orange-700 to-cyan-400",
    "bg-gradient-to-b from-green-700 to-yellow-400",
    "bg-gradient-to-b from-indigo-700 to-fuchsia-400",
    "bg-gradient-to-b from-lime-700 to-rose-400",
    "bg-gradient-to-b from-blue-700 to-amber-400",
    "bg-gradient-to-b from-yellow-700 to-red-400",
    "bg-gradient-to-b from-cyan-700 to-indigo-400",
    "bg-gradient-to-b from-purple-700 to-blue-400",
    "bg-gradient-to-b from-red-700 to-green-400",
    "bg-gradient-to-b from-orange-700 to-teal-400",
    "bg-gradient-to-b from-fuchsia-700 to-yellow-400",
    "bg-gradient-to-b from-emerald-700 to-indigo-400",
];
$userData = $user->getUser();
$DescUserData = $userData;
sort($DescUserData);
?>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <?php include_once "../widget/sidebar.php" ?>
    <main class="ease-soft-in-out xl:ml-68.5 relative overflow-auto h-full max-h-screen h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <?php include_once "../widget/navbar.php" ?>
        <div class="w-full px-6 py-6 mx-auto">
            <!-- <div class="flex flex-col sm:flex-row justify-between items-center mb-3">
                <h3 class="text-2xl font-bold flex-shrink-0">จัดการข้อมูลผู้ใช้</h3>
                <div class=" flex flex-col sm:flex-row gap-2 w-full flex-wrap justify-end">
                    <button type="button" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700" onclick="addData()"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูล</button>
                    <button type="button" id="BtnSelectEdit" class="py-3 px-8 duration-200 hover:bg-yellow-500 hover:text-white rounded-lg text-yellow-500 border-2 border-yellow-500"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูล</button>
                    <button type="button" id="BtnDeleteSelect" class="py-3 px-8 duration-200 hover:bg-red-700 hover:text-white rounded-lg text-red-700 border-2 border-red-700"><i class="fa-solid fa-trash"></i> ลบข้อมูล</button>
                </div>
            </div> -->
            <!-- content -->
            <div class="w-full max-w-2xl mx-auto animate-fadeIn bg-white p-3 rounded-lg shadow-lg">
                <div class=" flex gap-3 w-full flex-col items-center sm:flex-col sm:items-center md:items-stretch md:flex-row">
                    <div class=" flex flex-col gap-3 flex-shrink-0">
                        <div class=" group w-56 h-auto flex flex-col gap-3 relative">
                            <span id="saveImage" class=" z-50 absolute top-0 left-0 p-1 text-xs cursor-pointer text-white rounded-md duration-150 active:scale-95 bg-violet-500 hover:-translate-y-1 hover:shadow-md hover:shadow-violet-600"><i class="fa-regular fa-floppy-disk"></i> บันทึก</span>
                            <div class=" duration-150 group-active:scale-90 w-full h-56 rounded-full relative">
                                <div class="  cursor-pointer w-full h-full rounded-full border-[6px] border-violet-500 shadow-xl overflow-hidden">
                                    <img id="ImageShow" class="w-full h-full rounded-full object-cover" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['user_image_data']) ?>" alt="">
                                    <input id="uploadImage" class="z-20 cursor-pointer absolute opacity-0 top-0 left-0 w-full h-full" type="file" name="">
                                </div>
                                <span class="z-20 border-[4px] border-white bottom-2 right-1 text-white absolute flex justify-center items-center h-14 w-14 rounded-full bg-violet-500 text-xl"><i class="fa-solid fa-camera"></i></span>
                            </div>
                            <!-- <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" id="uploadImage" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                            </label> -->
                        </div>
                    </div>
                    <div class="h-auto w-[1px] bg-gray-400"></div>
                    <div class=" w-full flex flex-col gap-3">
                        <div>
                            <label for="">อีเมล</label>
                            <div class=" flex gap-1">
                                <input type="text" id="email" class="input input-bordered w-full input-primary" placeholder="อีเมล" value="<?php echo $_SESSION['user_email'] ?>" />
                                <button type="button" id="btnEditEmail" class="py-2 px-4 duration-200 hover:bg-violet-700 hover:text-white rounded-lg text-violet-700 border-2 border-violet-700">แก้ไข</button>
                            </div>
                        </div>
                        <div class="">
                            <p>เปลี่ยนรหัสผ่าน</p>
                            <div class=" flex gap-1">
                                <input type="password" id="password" class="input input-bordered w-full input-primary" placeholder="รหัสผ่านเดิม" />
                                <button type="button" id="btnEditPassword" class="py-2 px-4 duration-200 hover:bg-violet-700 hover:text-white rounded-lg text-violet-700 border-2 border-violet-700 flex-shrink-0">ตรวจสอบ</button>
                            </div>
                        </div>
                        <div id="CardInput"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<script>
    var ImageShow = document.getElementById('ImageShow');
    var uploadImage = document.getElementById('uploadImage');
    var saveImage = document.getElementById('saveImage');
    var imageLogo = document.getElementById('imageLogo');
    var btnEditPassword = document.getElementById('btnEditPassword');
    btnEditEmail = document.getElementById('btnEditEmail');

    btnEditPassword.addEventListener('click', async () => {
        var password = document.getElementById('password').value;
        const regpsw = /^[A-Z][a-zA-Z0-9]{7,}$/;
        if (password != "") {
            if (regpsw.test(password)) {
                var formData = new FormData();
                formData.append('status', 'checkPassword');
                formData.append('user_id', <?php echo $_SESSION['user_id']; ?>);
                formData.append('user_password', password);
                var response = await fetch('../../rest/rest.php', {
                    method: 'POST',
                    body: formData
                });
                if (response.ok) {
                    var result = await response.json();
                    if (result.status == 'success') {
                        document.getElementById('password').disabled = true;
                        btnEditPassword.disabled = true;
                        console.log(password);
                        var CardInput = document.getElementById('CardInput');
                        CardInput.innerHTML += `
                            <p>รหัสผ่านใหม่</p>
                            <div class=" animate-zoom-animation flex gap-1">
                                <input type="password" id="newpassword" class="input input-bordered w-full input-primary" placeholder="รหัสผ่านใหม่" />
                                <button type="button" id="btnSavePassword" class="py-2 px-4 duration-200 hover:bg-violet-700 hover:text-white rounded-lg text-violet-700 border-2 border-violet-700 flex-shrink-0">บันทึก</button>
                            </div>`

                        var btnSavePassword = document.getElementById('btnSavePassword');
                        btnSavePassword.addEventListener('click', async () => {
                            var newpassword = document.getElementById('newpassword').value;
                            if (newpassword != "") {
                                if (regpsw.test(newpassword)) {
                                    var formData = new FormData();
                                    formData.append('status', 'updatePassword');
                                    formData.append('user_id', <?php echo $_SESSION['user_id']; ?>);
                                    formData.append('user_password', newpassword);
                                    var response = await fetch('../../rest/rest.php', {
                                        method: 'POST',
                                        body: formData
                                    });
                                    if (response.ok) {
                                        var result = await response.json();
                                        if (result.status == 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: result.msg,
                                                text: result.msg,
                                                showConfirmButton: false,
                                                timer: 1500
                                            });
                                            document.getElementById('password').disabled = false;
                                            document.getElementById('password').value = "";
                                            document.getElementById('newpassword').value = "";
                                            CardInput.innerHTML = "";
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: result.msg,
                                                text: result.msg,
                                                showConfirmButton: false,
                                                timer: 1500
                                            });
                                        }
                                    }
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'กรุณากรอกรหัสผ่านให้ถูกต้อง',
                                        text: 'กรุณากรอกรหัสผ่านให้ถูกต้อง',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'กรุณากรอกรหัสผ่านใหม่',
                                    text: 'กรุณากรอกรหัสผ่านใหม่',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: result.msg,
                            text: result.msg,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณากรอกรหัสผ่านให้ถูกต้อง',
                    text: 'กรุณากรอกรหัสผ่านให้ถูกต้อง',
                    showConfirmButton: false,
                    timer: 1500
                });
            
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกรหัสผ่าน',
                text: 'กรุณากรอกรหัสผ่าน',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })

    uploadImage.addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.addEventListener('load', function() {
                ImageShow.setAttribute('src', this.result);
            });
            reader.readAsDataURL(file);
        }
    });

    btnEditEmail.addEventListener('click', async function() {
        var email = document.getElementById('email').value;
        var old_email = '<?php echo $_SESSION['user_email']; ?>';
        console.log(email, old_email);
        const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (email != "") {
            if (regexEmail.test(email)) {
                if (email != old_email) {
                    var formData = new FormData();
                    formData.append('status', 'updateEmail');
                    formData.append('user_id', <?php echo $_SESSION['user_id'] ?>);
                    formData.append('user_email', email);
                    formData.append('old_email', old_email);
                    var response = await fetch('../../rest/rest.php', {
                        method: 'POST',
                        body: formData
                    });
                    if (response.ok) {
                        var result = await response.json();
                        if (result.status == 'success') {
                            let timerInterval;
                            Swal.fire({
                                title: result.msg,
                                html: "กำลังออกจากระบบใน <b></b> วินาที.",
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        timer.textContent = `${Swal.getTimerLeft()}`;
                                    }, 100);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: result.msg,
                                text: result.msg,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณากรอกอีเมลให้ถูกต้อง',
                    text: 'กรุณากรอกอีเมลให้ถูกต้อง',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบ',
                text: 'กรุณากรอกข้อมูลให้ครบ',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

    saveImage.addEventListener('click', async function() {
        var file = uploadImage.files[0];
        if (file) {
            try {
                var formData = new FormData();
                formData.append('status', 'updateImage');
                formData.append('user_id', <?php echo $_SESSION['user_id']; ?>);
                formData.append('user_image_data', file);
                var response = await fetch('../../rest/rest.php', {
                    method: 'POST',
                    body: formData
                });
                if (response.ok) {
                    var result = await response.json();
                    if (result.status == 'success') {
                        uploadImage.value = '';
                        imageLogo.setAttribute('src', ImageShow.getAttribute('src'));
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกสำเร็จ',
                            text: 'บันทึกสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'บันทึกไม่สำเร็จ',
                            text: 'บันทึกไม่สำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            } catch (error) {
                console.log(error);
            }
        }
    });
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>


</html>