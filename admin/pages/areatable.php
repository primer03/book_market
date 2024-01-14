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
$page = 'จัดการข้อมูลพื้นที่'
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
$area = new AreaModel();
$area_data = $area->getArea();
?>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">แก้ไขข้อมูลโซนพื้นที่ขาย<small class="text-red-600"> *กรอกเฉพาะตัวพิมพ์ใหญ่เท่านั้น</small></h3>
        <!-- <p class="py-4">Press ESC key or click the button below to close</p> -->
        <div class=" mt-3">
            <form method="dialog" class=" flex flex-col gap-3">
                <div class="box-input  flex flex-col gap-3">
                    <!-- <div class=" flex gap-3 items-center">
                        <input type="text" class="input input-bordered input-info w-full" />
                        <p class=" text-2xl text-green-600"><i class='bx bx-check-circle'></i></p>
                    </div> -->
                </div>
                <div class=" flex justify-end gap-3">
                    <button type="submit" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">บันทึก</button>
                    <button type="button" id="btnclose" class="py-3 px-8 duration-200 hover:bg-orange-700 hover:text-white rounded-lg text-orange-700 border-2 border-orange-700">ปิด</button>
                </div>
            </form>
        </div>
    </div>
</dialog>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <?php include_once "../widget/sidebar.php" ?>
    <main class="ease-soft-in-out xl:ml-68.5 relative overflow-auto h-full max-h-screen h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <?php include_once "../widget/navbar.php" ?>

        <div class="w-full px-6 py-6 mx-auto">
            <!-- content -->
            <div class=" flex flex-col gap-2">
                <label for="">เพิ่มโซนขาย <small class="text-red-600">*กรอกเฉพาะตัวพิมพ์ใหญ่เท่านั้น</small></label>
                <div class=" flex gap-3  w-full">
                    <input name="zonearea" type="text" placeholder="ใช้ชื่อเป็น A-Z" class="input input-bordered input-primary w-full max-w-xs" />
                    <button id="btnarea" class=" p-3 px-8 rounded-lg bg-violet-600 text-white duration-150 hover:bg-violet-700">เพิ่ม</button>
                </div>
            </div>
            <div class=" flex justify-end gap-3 w-full my-3">
                <button id="btnedit" class=" px-8 py-3 rounded-lg bg-yellow-400 text-black duration-150 hover:bg-yellow-500">แก้ไข</button>
                <button id="btndel" class=" px-8 py-3 rounded-lg bg-red-600 text-white duration-150 hover:bg-red-700">ลบ</button>
            </div>
            <div class=" w-full">
                <div id="box-zone" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-5 gap-9">
                    <?php foreach ($area_data as $key => $value) { ?>
                        <div class="box-card animate-zoomInDown duration-150 hover:-translate-y-2  shadow-md w-full rounded-lg overflow-hidden">
                            <div class="card-head h-40 relative p-8 flex justify-center items-center <?php echo $gradient_b[$key] ?>">
                                <input type="checkbox" class="checkbox rounded-sm checkbox-sm absolute top-1 left-1 border-white [--chkbg:theme(colors.white)] [--chkfg:gray]" />
                                <span class="text-center text-5xl text-white font-semibold"><?php echo $value['area_name'] ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</body>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<script>
    var btnedit = document.getElementById('btnedit');
    var modal = document.getElementById('my_modal_1');
    var btndel = document.getElementById('btndel');
    var checkbox = document.querySelectorAll('.checkbox');
    var Dataarea = null;
    var datacheck = [];
    var btnclose = document.getElementById('btnclose');
    var box_input = document.querySelector('.box-input');
    var checkname = true;
    var idxData = []
    var inputzone = document.querySelector('input[name="zonearea"]');
    var btnarea = document.getElementById('btnarea');
    var form = document.querySelector('form');
    var gradient_b = [
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

    btnclose.addEventListener('click', () => {
        modal.classList.remove('modal-open');
    });

    btndel.addEventListener('click', async () => {
        Swal.fire({
            title: "คุณต้องการลบข้อมูลที่เลือกหรือไม่?",
            text: "ถ้าลบข้อมูลการจองกับข้อมูลพื้นที่จะถูกลบทั้งหมด",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ลบข้อมูล!",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                checkdels();
            }
        });
    });

    async function checkdels() {
        datacheck = [];
        var countcheck = 0;
        checkbox = document.querySelectorAll('.checkbox');
        checkbox.forEach((element, index) => {
            if (element.checked) {
                countcheck++;
                datacheck.push(index);
            }
        });
        if (countcheck != 0) {
            var data = await getArea();
            var box_zone = document.getElementById('box-zone');
            var card_head = document.querySelectorAll('.card-head');
            var box_card = document.querySelectorAll('.box-card');
            var box_card_count = box_zone.querySelectorAll('.box-card').length;
            var box_card_count_check = box_zone.querySelectorAll('.box-card').length - countcheck;
            if (box_card_count_check == 0) {
                alertmessage('ไม่สามารถลบข้อมูลได้', 'error');
                return false;
            } else {
                var dataselect = [];
                var data = await getArea();
                for (let [index, element] of data.data.entries()) {
                    datacheck.forEach((element2, index2) => {
                        if (index == element2) {
                            dataselect.push({
                                area_id: element.area_id,
                                area_name: element.area_name,
                                index: element2
                            });
                        }
                    });
                }
                console.log(dataselect);
                checkbox = document.querySelectorAll('.checkbox');
                datacheck.forEach((element, index) => {
                    deletezone(dataselect[index].area_id, dataselect[index].index);
                });
                // var formData = new FormData();
                // formData.append('status', 'deletezone');
                // formData.append('data', JSON.stringify(datacheck));

            }
        } else {
            alertmessage('กรุณาเลือกข้อมูลที่ต้องการลบ', 'error');
            return false;
        }
    }

    async function deletezone(id, el_index) {
        try {
            var formData = new FormData();
            formData.append('status', 'deletezone');
            formData.append('area_id', id);
            var res = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: formData
            });
            if (res.ok) {
                var data = await res.json();
                if (data.status == 'success') {
                    alertmessage('ลบข้อมูลสำเร็จ', 'success');
                    var box_zone = document.getElementById('box-zone');
                    var box_card = document.querySelectorAll('.box-card');
                    checkbox = document.querySelectorAll('.checkbox');
                    box_card.forEach((element, index) => {
                        checkbox.forEach((element2, index2) => {
                            if (index == index2) {
                                if (element2.checked) {
                                    box_zone.removeChild(box_card[index]);
                                }
                            }
                        });
                        // if (index == el_index) {
                        //     box_zone.removeChild(box_card[index]);
                        // }
                    });
                } else {
                    alertmessage('เกิดข้อผิดพลาดในการลบข้อมูล', 'error');
                    return false;
                }
            }
        } catch (error) {
            console.error("Error delete zone:", error);
        }
    }

    btnarea.onclick = async () => {
        var regex = /^[A-Z]$/;
        var box_zone = document.getElementById('box-zone');
        if (inputzone.value == '') {
            alertmessage('กรุณากรอกข้อมูลให้ครบถ้วน', 'error');
            return false;
        } else {
            if (regex.test(inputzone.value)) {
                try {
                    var formData = new FormData();
                    formData.append('status', 'insertzone');
                    formData.append('area_name', inputzone.value);
                    var res = await fetch('../../rest/rest.php', {
                        method: 'POST',
                        body: formData
                    });
                    if (res.ok) {
                        var data = await res.json();
                        var datachar = []
                        var box_zonex = document.getElementById('box-zone');
                        var box_cardx = box_zonex.querySelectorAll('.box-card');
                        box_cardx.forEach((element, index) => {
                            var spandata = element.querySelector('span').innerHTML;
                            datachar.push(spandata);
                        });
                        var idxchar = 0;
                        //หาตำแหน่งของตัวอักษร ถ้าน้อยกว่าไปอยู่หน้า ถ้ามากกว่าไปอยู่หลัง
                        for (let [index, element] of datachar.entries()) {
                            if (inputzone.value < element) {
                                idxchar = index;
                                break;
                            } else {
                                idxchar = index + 1;
                            }
                        }
                        console.log(idxchar);
                        console.log(datachar);
                        if (data.status == 'success') {
                            alertmessage('เพิ่มข้อมูลสำเร็จ', 'success');
                            var box_card_count = box_zone.querySelectorAll('.box-card').length;
                            var box_card = document.createElement('div');
                            box_card.classList.add('box-card', 'animate-zoomInDown', 'shadow-md', 'w-full', 'rounded-lg', 'overflow-hidden', 'duration-150', 'hover:-translate-y-2');
                            var card_head = document.createElement('div');
                            var gradain = gradient_b[box_card_count].split(' ');
                            card_head.classList.add('card-head', 'h-40', 'relative', 'p-8', 'flex', 'justify-center', 'items-center', gradain[0], gradain[1], gradain[2]);
                            var input = document.createElement('input');
                            input.type = 'checkbox';
                            input.classList.add('checkbox', 'rounded-sm', 'checkbox-sm', 'absolute', 'top-1', 'left-1', 'border-white', '[--chkbg:theme(colors.white)]', '[--chkfg:gray]');
                            var span = document.createElement('span');
                            span.classList.add('text-center', 'text-5xl', 'text-white', 'font-semibold');
                            span.innerHTML = inputzone.value;
                            card_head.appendChild(input);
                            card_head.appendChild(span);
                            box_card.appendChild(card_head);
                            var insertionPoint = box_zone.children[idxchar];
                            if (insertionPoint) {
                                box_zone.insertBefore(box_card, insertionPoint);
                            } else {
                                box_zone.appendChild(box_card);
                            }
                            inputzone.value = '';
                        } else {
                            alertmessage('ขื่อถูกใช้ไปแล้ว', 'error');
                            return false;
                        }
                    }
                } catch (error) {
                    console.error("Error checking zone:", error);
                }
            } else {
                alertmessage('กรอกข้อมูลให้ถูกต้อง', 'error');
                return false;
            }
        }
    }

    function delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    btnedit.addEventListener('click', async () => {
        datacheck = [];
        var countcheck = 0;
        checkbox = document.querySelectorAll('.checkbox');
        checkbox.forEach((element, index) => {
            if (element.checked) {
                countcheck++;
                datacheck.push(index);
            }
        });
        if (countcheck != 0) {
            idxData = []
            var data = await getArea();
            box_input.innerHTML = '';
            data.data.forEach((element, index) => {
                datacheck.forEach((element2, index2) => {
                    if (index == element2) {
                        idxData.push({
                            elementindex: element2,
                            area_id: element.area_id,
                            area_name: element.area_name
                        });
                        var flex = document.createElement('div');
                        flex.classList.add('flex', 'gap-3', 'items-center');
                        var input = document.createElement('input');
                        input.type = 'text';
                        input.setAttribute('maxlength', '1')
                        input.classList.add('input', 'input-bordered', 'input-info', 'w-full');
                        input.value = element.area_name;
                        var p = document.createElement('p');
                        p.classList.add('text-2xl', 'text-green-600');
                        p.innerHTML = '<i class="bx bx-check-circle"></i>';
                        flex.appendChild(input);
                        flex.appendChild(p);
                        box_input.appendChild(flex);
                    }
                });
            });
            modal.classList.add('modal-open');
        } else {
            alertmessage('กรุณาเลือกข้อมูลที่ต้องการแก้ไข', 'error');
            return false;
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        var regex = /^[A-Z]$/
        checkname = true;
        newname = [];
        input = box_input.querySelectorAll('input');
        icon = box_input.querySelectorAll('p');
        for (let [index, element] of input.entries()) {
            if (element.value == '') {
                alertmessage('กรุณากรอกข้อมูลให้ครบถ้วน', 'error');
                return false;
            } else {
                if (regex.test(element.value)) {
                    try {
                        var datas = await checkzone(idxData[index].area_name, element.value);
                        if (datas.status == 'success') {
                            newname.push(element.value);
                            updatezone(icon[index], 'success');
                        } else {
                            updatezone(icon[index], 'error');
                            checkname = false;
                        }
                    } catch (error) {
                        console.error("Error checking zone:", error);
                        updatezone(icon[index], 'error');
                        alertmessage('เกิดข้อผิดพลาดในการตรวจสอบข้อมูล', 'error');
                        return false;
                    }
                } else {
                    updatezone(icon[index], 'error');
                    alertmessage('กรอกข้อมูลให้ถูกต้อง', 'error');
                    return false;
                }
            }
        }
        if (checkname) {
            var card_head = document.querySelectorAll('.card-head');
            checkbox.forEach((element, index) => {
                element.checked = false;
            });
            idxData.forEach((element, index) => {
                card_head[element.elementindex].querySelector('span').innerHTML = newname[index];

            });
            modal.classList.remove('modal-open');
        }
    });

    function updatezone(icon, status) {
        if (status == 'success') {
            icon.innerHTML = '<i class="bx bxs-check-circle"></i>';
            icon.classList.add('text-green-600');
            icon.classList.remove('text-red-600');
        } else {
            icon.innerHTML = '<i class="bx bxs-x-circle"></i>';
            icon.classList.add('text-red-600');
            icon.classList.remove('text-green-600');
        }
    }

    function alertmessage(title, icon) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: icon,
            title: title
        });
    }

    async function checkzone(name, newname) {
        var formData = new FormData();
        formData.append('status', 'Checkuniqarea');
        formData.append('area_name', name);
        formData.append('area_name_new', newname);
        var res = await fetch('../../rest/rest.php', {
            method: 'POST',
            body: formData
        });
        if (res.ok) {
            var data = await res.json();
            return data;
        }
    }

    async function getArea() {
        try {
            var formData = new FormData();
            formData.append('status', 'getArea');
            var res = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: formData
            });
            if (res.ok) {
                var data = await res.json();
                return data;
            }
        } catch (error) {
            console.log(error);
        }
    }
</script>
<!-- plugin for scrollbar  -->
<!-- <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script> -->
<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>


</html>