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
$page = 'จัดการจองร้านค้า'
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
$area = new AreaModel();
$area_data = $area->getArea();
?>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 id="modal-title" class="font-bold text-lg"></h3>
        <div class="mt-3">
            <div class="modal-con">
                <div class="modal-wh"></div>
            </div>
            <div class=" flex justify-end gap-3 mt-3">
                <button type="button" id="btnsaveedit" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">บันทึก</button>
                <button type="button" hidden id="btnsaveeditData" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">บันทึก</button>
                <button type="button" id="btnclose" class="py-3 px-8 duration-200 hover:bg-yellow-500 hover:text-white rounded-lg text-yellow-400 border-2 border-yellow-500">ปิด</button>
            </div>
        </div>
    </div>
</dialog>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <?php include_once "../widget/sidebar.php" ?>
    <main class="ease-soft-in-out xl:ml-68.5 relative overflow-auto h-full max-h-screen h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <?php include_once "../widget/navbar.php" ?>
        <?php
        $monthThai = [
            'มกราคม', 'กุมภาพันธ์',
            'มีนาคม', 'เมษายน',
            'พฤษภาคม', 'มิถุนายน',
            'กรกฎาคม', 'สิงหาคม',
            'กันยายน', 'ตุลาคม',
            'พฤศจิกายน', 'ธันวาคม'
        ];
        $month = date('m');
        $year = date('Y') + 543;
        $month = $monthThai[$month - 1];
        ?>
        <div class="w-full px-6 py-6 mx-auto">
            <p class="flex text-xl items-center p-4">
                <i class="mr-2 fas fa-file-invoice"></i>
                <span class="font-semibold">เก็บค่าเช่าประจำเดือน <?php echo $month ?></span>
            </p>
            <!-- content -->
            <?php
            $bookitem = $area->get_book_areaAll();
            $num = 1;
            // echo "<pre>";
            // print_r($bookitem);
            // echo "</pre>";
            ?>
            <div class="w-full animate-fadeIn bg-white p-3 rounded-lg shadow-lg">
                <table id="tableitem" class="table table-zebra hover">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อร้าน</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>ชื่อโซน</th>
                            <th>ตำแหน่งร้านค้า</th>
                            <th>อีเมล</th>
                            <th>เบอร์โทร</th>
                            <th>วัน-เวลาที่ขอจอง</th>
                            <th>วัน-เวลาที่อนุมัติ</th>
                            <th>ชำระเงิน</th>
                            <th>พิมพ์ใบแจ้งชำระ</th>
                            <th>พิมพ์ใบเสร็จรับเงิน</th>
                            <th>ย้ายตำแหน่งร้านค้า</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookitem as $key => $value) { ?>
                            <tr class=" text-center">
                                <td><?php echo $num ?></td>
                                <td><?php echo $value['b_shop_name'] ?></td>
                                <td><?php echo $value['b_firstname'] . " " . $value['b_lastname'] ?></td>
                                <td><?php echo $value['area_name'] ?></td>
                                <?php
                                $countX = 0;
                                // $numarea = $area->getAreaitemById($value['area_id']);
                                $numarea = $area->getAreaitemById($value['area_id']);
                                // echo "<pre>";
                                // print_r($numarea);
                                // echo "</pre>";
                                foreach ($numarea as $keyx => $value2) {
                                    if ($value2['item_id'] == $value['item_id']) {
                                        $countX = $keyx + 1;
                                        break;
                                    }
                                }
                                ?>
                                <td><?php echo $countX; ?></td>
                                <td><?php echo $value['b_email'] ?></td>
                                <td><?php echo $value['b_phone'] ?></td>
                                <td class=" text-left"><?php echo $area->get_time_book($value['b_wait_time']) ?></td>
                                <td class=" text-left"><?php echo $area->get_time_book($value['b_appove_time']) ?></td>
                                <?php
                                $checkbill = $area->get_receiptById($value['b_id'], date('m'), date('Y')); // +1 
                                ?>
                                <td>
                                    <?php if (!empty($checkbill)) { ?>
                                        <button disabled class="py-3 opacity-50 px-4 duration-150 text-white font-semibold bg-green-600 rounded-lg"><i class='bx bx-check'></i></button>
                                    <?php } else { ?>
                                        <button onclick="setReceipt(<?php echo $value['b_id'] ?>,<?php echo $key ?>)" class="py-3 px-4 duration-150 hover:bg-green-700 text-white font-semibold bg-green-600 rounded-lg"><i class='bx bx-check'></i></button>
                                    <?php } ?>
                                <td>
                                    <a href="../bill.php?b_id=<?php echo $value['b_id'] ?>" target="_blank" class="py-3 inline-block px-4 duration-150 hover:bg-teal-600 text-white font-semibold bg-teal-500 rounded-lg"><i class='bx bx-printer'></i></a>
                                    <!-- <button onclick="printBill(<?php echo $value['b_id'] ?>,<?php echo $key ?>)" id="BtnPrintBill" class="py-3 px-4 duration-150 hover:bg-teal-600 text-white font-semibold bg-teal-500 rounded-lg"><i class='bx bx-printer'></i></button> -->
                                </td>
                                <td>
                                    <?php $checkbill = $area->get_receiptById($value['b_id'], date('m'), date('Y')); ?>
                                    <?php if (!empty($checkbill)) { ?>
                                        <a href="../billpay.php?b_id=<?php echo $value['b_id'] ?>" class=" inline-block py-3 px-4 duration-150 hover:bg-pink-600 text-white font-semibold bg-pink-500 rounded-lg"><i class='bx bx-printer'></i></a>
                                        <!-- <button onclick="printBillPay(<?php echo $value['b_id'] ?>,<?php echo $key ?>)" id="BtnPrintBill" class="py-3 px-4 duration-150 hover:bg-pink-600 text-white font-semibold bg-pink-500 rounded-lg"><i class='bx bx-printer'></i></button> -->
                                    <?php } else { ?>
                                        <button disabled class="py-3 opacity-50 px-4 duration-150 text-white font-semibold bg-pink-600 rounded-lg"><i class='bx bx-printer'></i></button>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button onclick="changeBookItem(<?php echo $value['area_id'] ?>,<?php echo $value['b_id'] ?>,<?php echo $key ?>)" class="py-3 px-4 duration-150 hover:bg-orange-600 text-white font-semibold bg-orange-500 rounded-lg"><i class="fa-solid fa-expand"></i></button>
                                </td>
                                <td>
                                    <button onclick="changeBookItemData(<?php echo $value['b_id'] ?>,<?php echo $key ?>)" class="py-3 px-4 duration-150 hover:bg-yellow-600 text-white font-semibold bg-yellow-500 rounded-lg"><i class="fa-regular fa-pen-to-square"></i></button>
                                </td>
                                <td>
                                    <button onclick="deleteBookItem(<?php echo $value['b_id'] ?>,<?php echo $key ?>)" class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php $num++;
                        } ?>
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
    var modal = document.getElementById("my_modal_1");
    var btnclose = document.getElementById("btnclose");
    var btnsaveedit = document.querySelector("#btnsaveedit");
    var DataSelect = [];
    var DataXXD = [];
    var book_id = 0;
    var tableKey = 0;
    var btnsaveeditData = document.getElementById("btnsaveeditData");
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
        }
    });

    async function printBill(b_id, key) {
        var DataBookItem = await get_item_user(b_id);
        var FormDataX = new FormData();
        FormDataX.append('status', 'printBill');
        FormDataX.append('b_id', b_id);
        FormDataX.append('shop_name', DataBookItem.data.b_shop_name);
        FormDataX.append('firstname', DataBookItem.data.b_firstname);
        FormDataX.append('lastname', DataBookItem.data.b_lastname);
        FormDataX.append('price', DataBookItem.data.item_price);
        FormDataX.append('zone', DataBookItem.data.area_name);

        tableItemX.data()[key][10] = `<button disabled class="py-3 opacity-50 px-4 duration-150 text-white font-semibold bg-teal-600 rounded-lg"><i class='bx bx-loader bx-spin' ></i></button>`;
        tableItemX.row(key).data(tableItemX.data()[key]).draw();
        try {
            const res = await fetch('../bill.php', {
                method: 'POST',
                body: FormDataX
            })
        } catch (error) {
            console.log(error);
        }
        setTimeout(() => {
            tableItemX.data()[key][10] = `<button class="py-3 px-4 duration-150 hover:bg-teal-700 text-white font-semibold bg-teal-600 rounded-lg"><i class='bx bx-printer' ></i></button>`;
            tableItemX.row(key).data(tableItemX.data()[key]).draw();
        }, 2000);
    }

    async function setReceipt(b_id,tableIDX) {
        var data = await get_item_user(b_id);
        Swal.fire({
            title: "ใส่จำนวนเงินที่ชำระ",
            input: "number",
            inputAttributes: {
                autocapitalize: "off",
            },
            inputValue: data.data.item_price,
            showCancelButton: true,
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",
            showLoaderOnConfirm: true,
            preConfirm: async (login) => {
                var FormDataX = new FormData();
                FormDataX.append('status', 'setReceipt');
                FormDataX.append('b_id', b_id);
                FormDataX.append('price', login);
                try {
                    const res = await fetch('../../rest/rest.php', {
                        method: 'POST',
                        body: FormDataX
                    })
                    if (res.ok) {
                        const data = await res.json()      
                    }
                } catch (error) {
                    console.log(error);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                tableItemX.data()[tableIDX][9] = `<button disabled class="py-3 opacity-50 px-4 duration-150 text-white font-semibold bg-green-600 rounded-lg"><i class='bx bx-check'></i></button>`;
                tableItemX.data()[tableIDX][11] = `<a href="../billpay.php?b_id=${b_id}" class=" inline-block py-3 px-4 duration-150 hover:bg-pink-600 text-white font-semibold bg-pink-500 rounded-lg"><i class='bx bx-printer'></i></a>`;
                tableItemX.row(tableIDX).data(tableItemX.data()[tableIDX]).draw();
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    text: 'บันทึกข้อมูลสำเร็จ',
                    confirmButtonText: 'ตกลง',
                    confirmButtonColor: '#3085d6',
                })
            }
        });
    }
    async function printBillPay(b_id,tableIDX) {
        var DataBookItem = await get_item_user(b_id);
        var receiptData = await get_receiptId(DataBookItem.data.b_id);
        var FormDataX = new FormData();
        FormDataX.append('status', 'printBillPay');
        FormDataX.append('b_id', b_id);
        FormDataX.append('shop_name', DataBookItem.data.b_shop_name);
        FormDataX.append('firstname', DataBookItem.data.b_firstname);
        FormDataX.append('lastname', DataBookItem.data.b_lastname);
        FormDataX.append('price', receiptData.data.r_total);
        FormDataX.append('zone', DataBookItem.data.area_name);
        FormDataX.append('date', receiptData.data.r_month);
        FormDataX.append('receipt_id', receiptData.data.r_id);
        tableItemX.data()[tableIDX][11] = `<button disabled class="py-3 opacity-50 px-4 duration-150 text-white font-semibold bg-pink-600 rounded-lg"><i class='bx bx-loader bx-spin' ></i></button>`;
        tableItemX.row(tableIDX).data(tableItemX.data()[tableIDX]).draw();
        try {
            const res = await fetch('../billpay.php', {
                method: 'POST',
                body: FormDataX
            })
        } catch (error) {
            console.log(error);
        }
        setTimeout(() => {
            tableItemX.data()[tableIDX][11] = `<button onclick="printBillPay(${b_id},${tableIDX})" class="py-3 px-4 duration-150 hover:bg-pink-600 text-white font-semibold bg-pink-500 rounded-lg"><i class='bx bx-printer' ></i></button>`;
            tableItemX.row(tableIDX).data(tableItemX.data()[tableIDX]).draw();
        }, 2000);
    }

    async function get_receiptId(b_id){
        var FormDataX = new FormData();
        FormDataX.append('status', 'get_receiptId');
        FormDataX.append('b_id', b_id);
        try {
            const res = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: FormDataX
            })
            if (res.ok) {
                const data = await res.json()
                return data;
            }
        } catch (error) {
            console.log(error);
        }
    }

    async function deleteBookItem(b_id, tableIDX) {
        Swal.fire({
            title: 'คุณต้องการลบข้อมูลการจองใช่หรือไม่?',
            text: "คุณต้องการลบข้อมูลการจองใช่หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ไม่ใช่',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then(async (result) => {
            if (result.isConfirmed) {
                var FormDatax = new FormData();
                FormDatax.append('status', 'deleteBookItem');
                FormDatax.append('b_id', b_id);
                try {
                    const res = await fetch('../../rest/rest.php', {
                        method: 'POST',
                        body: FormDatax
                    })
                    if (res.ok) {
                        const data = await res.json()
                        if (data.status == 'success') {
                            tableItemX.row(tableIDX).remove().draw();
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลสำเร็จ',
                                text: 'ลบข้อมูลสำเร็จ',
                                confirmButtonText: 'ตกลง',
                                confirmButtonColor: '#3085d6',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ลบข้อมูลไม่สำเร็จ',
                                text: 'ลบข้อมูลไม่สำเร็จ',
                                confirmButtonText: 'ตกลง',
                                confirmButtonColor: '#3085d6',
                            })
                        }
                    }
                } catch (error) {
                    console.log(error);
                }
            }
        })
    }

    btnsaveeditData.addEventListener("click", async function() {
        var b_shop_name = document.getElementById("b_shop_name").value;
        var b_firstname = document.getElementById("b_firstname").value;
        var b_lastname = document.getElementById("b_lastname").value;
        var b_email = document.getElementById("b_email").value;
        var b_phone = document.getElementById("b_phone").value;
        if (b_shop_name != "" && b_firstname != "" && b_lastname != "" && b_email != "" && b_phone != "") {
            var regEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/;
            var thaiPhoneNumberRegex = /^0[0-9]{2}-[0-9]{7}$/;
            if (regEmail.test(b_email)) {
                if (thaiPhoneNumberRegex.test(b_phone)) {
                    var FormDatax = new FormData();
                    FormDatax.append('status', 'editBookItem');
                    FormDatax.append('b_id', book_id);
                    FormDatax.append('b_shop_name', b_shop_name);
                    FormDatax.append('b_firstname', b_firstname);
                    FormDatax.append('b_lastname', b_lastname);
                    FormDatax.append('b_email', b_email);
                    FormDatax.append('b_phone', b_phone);
                    try {
                        const res = await fetch('../../rest/rest.php', {
                            method: 'POST',
                            body: FormDatax
                        })
                        if (res.ok) {
                            const data = await res.json()
                            if (data.status == 'success') {
                                var row = tableItemX.data()[tableKey];
                                row[1] = b_shop_name;
                                row[2] = b_firstname + " " + b_lastname;
                                row[5] = b_email;
                                row[6] = b_phone;
                                tableItemX.row(tableKey).data(row).draw();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'แก้ไขข้อมูลสำเร็จ',
                                    text: 'แก้ไขข้อมูลสำเร็จ',
                                    confirmButtonText: 'ตกลง',
                                    confirmButtonColor: '#3085d6',
                                }).then(async (result) => {
                                    modal.classList.remove("modal-open");
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'แก้ไขข้อมูลไม่สำเร็จ',
                                    text: 'แก้ไขข้อมูลไม่สำเร็จ',
                                    confirmButtonText: 'ตกลง',
                                    confirmButtonColor: '#3085d6',
                                })
                            }
                        }
                    } catch (error) {
                        console.log(error);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'เบอร์โทรไม่ถูกต้อง',
                        text: 'กรุณากรอกเบอร์โทรให้ถูกต้อง',
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#3085d6',
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'อีเมลไม่ถูกต้อง',
                    text: 'กรุณากรอกอีเมลให้ถูกต้อง',
                    confirmButtonText: 'ตกลง',
                    confirmButtonColor: '#3085d6',
                })
            }
        }
    });

    btnclose.addEventListener("click", function() {
        modal.classList.remove("modal-open");
    });

    btnsaveedit.addEventListener("click", async function() {
        if (DataSelect.length != 0) {
            var FormDatax = new FormData();
            FormDatax.append('status', 'changeBookItem');
            FormDatax.append('b_id', book_id);
            FormDatax.append('item_id', DataSelect.item_id);
            try {
                const res = await fetch('../../rest/rest.php', {
                    method: 'POST',
                    body: FormDatax
                })
                if (res.ok) {
                    const data = await res.json()
                    if (data.status == 'success') {
                        var keyidx = 0
                        var Dataxsd = await getAreaitem(DataSelect.area_id);
                        for ([key, value] of Object.entries(Dataxsd.data)) {
                            if (value.item_id == DataSelect.item_id) {
                                keyidx = parseInt(key) + 1;
                                break;
                            }
                        }
                        var row = tableItemX.data()[tableKey];
                        row[3] = DataSelect.area_name;
                        row[4] = keyidx
                        row[12] = `<button onclick="changeBookItem(${DataSelect.area_id},${book_id},${tableKey})" class="py-3 px-4 duration-150 hover:bg-orange-600 text-white font-semibold bg-orange-500 rounded-lg"><i class="fa-solid fa-pen-to-square"></i></button>`;
                        tableItemX.row(tableKey).data(row).draw();
                        Swal.fire({
                            icon: 'success',
                            title: 'เปลี่ยนตำแหน่งสำเร็จ',
                            text: 'เปลี่ยนตำแหน่งสำเร็จ',
                            confirmButtonText: 'ตกลง',
                            confirmButtonColor: '#3085d6',
                        }).then(async (result) => {
                            modal.classList.remove("modal-open");
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เปลี่ยนตำแหน่งไม่สำเร็จ',
                            text: 'เปลี่ยนตำแหน่งไม่สำเร็จ',
                            confirmButtonText: 'ตกลง',
                            confirmButtonColor: '#3085d6',
                        })
                    }
                }
            } catch (error) {
                console.log(error);
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'ไม่สามารถย้ายตำแหน่งได้',
                text: 'กรุณาเลือกตำแหน่งที่ต้องการย้าย',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#3085d6',
            })
        }
    });

    async function changeBookItem(area_id, b_id, tableIDX) {
        var btnsaveeditData = document.getElementById("btnsaveeditData");
        btnsaveeditData.hidden = true;
        btnsaveedit.hidden = false;
        tableKey = tableIDX;
        book_id = b_id;
        DataSelect = [];
        modal.classList.add("modal-open");
        document.getElementById("modal-title").innerHTML = "แก้ไขข้อมูล";
        var modalcon = document.querySelector(".modal-con");
        modalcon.innerHTML = ''
        var divflex = document.createElement("div");
        divflex.setAttribute("class", "flex flex-col gap-3");
        var div1 = document.createElement("div");
        var labelselect = document.createElement("label");
        labelselect.setAttribute("class", "text-gray-700");
        labelselect.innerHTML = "เลือกโซน";
        var select = document.createElement("select");
        select.setAttribute("id", "selectarea");
        select.setAttribute("class", "w-full border-2 border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-blue-500");
        var option = document.createElement("option");
        option.setAttribute("value", "");
        option.innerHTML = "เลือกโซน";
        select.appendChild(option);
        var data = await getArea();
        data.data.forEach(element => {
            var option = document.createElement("option");
            option.setAttribute("value", element.area_id);
            option.innerHTML = element.area_name;
            select.appendChild(option);
            if (element.area_id == area_id) {
                option.setAttribute("selected", true);
            }
        });
        div1.appendChild(labelselect);
        div1.appendChild(select);
        divflex.appendChild(div1);
        var title = document.createElement("h3");
        title.setAttribute("class", "font-semibold text-lg");
        title.innerHTML = "เลือกตำแหน่งที่ต้องการย้าย";
        divflex.appendChild(title);
        var dataX = await getAreaitem(area_id);
        var divgrid = document.createElement("div");
        divgrid.setAttribute("class", "animate-fadeIn grid grid-cols-3 gap-3");
        divgrid.setAttribute("id", "divgrid");
        DataXXD = dataX.data;
        for ([key, value] of Object.entries(dataX.data)) {
            var div = document.createElement("div");
            div.setAttribute("class", "cursor-pointer py-9 px-3 bg-white shadow-lg rounded-lg border");
            div.setAttribute('id', `boxGridItem`);
            div.setAttribute('onclick', `changeAreaItemId('${value.item_id}')`);
            var p = document.createElement("p");
            p.setAttribute("class", "text-center text-md font-semibold");
            p.innerHTML = `ตำแหน่งที่ ${(parseInt(key) + 1)}`
            div.appendChild(p);
            if (value.item_active > 0) {
                var small = document.createElement("small");
                small.setAttribute("class", "block text-center text-md font-semibold text-green-500");
                small.innerHTML = `มีการจอง`
                div.appendChild(small);
            }
            divgrid.appendChild(div);
        }
        divflex.appendChild(divgrid);
        modalcon.appendChild(divflex);

        var selectarea = document.getElementById("selectarea");
        selectarea.addEventListener("change", async function() {
            DataSelect = [];
            if (selectarea.value != "") {
                var dataXD = await getAreaitem(selectarea.value);
                DataXXD = dataXD.data;
                var divgrid = document.getElementById("divgrid");
                divgrid.innerHTML = '';
                for ([key, value] of Object.entries(dataXD.data)) {
                    var div = document.createElement("div");
                    div.setAttribute("class", "cursor-pointer animate-zoom-animation py-9 px-3 bg-white shadow-lg rounded-lg border");
                    div.setAttribute('id', `boxGridItem`);
                    div.setAttribute('onclick', `changeAreaItemId('${value.item_id}')`);
                    var p = document.createElement("p");
                    p.setAttribute("class", "text-center text-md font-semibold");
                    p.innerHTML = `ตำแหน่งที่ ${(parseInt(key) + 1)}`
                    div.appendChild(p);
                    if (value.item_active > 0) {
                        var small = document.createElement("small");
                        small.setAttribute("class", "block text-center text-md font-semibold text-green-500");
                        small.innerHTML = `มีการจอง`
                        div.appendChild(small);
                    }
                    divgrid.appendChild(div);
                }
            } else {
                var divgrid = document.getElementById("divgrid");
                divgrid.innerHTML = '';
            }
        });
    }
    async function changeAreaItemId(item_id) {
        var idxkevActive = 0;
        var boxGridItem = document.querySelectorAll("#boxGridItem");
        boxGridItem.forEach((element, index) => {
            if (element.classList.contains('outline')) {
                idxkevActive = index;
            }
        });
        for ([key, value] of Object.entries(DataXXD)) {
            if (value.item_id == item_id) {
                if (value.item_active > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สามารถเลือกตำแหน่งนี้ได้',
                        text: 'ตำแหน่งนี้มีการจองแล้ว',
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#3085d6',
                    })
                } else {
                    DataSelect = value;
                    boxGridItem[idxkevActive].classList.remove("outline", "outline-blue-500", "outline-2", "outline-offset-2");
                    if (!boxGridItem[key].classList.contains('outline')) {
                        boxGridItem[key].classList.add("outline", "outline-blue-500", "outline-2", "outline-offset-2");
                    } else {
                        boxGridItem[key].classList.remove("outline", "outline-blue-500", "outline-2", "outline-offset-2");
                    }
                }
            }
        }
    }

    async function getArea() {
        try {
            var FormDatax = new FormData();
            FormDatax.append('status', 'getArea');
            const res = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: FormDatax
            })
            if (res.ok) {
                const data = await res.json()
                return data
            }
            const data = await res.json()
            return data
        } catch (error) {
            console.log(error);
        }
    }

    async function changeBookItemData(b_id, tableIDX) {
        tableKey = tableIDX;
        book_id = b_id;
        var btnsaveeditData = document.getElementById("btnsaveeditData");
        btnsaveeditData.hidden = false;
        btnsaveedit.hidden = true;
        var Book = await getBookItemById(b_id);
        var DataBook = Book.data[0]
        var modalcon = document.querySelector(".modal-con");
        modalcon.innerHTML = ''
        var modaltitle = document.getElementById("modal-title");
        modaltitle.innerHTML = "แก้ไขข้อมูล";
        var divflex = document.createElement("div");
        divflex.setAttribute("class", "flex flex-col gap-3");
        var div1 = document.createElement("div");
        var labelselect = document.createElement("label");
        labelselect.setAttribute("class", "text-gray-700");
        labelselect.innerHTML = "ชื่อร้าน";
        var input = document.createElement("input");
        input.setAttribute("id", "b_shop_name");
        input.setAttribute("class", "w-full border-2 border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-blue-500");
        input.setAttribute("type", "text");
        input.setAttribute("value", DataBook.b_shop_name);
        div1.appendChild(labelselect);
        div1.appendChild(input);
        divflex.appendChild(div1);
        var div2 = document.createElement("div");
        div2.setAttribute("class", "flex gap-3");
        var div2_1 = document.createElement("div");
        var labelselect2_1 = document.createElement("label");
        labelselect2_1.setAttribute("class", "text-gray-700");
        labelselect2_1.innerHTML = "ชื่อ";
        var input2_1 = document.createElement("input");
        input2_1.setAttribute("id", "b_firstname");
        input2_1.setAttribute("class", "w-full border-2 border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-blue-500");
        input2_1.setAttribute("type", "text");
        input2_1.setAttribute("value", DataBook.b_firstname);
        div2_1.appendChild(labelselect2_1);
        div2_1.appendChild(input2_1);
        div2.appendChild(div2_1);
        var div2_2 = document.createElement("div");
        var labelselect2_2 = document.createElement("label");
        labelselect2_2.setAttribute("class", "text-gray-700");
        labelselect2_2.innerHTML = "นามสกุล";
        var input2_2 = document.createElement("input");
        input2_2.setAttribute("id", "b_lastname");
        input2_2.setAttribute("class", "w-full border-2 border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-blue-500");
        input2_2.setAttribute("type", "text");
        input2_2.setAttribute("value", DataBook.b_lastname);
        div2_2.appendChild(labelselect2_2);
        div2_2.appendChild(input2_2);
        div2.appendChild(div2_2);
        divflex.appendChild(div2);
        var div3 = document.createElement("div");
        var labelselect3 = document.createElement("label");
        labelselect3.setAttribute("class", "text-gray-700");
        labelselect3.innerHTML = "อีเมล";
        var input3 = document.createElement("input");
        input3.setAttribute("id", "b_email");
        input3.setAttribute("class", "w-full border-2 border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-blue-500");
        input3.setAttribute("type", "text");
        input3.setAttribute("value", DataBook.b_email);
        div3.appendChild(labelselect3);
        div3.appendChild(input3);
        divflex.appendChild(div3);
        var div4 = document.createElement("div");
        var labelselect4 = document.createElement("label");
        labelselect4.setAttribute("class", "text-gray-700");
        labelselect4.innerHTML = "เบอร์โทร";
        var input4 = document.createElement("input");
        input4.setAttribute("id", "b_phone");
        input4.setAttribute("class", "w-full border-2 border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-blue-500");
        input4.setAttribute("type", "text");
        input4.setAttribute("value", DataBook.b_phone);
        div4.appendChild(labelselect4);
        div4.appendChild(input4);
        divflex.appendChild(div4);
        modalcon.appendChild(divflex);

        modal.classList.add("modal-open");
    }

    async function getBookItemById(b_id) {
        var FormDatax = new FormData();
        FormDatax.append('status', 'getBookItemById');
        FormDatax.append('b_id', b_id);
        const res = await fetch('../../rest/rest.php', {
            method: 'POST',
            body: FormDatax
        })
        if (res.ok) {
            const data = await res.json()
            return data
        }
    }

    async function get_item_user(id) {
        var data = new FormData();
        data.append('status', 'getItemBookByiD');
        data.append('b_id', id);
        var response = await fetch('../../rest/rest.php', {
            method: 'POST',
            body: data
        });
        if (response.ok) {
            var res = await response.json();
            return res;
        }
    }

    async function getAreaitem(id) {
        var data = new FormData();
        data.append('status', 'getAreaitems');
        data.append('area_id', id);
        var response = await fetch('../../rest/rest.php', {
            method: 'POST',
            body: data
        });
        if (response.ok) {
            var res = await response.json();
            return res;
        }
    }
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>


</html>