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
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Soft UI Dashboard Tailwind</title>
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
        <p class="py-2" id="titleDel"></p>
        <div class="mt-3">
            <div class="modal-con">
                <div class="modal-wh"></div>
            </div>
            <div class=" flex justify-end gap-3 mt-3">
                <button type="button" id="btnsaveedit" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">บันทึก</button>
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
                <table id="tableitem" class="table table-zebra hover text-center">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ลำดับ</th>
                            <th style="text-align: center;">ชื่อร้าน</th>
                            <th style="text-align: center;">ชื่อ-นามสกุล</th>
                            <th style="text-align: center;">ชื่อโซน</th>
                            <th style="text-align: center;">ตำแหน่งร้านค้า</th>
                            <th style="text-align: center;">อีเมล</th>
                            <th style="text-align: center;">เบอร์โทร</th>
                            <th style="text-align: center;">วัน-เวลาที่ขอจอง</th>
                            <th style="text-align: center;">วัน-เวลาที่อนุมัติ</th>
                            <th style="text-align: center;">ชำระเงิน</th>
                            <th style="text-align: center;">พิมพ์ใบแจ้งชำระ</th>
                            <th style="text-align: center;">พิมพ์ใบเสร็จรับเงิน</th>
                            <th style="text-align: center;">แก้ไข</th>
                            <th style="text-align: center;">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookitem as $key => $value) { ?>
                            <tr>
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
                                        <button class="py-3 px-4 duration-150 hover:bg-green-700 text-white font-semibold bg-green-600 rounded-lg"><i class='bx bx-check'></i></button>
                                    <?php } ?>
                                <td>
                                    <button id="btnApprove" class="py-3 px-4 duration-150 hover:bg-teal-600 text-white font-semibold bg-teal-500 rounded-lg"><i class='bx bx-printer'></i></button>
                                </td>
                                <td>
                                    <button class="py-3 px-4 duration-150 hover:bg-pink-700 text-white font-semibold bg-pink-600 rounded-lg"><i class='bx bx-printer'></i></button>
                                </td>
                                <td>
                                    <button onclick="changeBookItem(<?php echo $value['area_id'] ?>)" class="py-3 px-4 duration-150 hover:bg-orange-600 text-white font-semibold bg-orange-500 rounded-lg"><i class="fa-solid fa-pen-to-square"></i></button>
                                </td>
                                <td>
                                    <button class="py-3 px-4 duration-150 hover:bg-red-600 text-white font-semibold bg-red-500 rounded-lg"><i class="fa-solid fa-trash"></i></button>
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

    btnclose.addEventListener("click", function() {
        modal.classList.remove("modal-open");
    });

    async function changeBookItem(area_id) {
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
        modalcon.appendChild(divflex);
        var divgrid = document.createElement("div");
        divgrid.setAttribute("class", "grid grid-cols-3 gap-3");
        var div2 = document.createElement("div");
        



        var selectarea =document.getElementById("selectarea");
        selectarea.addEventListener("change", async function() {
            console.log(selectarea.value);
        });
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
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>


</html>