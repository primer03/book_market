<?php
include_once "../../Model/UserModel.php";
include_once "../../Model/AreaModel.php";
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
$page = 'จัดการข้อมูลผู้ใช้'
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
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 id="modal-title" class="font-bold text-lg"></h3>
        <div class="mt-3">
            <div class="modal-con">
                <div class=" w-full flex flex-col gap-3">
                    <div class=" w-full h-auto rounded-md border p-3 flex flex-col justify-center items-center sm:flex-row gap-3">
                        <div class=" w-20 h-20 border-[3px] border-gray-400 rounded-full flex-shrink-0 border-dashed ">
                            <div class=" w-full relative h-full flex justify-center items-center overflow-hidden cursor-pointer">
                                <input type="file" class="cursor-pointer z-20 w-28 h-28 absolute -top-7 opacity-0 rounded-full" name="" id="">
                                <img src="https://i.imgur.com/2eNcQ4D.jpg" id="imageshow" hidden class=" z-0 w-full h-full absolute rounded-full object-cover" alt="">
                                <i class="fa-solid fa-camera z-10 text-gray-600 opacity-80"></i>
                            </div>
                        </div>
                        <div class=" w-full flex flex-col gap-3">
                            <div class=" w-full flex flex-col">
                                <label for="">อีเมล</label>
                                <input type="text" id="email" class="input input-bordered" placeholder="อีเมล" />
                            </div>
                            <div class=" w-full flex flex-col">
                                <label for="">รหัสผ่าน</label>
                                <input type="password" id="password" class="input input-bordered" placeholder="รหัสผ่าน" />
                            </div>
                            <div class=" w-full flex flex-col">
                                <label for="">สถานะ</label>
                                <select id="status" class="select select-bordered w-full">
                                    <option value="1">แอดมิน</option>
                                    <option value="0">ผู้ใช้</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-wh"></div>
            </div>
            <div class=" flex justify-end gap-3 mt-3">
                <button type="button" id="btnsaveedit" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">บันทึก</button>
                <button type="button" hidden id="btnsaveeditData" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">บันทึก</button>
                <button type="button" hidden id="BtnSaveEditSelect" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">บันทึก</button>
                <button type="button" id="btnclose" class="py-3 px-8 duration-200 hover:bg-yellow-500 hover:text-white rounded-lg text-yellow-400 border-2 border-yellow-500">ปิด</button>
            </div>
        </div>
    </div>
</dialog>
<dialog id="my_modal_2" class="modal">
    <div class="modal-box">
        <h3 id="modal-titlex" class="font-bold text-lg"></h3>
        <div class="mt-3">
            <div class="modal-conx">
                <!-- <div class="flex w-full gap-3 mb-3">
                    <div class="flex gap-2 justify-center items-center">
                        <div class=" w-5 h-5 rounded-sm border-2 border-yellow-400"></div>
                        <p>รออนุมัติ</p>
                    </div>
                    <div class="flex gap-2 justify-center items-center">
                        <div class=" w-5 h-5 rounded-sm border-2 border-green-400"></div>
                        <p>อนุมัติแล้ว</p>
                    </div>
                </div> -->
                <div class="grid grid-cols-3 gap-3">
                    <div class=" border flex justify-center items-center flex-col shadow-md h-32 rounded-lg">
                        <p class=" font-semibold text-4xl">A</p>
                        <p>ตำแหน่งที่ 2</p>
                    </div>
                </div>
            </div>
            <div class=" flex justify-end gap-3 mt-3">
                <button type="button" id="btnclosex" class="py-3 px-8 duration-200 hover:bg-yellow-500 hover:text-white rounded-lg text-yellow-400 border-2 border-yellow-500">ปิด</button>
            </div>
        </div>
    </div>
</dialog>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <?php include_once "../widget/sidebar.php" ?>
    <main class="ease-soft-in-out xl:ml-68.5 relative overflow-auto h-full max-h-screen h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <?php include_once "../widget/navbar.php" ?>
        <div class="w-full px-6 py-6 mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-3">
                <h3 class="text-2xl font-bold flex-shrink-0">จัดการข้อมูลผู้ใช้</h3>
                <div class=" flex flex-col sm:flex-row gap-2 w-full flex-wrap justify-end">
                    <button type="button" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700" onclick="addData()"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูล</button>
                    <button type="button" id="BtnSelectEdit" class="py-3 px-8 duration-200 hover:bg-yellow-500 hover:text-white rounded-lg text-yellow-500 border-2 border-yellow-500"><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูล</button>
                    <button type="button" id="BtnDeleteSelect" class="py-3 px-8 duration-200 hover:bg-red-700 hover:text-white rounded-lg text-red-700 border-2 border-red-700"><i class="fa-solid fa-trash"></i> ลบข้อมูล</button>
                </div>
            </div>
            <!-- content -->
            <div class="w-full animate-fadeIn bg-white p-3 rounded-lg shadow-lg">
                <table id="tableitem" class="table table-zebra hover">
                    <thead>
                        <tr>
                            <th>เลือก</th>
                            <th>ลำดับ</th>
                            <th>รูป</th>
                            <th>อีเมล</th>
                            <th>สถานะ</th>
                            <th>ร้านค้าที่จอง</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody class=" text-center">
                        <?php $num = 0; ?>
                        <?php foreach ($DescUserData as $key => $value) {  ?>
                            <?php if ($value['user_email'] != $_SESSION['user_email'] && strtolower($value['user_email']) != 'admin@gmail.com') { ?>
                                <tr class="text-center">
                                    <td><input type="checkbox" class="checkbox rounded-sm" /></td>
                                    <td><?= $num + 1 ?></td>
                                    <td>
                                        <div class=" flex justify-center">
                                            <img src="data:image/jpeg;base64,<?= base64_encode($value['user_image_data']) ?>" class="w-14 h-14 rounded-full object-cover">
                                        </div>
                                    </td>
                                    <td><?= $value['user_email'] ?></td>
                                    <td>
                                        <?php if ($value['user_status'] == 1) { ?>
                                            <span class="bg-gradient-to-tl w-full from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">แอดมิน</span>
                                        <?php } else { ?>
                                            <span class="bg-gradient-to-tl w-full from-red-600 to-pink-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">ผู้ใช้</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button id="viewmarket" onclick="viewMarket(<?php echo $value['user_id']; ?>)" class="py-3 px-4 duration-150 hover:bg-teal-600 text-white font-semibold bg-teal-500 rounded-lg"><i class="fa-solid fa-store"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" class="py-3 px-4 duration-150 hover:bg-yellow-600 text-white font-semibold bg-yellow-500 rounded-lg" onclick="editData('<?= $value['user_id'] ?>','<?= $value['user_email'] ?>','<?= $value['user_status'] ?>',<?= $num ?>)">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td><button type="button" class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg" onclick="deleteData('<?= $value['user_id'] ?>',<?= $num ?>)"><i class="fa-solid fa-trash"></i></button></td>
                                </tr>
                            <?php $num++;
                            } ?>
                        <?php  } ?>
                    </tbody>
                </table>
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
    var mytable = document.getElementById("tableitem");
    var btnclose = document.getElementById("btnclose");
    var modal = document.getElementById("my_modal_1");
    var btnsaveedit = document.getElementById("btnsaveedit");
    var user_idActive = 0;
    var email_user = '';
    var tableIdx = 0;
    var btnsaveeditData = document.getElementById("btnsaveeditData");
    var BtnSelectEdit = document.querySelector("#BtnSelectEdit");
    var BtnSaveEditSelect = document.querySelector("#BtnSaveEditSelect");
    var IdxData = [];
    var BtnDeleteSelect = document.querySelector("#BtnDeleteSelect");
    var btnclosex = document.querySelector("#btnclosex");
    var modalx = document.querySelector("#my_modal_2");

    btnclosex.addEventListener("click", function() {
        modalx.classList.remove("modal-open");
    })

    async function viewMarket(userID) {
        modalx.classList.add("modal-open");
        var modaltitlex = document.querySelector("#modal-titlex");
        var modalconx = document.querySelector(".modal-conx");
        modaltitlex.innerHTML = "ร้านค้าที่จอง";
        modalconx.innerHTML = '';
        modalconx.innerHTML += `<div class="flex w-full gap-3 mb-3">
                    <div class="flex gap-2 justify-center items-center">
                        <div class=" w-5 h-5 rounded-sm border-2 border-yellow-400"></div>
                        <p>รออนุมัติ</p>
                    </div>
                    <div class="flex gap-2 justify-center items-center">
                        <div class=" w-5 h-5 rounded-sm border-2 border-green-400"></div>
                        <p>อนุมัติแล้ว</p>
                    </div>
                </div>`
        var formDataXD = new FormData();
        formDataXD.append('user_id', userID);
        formDataXD.append('status', 'getMarketData');
        try {
            var res = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: formDataXD
            });
            if (res.ok) {
                var data = await res.json();
                modalconx.innerHTML += `<div id="divgirdXD" class="grid grid-cols-3 gap-3">`
                if (data.data != null) {
                    for([key,value] of data.data.entries()){
                        $border_color = value.item_active == 1 ? 'border-yellow-400' : 'border-green-400';
                        var divgirdXD =modalconx.querySelector("#divgirdXD");
                        divgirdXD.innerHTML += `<div class="animate-zoom-animation border-2 ${$border_color} flex justify-center items-center flex-col shadow-md h-32 rounded-lg">
                        <p class=" font-semibold text-4xl">${value.area_name}</p>
                        <p>ตำแหน่งที่ ${value.item_position}</p>
                    </div>`
                    }
                }
            }
        } catch (error) {
            console.log(error);
        }
    }

    BtnDeleteSelect.addEventListener("click", async function() {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบข้อมูลที่เลือกไว้หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ลบข้อมูล',
            cancelButtonText: 'ยกเลิก'
        }).then(async (result) => {
            if (result.isConfirmed) {
                var checkbox = document.querySelectorAll(".checkbox");
                var check = false;
                var checkx = true;
                var count = 0;
                var UserData = await getUserJS();
                IdxData = [];
                checkbox.forEach((e, index) => {
                    if (e.checked) {
                        UserData.forEach((value, key) => {
                            if (index == key) {
                                check = true;
                                IdxData.push({
                                    index: index,
                                    user_id: value.user_id,
                                    user_email: value.user_email
                                });
                            }
                        });
                    }
                });
                if (check) {
                    IdxData.forEach(async (value, key) => {
                        var formDataXD = new FormData();
                        formDataXD.append('user_id', value.user_id);
                        formDataXD.append('status', 'deleteUser');
                        try {
                            var res = await fetch('../../rest/rest.php', {
                                method: 'POST',
                                body: formDataXD
                            });
                            if (res.ok) {
                                var data = await res.json();
                                if (data.status != 'success') {
                                    checkx = false;
                                } else {
                                    tableItemX.row(value.index).remove().draw();
                                    var TableData = tableItemX.data();
                                    TableData.each(function(valuex, index) {
                                        if (key < IdxData.length - 1) {
                                            if (valuex[3] == IdxData[key + 1].user_email) {
                                                IdxData[key + 1].index = index;
                                            }
                                        }
                                        var matches = valuex[5].match(/editData\('(\d+)','(.*?)','(\d+)',(\d+)\)/);
                                        tableItemX.cell(index, 1).data(index + 1).draw();
                                        tableItemX.cell(index, 5).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-yellow-600 text-white font-semibold bg-yellow-500 rounded-lg" onclick="editData('${matches[1]}','${matches[2]}','${matches[3]}',${index})"><i class="fa-regular fa-pen-to-square"></i></button>`).draw();
                                        tableItemX.cell(index, 6).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg" onclick="deleteData('${matches[1]}',${index})"><i class="fa-solid fa-trash"></i></button>`).draw();
                                    });
                                }
                            }
                            await sleep(1500);
                        } catch (error) {
                            console.log(error);
                        }
                    });
                    if (checkx) {
                        Swal.fire({
                            icon: 'success',
                            title: "ลบข้อมูลสำเร็จ",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: "ลบข้อมูลไม่สำเร็จ",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: "กรุณาเลือกข้อมูล",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
    });

    BtnSaveEditSelect.addEventListener('click', async (e) => {
        console.log(IdxData);
        var inputemail = document.querySelectorAll("#email");
        var inputstatus = document.querySelectorAll("#status");
        var img = document.querySelectorAll("#images");
        // console.log(inputemail);
        // console.log(inputstatus);
        // console.log(img);
        var check = true;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (checkinput(inputemail)) {
            for ([key, value] of IdxData.entries()) {
                console.log(value);
                if (emailRegex.test(inputemail[key].value)) {
                    var formDataXD = new FormData();
                    formDataXD.append('user_id', value.user_id);
                    formDataXD.append('user_email', inputemail[key].value);
                    formDataXD.append('user_status', inputstatus[key].value);
                    formDataXD.append('status', 'updateUser');
                    formDataXD.append('user_image_data', img[key].files[0]);
                    formDataXD.append('old_email', value.user_email);
                    try {
                        var res = await fetch('../../rest/rest.php', {
                            method: 'POST',
                            body: formDataXD
                        });
                        if (res.ok) {
                            var data = await res.json();
                            if (data.status == 'success') {
                                var divCardX = document.querySelectorAll("#divcard");
                                divCardX[key].classList.add("border-green-500");
                            } else {
                                check = false;
                                var divCardX = document.querySelectorAll("#divcard");
                                divCardX[key].classList.add("border-red-500");
                                Swal.fire({
                                    icon: 'error',
                                    title: data.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        }
                        await sleep(1500);
                    } catch (error) {
                        console.log(error);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: "กรุณากรอกอีเมลให้ถูกต้อง",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return false;
                }
            }
        }
        if (check) {
            Swal.fire({
                icon: 'success',
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            })
            modal.classList.remove("modal-open");
            // console.log(img[0].files[0]);
            for ([key, value] of IdxData.entries()) {
                if (img[key].files[0] != undefined) {
                    tableItemX.cell(value.index, 2).data(`<div class=" flex justify-center"><img src="${URL.createObjectURL(img[key].files[0])}" class="w-14 h-14 rounded-full object-cover"></div>`).draw();
                }
                tableItemX.cell(value.index, 3).data(inputemail[key].value).draw();
                tableItemX.cell(value.index, 4).data(`<span class="bg-gradient-to-tl w-full ${inputstatus[key].value == 1 ? 'from-green-600 to-lime-400' : 'from-red-600 to-pink-400'} px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">${inputstatus[key].value == 1 ? 'แอดมิน' : 'ผู้ใช้'}</span>`).draw();
            }
        }
    })

    async function toBase64(file) {
        var base64 = await new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = (error) => reject(error)
        });
        return base64;
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    BtnSelectEdit.addEventListener("click", async function() {
        document.getElementById("btnsaveedit").hidden = true;
        document.getElementById("btnsaveeditData").hidden = true;
        document.getElementById("BtnSaveEditSelect").hidden = false;
        IdxData = [];
        var checkbox = document.querySelectorAll(".checkbox");
        var check = false;
        var UserData = await getUserJS();
        // console.log(UserData);
        var modalcon = document.querySelector(".modal-con");
        var modaltitle = document.getElementById("modal-title");
        modaltitle.innerHTML = "แก้ไขข้อมูลผู้ใช้";
        modalcon.innerHTML = '';
        var divflex = document.createElement("div");
        divflex.classList.add("w-full", "flex", "flex-col", "gap-3");
        var count = 0;
        checkbox.forEach((e, index) => {
            if (e.checked) {
                UserData.forEach((value, key) => {
                    if (index == key) {
                        check = true;
                        console.log(index);
                        IdxData.push({
                            index: index,
                            user_id: value.user_id,
                            user_email: value.user_email
                        });
                        var divcard = createModal(value.user_image_data, count, modalcon, value.user_email, value.user_status, true);
                        divflex.appendChild(divcard);
                        count++;
                    }
                });
            }
        });
        if (check) {
            modalcon.appendChild(divflex);
            modal.classList.add("modal-open");
        } else {
            Swal.fire({
                icon: 'error',
                title: "กรุณาเลือกข้อมูล",
                showConfirmButton: false,
                timer: 1500
            })
        }
    });

    async function getUserJS() {
        FormDataUser = new FormData();
        FormDataUser.append('status', 'getUserData');
        FormDataUser.append('user_id', <?php echo $_SESSION['user_id'] ?>);
        try {
            var res = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: FormDataUser
            });
            if (res.ok) {
                var data = await res.json();
                return data.data;
            }
        } catch (error) {
            console.log(error);
        }
    }

    function addData() {
        modal.classList.add("modal-open");
        document.getElementById("modal-title").innerHTML = "เพิ่มข้อมูลผู้ใช้";
        document.getElementById("email").value = '';
        document.getElementById("status").value = 1;
        document.getElementById("btnsaveedit").hidden = true;
        document.getElementById("BtnSaveEditSelect").hidden = true;
        btnsaveeditData.hidden = false;
        var modalcon = document.querySelector(".modal-con");
        modalcon.innerHTML = `<div class=" w-full flex flex-col gap-3">
                    <div class=" w-full h-auto rounded-md border p-3 flex flex-col justify-center items-center sm:flex-row gap-3">
                        <div class=" w-20 h-20 border-[3px] border-gray-400 rounded-full flex-shrink-0 border-dashed ">
                            <div class=" w-full relative h-full flex justify-center items-center overflow-hidden cursor-pointer">
                                <input type="file" onchange="readImg(this)" class="cursor-pointer z-20 w-28 h-28 absolute -top-7 opacity-0 rounded-full" name="" id="images">
                                <img src="https://i.imgur.com/2eNcQ4D.jpg" id="imageshow" hidden class=" z-0 w-full h-full absolute rounded-full object-cover" alt="">
                                <i class="fa-solid fa-camera z-10 text-gray-600 opacity-80"></i>
                            </div>
                        </div>
                        <div class=" w-full flex flex-col gap-3">
                            <div class=" w-full flex flex-col">
                                <label for="">อีเมล</label>
                                <input type="text" id="email" class="input input-bordered" placeholder="อีเมล" />
                            </div>
                            <div class=" w-full flex flex-col">
                                <label for="">รหัสผ่าน</label>
                                <div class=" w-full flex flex-col">
                                    <input type="password" id="password" class="input input-bordered" placeholder="รหัสผ่าน" />
                                    <span class="text-red-600 text-xs">*ต้องขิ้นต้นโดยอักษรตัวใหญ่แล้วต้องมีอย่าน้อย 8 ตัว</span>
                                </div>
                            </div>
                            <div class=" w-full flex flex-col">
                                <label for="">สถานะ</label>
                                <select id="status" class="select select-bordered w-full">
                                    <option value="1">แอดมิน</option>
                                    <option value="0">ผู้ใช้</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>`
    }

    btnsaveeditData.addEventListener("click", async function() {
        const regpsw = /^[A-Z][a-zA-Z0-9]{7,}$/;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var inputemail = document.getElementById("email");
        var inputpassword = document.getElementById("password");
        var inputstatus = document.getElementById("status");
        var img = document.getElementById("images");
        if (checkinput([inputemail, inputpassword, inputstatus, img])) {
            if (emailRegex.test(inputemail.value)) {
                if (regpsw.test(inputpassword.value)) {
                    try {
                        let formData = new FormData();
                        formData.append('user_email', inputemail.value);
                        formData.append('user_password', inputpassword.value);
                        formData.append('images', img.files[0]);
                        formData.append('status', 'register')
                        formData.append('user_status', inputstatus.value);
                        let response = await fetch('../../rest/rest.php', {
                            method: 'POST',
                            body: formData
                        });
                        if (response.ok) {
                            let data = await response.json();
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        var fileimage = URL.createObjectURL(img.files[0]);
                                        var colors = '';
                                        if (inputstatus.value == 1) {
                                            colors = 'from-green-600 to-lime-400'
                                        } else {
                                            colors = 'from-red-600 to-pink-400'
                                        }
                                        console.log(tableItemX.data());
                                        tableItemX.row.add([
                                            `<input type="checkbox" class="checkbox rounded-sm" />`,
                                            tableItemX.data().length + 1,
                                            `<div class=" flex justify-center"><img src="${fileimage}" class="w-14 h-14 rounded-full object-cover"></div>`,
                                            inputemail.value,
                                            `<span class="bg-gradient-to-tl w-full ${colors} px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">${inputstatus.value == 1 ? 'แอดมิน' : 'ผู้ใช้'}</span>`,
                                            `<button id="viewmarket" onclick="viewMarket(${data.user_id})"  class="py-3 px-4 duration-150 hover:bg-teal-600 text-white font-semibold bg-teal-500 rounded-lg"><i class="fa-solid fa-store"></i></button>`,
                                            `<button type="button" class="py-3 px-4 duration-150 hover:bg-yellow-600 text-white font-semibold bg-yellow-500 rounded-lg" onclick="editData('${data.user_id}','${inputemail.value}','${inputstatus.value}',${tableItemX.data().length})"><i class="fa-regular fa-pen-to-square"></i></button>`,
                                            `<button type="button" class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg" onclick="deleteData('${data.user_id}',${tableItemX.data().length})"><i class="fa-solid fa-trash"></i></button>`
                                        ]).draw();
                                        // var TableData = tableItemX.data();
                                        // TableData.each(function(value, index) {
                                        //     var matches = value[5].match(/editData\('(\d+)','(.*?)','(\d+)',(\d+)\)/);
                                        //     tableItemX.cell(index, 1).data(index + 1).draw();
                                        //     tableItemX.cell(index, 5).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-yellow-600 text-white font-semibold bg-yellow-500 rounded-lg" onclick="editData('${matches[1]}','${matches[2]}','${matches[3]}',${index})"><i class="fa-regular fa-pen-to-square"></i></button>`).draw();
                                        //     tableItemX.cell(index, 6).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg" onclick="deleteData('${matches[1]}',${index})"><i class="fa-solid fa-trash"></i></button>`).draw();
                                        // });
                                        modal.classList.remove("modal-open");
                                        btnsaveeditData.hidden = true;
                                        document.getElementById("btnsaveedit").hidden = false;
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        } else {
                            console.log(response.statusText);
                        }
                    } catch (error) {
                        console.log(error);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'รหัสผ่านต้องขึ้นต้นด้วยตัวใหญ่และมีความยาวอย่างน้อย 8 ตัวอักษร',
                        text: 'รหัสผ่านต้องขึ้นต้นด้วยตัวใหญ่และมีความยาวอย่างน้อย 8 ตัวอักษร',
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณากรอกอีเมลให้ถูกต้อง',
                    text: 'กรุณากรอกอีเมลให้ถูกต้อง',
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบ',
                text: 'กรุณากรอกข้อมูลให้ครบ',
            })
        }
    });

    function checkinput(input) {
        var check = true;
        input.forEach(e => {
            if (e.value == "") {
                if (e.type != 'file') {
                    e.classList.remove('input-primary');
                    e.classList.add('input-error');
                }
                check = false;
            }
        });
        return check;
    }

    function readImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("imageshow").hidden = false;
                document.getElementById("imageshow").src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    btnclose.addEventListener("click", function() {
        modal.classList.remove("modal-open");
    });

    async function deleteData(user_id, idx) {
        Swal.fire({
            title: 'คุณต้องการลบข้อมูลใช่หรือไม่?',
            text: "คุณต้องการลบข้อมูลใช่หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ไม่ใช่'
        }).then(async (result) => {
            if (result.isConfirmed) {
                var FormDataX = new FormData();
                FormDataX.append('status', 'deleteUser');
                FormDataX.append('user_id', user_id);
                try {
                    var res = await fetch('../../rest/rest.php', {
                        method: 'POST',
                        body: FormDataX
                    });
                    if (res.ok) {
                        var data = await res.json();
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    tableItemX.row(idx).remove().draw();
                                    var TableData = tableItemX.data();
                                    TableData.each(function(value, index) {
                                        var matches = value[6].match(/editData\('(\d+)','(.*?)','(\d+)',(\d+)\)/);
                                        tableItemX.cell(index, 1).data(index + 1).draw();
                                        tableItemX.cell(index, 6).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-yellow-600 text-white font-semibold bg-yellow-500 rounded-lg" onclick="editData('${matches[1]}','${matches[2]}','${matches[3]}',${index})"><i class="fa-regular fa-pen-to-square"></i></button>`).draw();
                                        tableItemX.cell(index, 7).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg" onclick="deleteData('${matches[1]}',${index})"><i class="fa-solid fa-trash"></i></button>`).draw();
                                    });
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.msg,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    } else {
                        console.log(res.statusText);
                    }
                } catch (error) {
                    console.log(error);
                }
            }
        })
    }

    btnsaveedit.addEventListener("click", async function() {
        var email = document.getElementById("email").value;
        var status = document.getElementById("status").value;
        var img = document.getElementById("images");
        var user_id = user_idActive;
        var FormDataX = new FormData();
        FormDataX.append('status', 'updateUser');
        FormDataX.append('user_id', user_id);
        FormDataX.append('user_email', email);
        FormDataX.append('old_email', email_user);
        FormDataX.append('user_status', status);
        FormDataX.append('user_image_data', img.files[0]);
        var regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (email == '') {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกอีเมล',
                text: 'กรุณากรอกอีเมล',
            })
        } else if (!regexEmail.test(email)) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกอีเมลให้ถูกต้อง',
                text: 'กรุณากรอกอีเมลให้ถูกต้อง',
            })
        } else {
            try {
                var res = await fetch('../../rest/rest.php', {
                    method: 'POST',
                    body: FormDataX
                });
                if (res.ok) {
                    var data = await res.json();
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                if (img.files[0] != undefined) {
                                    var fileimage = URL.createObjectURL(img.files[0]);
                                    tableItemX.cell(tableIdx, 2).data(`<div class=" flex justify-center"><img src="${fileimage}" class="w-14 h-14 rounded-full object-cover"></div>`).draw();
                                    tableItemX.cell(tableIdx, 3).data(email).draw();
                                    if (status == 1) {
                                        tableItemX.cell(tableIdx, 4).data(`<span class="bg-gradient-to-tl w-full from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">แอดมิน</span>`).draw();
                                    } else {
                                        tableItemX.cell(tableIdx, 4).data(`<span class="bg-gradient-to-tl w-full from-red-600 to-pink-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">ผู้ใช้</span>`).draw();
                                    }
                                    tableItemX.cell(tableIdx, 6).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-yellow-600 text-white font-semibold bg-yellow-500 rounded-lg" onclick="editData('${user_id}','${email}','${status}',${tableIdx})"><i class="fa-regular fa-pen-to-square"></i></button>`).draw();
                                    tableItemX.cell(tableIdx, 7).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg" onclick="deleteData('${user_id}',${tableIdx})"><i class="fa-solid fa-trash"></i></button>`).draw();
                                    modal.classList.remove("modal-open");
                                } else {
                                    tableItemX.cell(tableIdx, 3).data(email).draw();
                                    if (status == 1) {
                                        tableItemX.cell(tableIdx, 4).data(`<span class="bg-gradient-to-tl w-full from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">แอดมิน</span>`).draw();
                                    } else {
                                        tableItemX.cell(tableIdx, 4).data(`<span class="bg-gradient-to-tl w-full from-red-600 to-pink-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">ผู้ใช้</span>`).draw();
                                    }
                                    tableItemX.cell(tableIdx, 6).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-yellow-600 text-white font-semibold bg-yellow-500 rounded-lg" onclick="editData('${user_id}','${email}','${status}',${tableIdx})"><i class="fa-regular fa-pen-to-square"></i></button>`).draw();
                                    tableItemX.cell(tableIdx, 7).data(`<button type="button" class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg" onclick="deleteData('${user_id}',${tableIdx})"><i class="fa-solid fa-trash"></i></button>`).draw();
                                    modal.classList.remove("modal-open");
                                }
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                } else {
                    console.log(res.statusText);
                }
            } catch (error) {
                console.log(error);
            }
        }
    });

    var tableItemX = new DataTable(mytable, {
        responsive: true,
        "language": {
            "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
            "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
            "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "ค้นหา",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            },
        },
        "order": [
            [1, "asc"]
        ],
    });

    async function editData(user_id, user_email, user_status, idx) {
        document.getElementById("btnsaveedit").hidden = false;
        document.getElementById("btnsaveeditData").hidden = true;
        document.getElementById("BtnSaveEditSelect").hidden = true;
        email_user = user_email;
        tableIdx = idx;
        user_idActive = user_id;
        modal.classList.add("modal-open");
        console.log(user_id, user_email, user_status);
        var ImageX = await getImageUser(user_id);
        var modalcon = document.querySelector(".modal-con");
        var modaltitle = document.getElementById("modal-title");
        modaltitle.innerHTML = "แก้ไขข้อมูลผู้ใช้";
        modalcon.innerHTML = ''
        var divflex = document.createElement("div");
        divflex.classList.add("w-full", "flex", "flex-col", "gap-3");
        var divcard = createModal(ImageX, idx, modalcon, user_email, user_status);
        divflex.appendChild(divcard);
        modalcon.appendChild(divflex);
    }

    function createModal(ImageX, idx, modalcon, user_email, user_status, checkx = false) {
        var divcard = document.createElement("div");
        divcard.classList.add("w-full", "h-auto", "rounded-md", "border", "p-3", "flex", "flex-col", "justify-center", "items-center", "sm:flex-row", "gap-3");
        divcard.setAttribute("id", "divcard");
        var divimg = document.createElement("div");
        divimg.classList.add("w-20", "h-20", "border-[3px]", "border-gray-400", "rounded-full", "flex-shrink-0", "border-dashed");
        var divimg2 = document.createElement("div");
        divimg2.classList.add("w-full", "relative", "h-full", "flex", "justify-center", "items-center", "overflow-hidden", "cursor-pointer");
        var inputimg = document.createElement("input");
        inputimg.classList.add("cursor-pointer", "z-20", "w-28", "h-28", "absolute", "-top-7", "opacity-0", "rounded-full");
        inputimg.setAttribute("type", "file");
        inputimg.setAttribute("id", "images");
        inputimg.setAttribute("name", "images");
        if (checkx) {
            inputimg.setAttribute("onchange", `readURL(this,true,${idx})`);
        } else {
            inputimg.setAttribute("onchange", `readURL(this)`);
        }
        inputimg.setAttribute("accept", "image/*");
        var img = document.createElement("img");
        img.classList.add("z-0", "w-full", "h-full", "absolute", "rounded-full", "object-cover");
        img.setAttribute("src", "data:image/jpeg;base64," + ImageX);
        img.setAttribute("id", "img");
        var i = document.createElement("i");
        i.classList.add("fa-solid", "fa-camera", "z-10", "text-white", "opacity-80");
        divimg2.appendChild(inputimg);
        divimg2.appendChild(img);
        divimg2.appendChild(i);
        divimg.appendChild(divimg2);
        var divflex2 = document.createElement("div");
        divflex2.classList.add("w-full", "flex", "flex-col", "sm:flex-row", "gap-3");
        var divflex3 = document.createElement("div");
        divflex3.classList.add("w-full", "flex", "flex-col");
        var label = document.createElement("label");
        label.setAttribute("for", "email");
        label.innerHTML = "อีเมล";
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("id", "email");
        input.setAttribute("class", "input input-bordered");
        input.setAttribute("placeholder", "อีเมล");
        input.setAttribute("value", user_email);
        divflex3.appendChild(label);
        divflex3.appendChild(input);
        var divflex4 = document.createElement("div");
        divflex4.classList.add("w-full", "flex", "flex-col");
        var label2 = document.createElement("label");
        label2.setAttribute("for", "status");
        label2.innerHTML = "สถานะ";
        var select = document.createElement("select");
        select.setAttribute("id", "status");
        select.setAttribute("class", "select select-bordered w-full");
        var option1 = document.createElement("option");
        option1.setAttribute("value", "1");
        option1.innerHTML = "แอดมิน";
        var option2 = document.createElement("option");
        option2.setAttribute("value", "0");
        option2.innerHTML = "ผู้ใช้";
        if (user_status == 1) {
            option1.setAttribute("selected", "selected");
        } else {
            option2.setAttribute("selected", "selected");
        }
        select.appendChild(option1);
        select.appendChild(option2);
        divflex4.appendChild(label2);
        divflex4.appendChild(select);
        divflex2.appendChild(divflex3);
        divflex2.appendChild(divflex4);
        divcard.appendChild(divimg);
        divcard.appendChild(divflex2);
        return divcard;
    }

    function readURL(input, ischeck = false, idx) {
        if (ischeck) {
            console.log(input.files[0], idx);
            var images = document.querySelectorAll("input[name='images']");
            var img = document.querySelectorAll("#img");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    img[idx].setAttribute("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        } else {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var img = document.getElementById("img");
                reader.onload = function(e) {
                    img.setAttribute("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }

    async function getImageUser(user_id) {
        var FormDataX = new FormData();
        FormDataX.append('status', 'getImageUser');
        FormDataX.append('user_id', user_id);
        try {
            var res = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: FormDataX
            });
            if (res.ok) {
                var data = await res.json();
                return data.data;
            } else {
                console.log(res.statusText);
            }
        } catch (error) {
            console.log(error);
        }
    }
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>


</html>