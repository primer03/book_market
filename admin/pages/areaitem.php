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
$page = 'จัดการข้อมูลพื้นที่ร้านค้า'
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

    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
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
                <!-- <div class="flex flex-col gap-3">
                    <div>
                        <label for="">เลือกโซนที่คุณต้องการเพิ่มร้านค้า</label>
                        <select class="select select-bordered w-full">
                            <option disabled selected>Who shot first?</option>
                            <option>Han Solo</option>
                            <option>Greedo</option>
                        </select>
                    </div>
                    <div>
                        <label for="">ความกว้าง</label>
                        <input type="number" id="inputWidth" placeholder="ความกว้าง" class="input input-bordered w-full">
                    </div>
                    <div>
                        <label for="">ความยาว</label>
                        <input type="number" id="inputHeight" placeholder="ความสูง" class="input input-bordered w-full">
                    </div>
                    <div>
                        <label for="">ราคา</label>
                        <input type="number" id="inputHeight" placeholder="ราคา" class="input input-bordered w-full">
                    </div>
                </div> -->
                <div class="modal-wh"></div>
            </div>
            <div class=" flex justify-end gap-3 mt-3">
                <button type="button" id="btnsaveedit" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">บันทึก</button>
                <button type="button" hidden id="BtnSaveDelete" class="py-3 px-8 duration-200 hover:bg-red-700 hover:text-white rounded-lg text-red-700 border-2 border-red-700">ลบ</button>
                <button type="button" hidden id="BtnSaveAdd" class="py-3 px-8 duration-200 hover:bg-green-700 hover:text-white rounded-lg text-green-700 border-2 border-green-700">เพิ่ม</button>
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

        <div class="w-full px-6 py-6 mx-auto">
            <!-- content -->
            <button id="BtnAddAreaItem" type="button" class=" shadow-md py-3 px-6 duration-200 hover:bg-green-700 rounded-lg bg-green-600 font-semibold text-white mb-3 text-xl"><i class="fa-regular fa-square-plus"></i> เพิ่มพื้นที่ร้านค้า</button>
            <div class="w-full animate-fadeIn bg-white p-3 rounded-lg shadow-lg">
                <table id="tableitem" class="table table-zebra hover text-center">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ลำดับ</th>
                            <th style="text-align: center;">ชื่อโซน</th>
                            <th style="text-align: center;">จำนวนพื้นที่ร้านค้า</th>
                            <th style="text-align: center;">พื้นที่ที่จอง</th>
                            <th style="text-align: center;">แก้ไข</th>
                            <th style="text-align: center;">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $c = 1;
                        foreach ($area_data as $key => $value) { ?>
                            <?php
                            $area_itemx = $area->getAreaItem($value['area_id']);
                            $count_active = 0;
                            foreach ($area_itemx as $key => $value) {
                                if ($value['item_active'] == 1) {
                                    $count_active++;
                                }
                            }
                            if (count($area_itemx) == 0) {
                                $percent = 0;
                            } else {
                                $percent = ($count_active / count($area_itemx)) * 100;
                                $percent = number_format($percent, 0);
                            }

                            if ($percent <= 25) {
                                $color = 'bg-red-600'; // Red for 25% or less
                            } elseif ($percent <= 50) {
                                $color = 'bg-orange-600'; // Orange for 50% or less
                            } elseif ($percent <= 75) {
                                $color = 'bg-yellow-600'; // Yellow for 75% or less
                            } else {
                                $color = 'bg-green-600'; // Green for more than 75%
                            }
                            ?>
                            <tr>
                                <td><?php echo $c ?></td>
                                <td class=" font-semibold"><?php echo $value['area_name'] ?></td>
                                <td><?php echo count($area_itemx) ?></td>
                                <td>
                                    <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                                        <?php if ($percent != 0) { ?>
                                            <div class="<?php echo $color ?> h-4 text-xs text-white rounded-full dark:bg-teal-300" style="width: <?php echo $percent ?>%"><?php echo $count_active ?></div>
                                        <?php } else { ?>
                                            <div class="bg-gray-300  h-4 text-xs text-white rounded-full dark:bg-teal-300" style="width: <?php echo $percent ?>%"></div>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td><button onclick="editAreaItem(<?php echo $value['area_id'] ?>)" class="py-3 px-6 duration-200 hover:bg-orange-600 text-white rounded-lg text-xl font-semibold bg-orange-500"><i class='bx bx-edit'></i></button></td>
                                <td><button onclick="deleteAreaItem(<?php echo $value['area_id']; ?>, '<?php echo $value['area_name']; ?>')" class="py-3 px-6 duration-200 hover:bg-red-600 text-white rounded-lg text-xl font-semibold bg-red-500"><i class='bx bxs-trash'></i></button></td>
                            </tr>
                        <?php
                            $c++;
                        }
                        ?>
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
    var mytable = document.getElementById('tableitem');
    var modal = document.getElementById("my_modal_1");
    var btnclose = document.getElementById("btnclose");
    var selectitem = document.getElementById("slectitem");
    var DataItemDel = [];
    var btnsaveedit = document.getElementById("btnsaveedit");
    var BtnSaveDelete = document.getElementById("BtnSaveDelete");
    var BtnAddAreaItem = document.querySelector("#BtnAddAreaItem");
    var BtnSaveAdd = document.getElementById("BtnSaveAdd");
    var tabledata = new DataTable(mytable, {
        searchable: true,
        fixedHeight: true,
        fixedHeader: false,
        responsive: true,
        paging: true,
        perPage: 10,
        perPageSelect: true,
        language: {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ แถว)",
            "zeroRecords": "ไม่พบข้อมูล",
            "search": "ค้นหา",
            "paginate": {
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
        }
    });
    btnclose.addEventListener("click", function() {
        modal.classList.remove("modal-open");
    });

    BtnSaveAdd.addEventListener("click", async function() {
        var SelectItem = document.querySelector("#SelectItem");
        var regex = /^[1-9]\d*$/; //ใส่ได้เฉพาะตัวเลข
        console.log(SelectItem.value);
        if (SelectItem.value != 'เลือก') {
            if (regex.test(inputWidthItem.value) && regex.test(inputHeightItem.value) && regex.test(inputPriceItem.value)) {
                var FormDataX = new FormData();
                FormDataX.append('status', 'insertAreaItem');
                FormDataX.append('area_id', SelectItem.value);
                FormDataX.append('item_height', inputHeightItem.value);
                FormDataX.append('item_width', inputWidthItem.value);
                FormDataX.append('item_price', inputPriceItem.value);
                try {
                    var respons = await fetch('../../rest/rest.php', {
                        method: 'POST',
                        body: FormDataX,
                    });
                    if(respons.ok){
                        // var res = await respons.json();
                        // console.log(res);
                        var res = await respons.json();
                        if(res.status == 'success'){
                            var count = await count_area(SelectItem.value);
                            // console.log(count);
                            var percent = 0
                            if (count.data.check == true) {
                                percent = (count.data.use / count.data.notuse) * 100;
                                percent = percent.toFixed(0);
                            }
                            var progress = ''
                            var color = ''
                            if (percent <= 25) {
                                color = 'bg-red-600'; // Red for 25% or less
                            } else if (percent <= 50) {
                                color = 'bg-orange-600'; // Orange for 50% or less
                            } else if (percent <= 75) {
                                color = 'bg-yellow-600'; // Yellow for 75% or less
                            } else {
                                color = 'bg-green-600'; // Green for more than 75%
                            }
                            if (percent > 0) {
                                progress = `<div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                                <div class="${color} h-4 text-xs text-white rounded-full dark:bg-teal-300" style="width: ${percent}%">${count.data.use}</div>
                                </div>`
                            } else {
                                progress = `<div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                                <div class="bg-gray-300  h-4 text-xs text-white rounded-full dark:bg-teal-300" style="width: ${percent}%"></div>
                                </div>`
                            }
                            var table = $('#tableitem').DataTable();
                            // console.log(table.data());
                            table.rows().every(function() {
                                var data = this.data();
                                if (data[1] == SelectItem.options[SelectItem.selectedIndex].text) {
                                    data[2] = `${parseInt(data[2]) + 1}`;
                                    data[3] = progress;
                                    this.data(data);
                                }
                            });
                            table.draw();
                            modal.classList.remove("modal-open");
                            Swal.fire({
                                icon: 'success',
                                title: 'เพิ่มข้อมูลสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                } catch (error) {
                    console.log(error);
                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณาตรวจสอบข้อมูลให้ถูกต้อง',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณาเลือกโซนที่ต้องการเพิ่มร้านค้า',
                showConfirmButton: false,
                timer: 1500
            })
        }
    })

    BtnAddAreaItem.addEventListener("click", async function() {
        var BtnSaveAdd = document.getElementById("BtnSaveAdd");
        BtnSaveAdd.hidden = false;
        var BtnSaveDelete = document.getElementById("BtnSaveDelete");
        BtnSaveDelete.hidden = true;
        var btnsaveedit = document.getElementById("btnsaveedit");
        btnsaveedit.hidden = true;
        var title = document.getElementById("modal-title");
        title.innerHTML = "เพิ่มพื้นที่ร้านค้า";
        var modalcon = document.querySelector(".modal-con");
        var titleDel = document.getElementById("titleDel");
        titleDel.classList.add("hidden");
        modalcon.innerHTML = "";
        var divflex = document.createElement("div");
        divflex.setAttribute("class", " flex flex-col gap-3");
        divflex.setAttribute("id", "divflex");
        var dicslect = document.createElement("div");
        var label = document.createElement("label");
        label.setAttribute("for", "");
        label.innerHTML = "เลือกโซนที่คุณต้องการเพิ่มร้านค้า";
        dicslect.appendChild(label);
        var select = document.createElement("select");
        select.setAttribute("id", "SelectItem");
        select.setAttribute("class", "select select-bordered w-full");
        var option = document.createElement("option");
        option.setAttribute("disabled", "");
        option.setAttribute("selected", "");
        option.innerHTML = "เลือก";
        select.appendChild(option);
        var areaItem = await getArea();
        var area_item = areaItem.data;
        for ([key, value] of Object.entries(area_item)) {
            var option = document.createElement("option");
            option.setAttribute("value", value.area_id);
            option.innerHTML = value.area_name;
            select.appendChild(option);
        }
        dicslect.appendChild(select);
        divflex.appendChild(dicslect);
        var div1 = document.createElement("div");
        var label = document.createElement("label");
        label.setAttribute("for", "");
        label.innerHTML = "ความกว้าง";
        div1.appendChild(label);
        var inputWidth = document.createElement("input");
        inputWidth.setAttribute("type", "number");
        inputWidth.setAttribute("id", "inputWidthItem");
        inputWidth.setAttribute("placeholder", "ความกว้าง");
        inputWidth.setAttribute("class", "input input-bordered w-full");
        div1.appendChild(inputWidth);
        divflex.appendChild(div1);
        var div2 = document.createElement("div");
        var label = document.createElement("label");
        label.setAttribute("for", "");
        label.innerHTML = "ความยาว";
        div2.appendChild(label);
        var inputHeight = document.createElement("input");
        inputHeight.setAttribute("type", "number");
        inputHeight.setAttribute("id", "inputHeightItem");
        inputHeight.setAttribute("placeholder", "ความสูง");
        inputHeight.setAttribute("class", "input input-bordered w-full");
        div2.appendChild(inputHeight);
        divflex.appendChild(div2);
        var div3 = document.createElement("div");
        var label = document.createElement("label");
        label.setAttribute("for", "");
        label.innerHTML = "ราคาค่าเช่าต่อเดือน";
        div3.appendChild(label);
        var inputPrice = document.createElement("input");
        inputPrice.setAttribute("type", "number");
        inputPrice.setAttribute("id", "inputPriceItem");
        inputPrice.setAttribute("placeholder", "ราคาค่าเช่าต่อเดือน");
        inputPrice.setAttribute("class", "input input-bordered w-full");
        div3.appendChild(inputPrice);
        divflex.appendChild(div3);
        modalcon.appendChild(divflex);
        modal.classList.add("modal-open");
    });


    async function deleteAreaItem(id, area_name) {
        var BtnSaveAdd = document.getElementById("BtnSaveAdd");
        BtnSaveAdd.hidden = true;
        var titleDel = document.getElementById("titleDel");
        titleDel.classList.remove("hidden");
        titleDel.innerHTML = "เลือกพื้นที่ร้านค้าที่คุณต้องการลบ";
        modal.classList.add("modal-open");
        var BtnSaveDelete = document.getElementById("BtnSaveDelete");
        BtnSaveDelete.hidden = false;
        var btnsaveedit = document.getElementById("btnsaveedit");
        btnsaveedit.hidden = true;
        var DataItem = await getAreaitem(id);
        var title = document.getElementById("modal-title");
        var ModalCon = document.querySelector(".modal-con");
        ModalCon.innerHTML = "";
        title.innerHTML = "ลบข้อมูลพื้นที่ร้านค้า";
        console.log(DataItem);
        var divgrid = document.createElement("div");
        divgrid.setAttribute("class", " animate-fadeIn grid grid-cols-3 gap-5");
        divgrid.setAttribute("id", "divgrid");
        for ([key, value] of Object.entries(DataItem.data)) {
            var div = document.createElement("div");
            div.setAttribute("class", "cursor-pointer py-9 px-3 bg-white shadow-lg rounded-lg border");
            div.setAttribute('id', `boxGridItem`);
            div.setAttribute('onclick', `activeDelete(${value.item_id},${key},'${area_name}',${id})`);
            var p = document.createElement("p");
            p.setAttribute("class", "text-center text-md font-semibold");
            p.innerHTML = `ตำแหน่งที่ ${(parseInt(key) + 1)}`
            div.appendChild(p);
            if (value.item_active == 1) {
                var small = document.createElement("small");
                small.setAttribute("class", "block text-center text-md font-semibold text-green-500");
                small.innerHTML = `มีการจอง`
                div.appendChild(small);
            }
            divgrid.appendChild(div);
        }
        ModalCon.appendChild(divgrid);
    }

    async function activeDelete(id, idx, area_name, area_id) {
        var ModalCon = document.querySelector(".modal-con");
        var boxGridItem = document.querySelectorAll("#boxGridItem");
        boxGridItem.forEach((element, index) => {
            if (idx == index) {
                if (element.classList.contains('active')) {
                    DataItemDel = DataItemDel.filter(function(item) {
                        return item.id !== id
                    })
                    element.classList.remove('active', 'outline', 'outline-offset-2', 'outline-red-500')
                } else {
                    DataItemDel.push({
                        id: id,
                        index: idx,
                        area_name: area_name,
                        area_id: area_id
                    });
                    element.classList.add('active', 'outline', 'outline-offset-2', 'outline-red-500')
                }
            }
        });
        // console.log(DataItemDel);
    }

    BtnSaveDelete.onclick = async function() {
        if (DataItemDel.length > 0) {
            Swal.fire({
                title: "คุณต้องการลบข้อมูลพื้นที่ร้านค้า?",
                text: "ถ้าลบข้อมูลการจองจะถูกลบไปด้วย",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "<i class='bx bx-check'></i> ยืนยัน",
                cancelButtonText: "<i class='bx bx-x'></i> ยกเลิก",
            }).then((result) => {
                if (result.isConfirmed) {
                    DataItemDel.forEach(async function(item) {
                        var DataRes = await DeleteAreaItemById(item.id);
                        // var DataRes = {
                        //     status: 'success'
                        // }
                        console.log(DataRes);
                        if (DataRes.status == 'success') {
                            var count = await count_area(item.area_id);
                            // console.log(count);
                            var percent = 0
                            if (count.data.check == true) {
                                percent = (count.data.use / count.data.notuse) * 100;
                                percent = percent.toFixed(0);
                            }
                            var progress = ''
                            var color = ''
                            if (percent <= 25) {
                                color = 'bg-red-600'; // Red for 25% or less
                            } else if (percent <= 50) {
                                color = 'bg-orange-600'; // Orange for 50% or less
                            } else if (percent <= 75) {
                                color = 'bg-yellow-600'; // Yellow for 75% or less
                            } else {
                                color = 'bg-green-600'; // Green for more than 75%
                            }
                            if (percent > 0) {
                                progress = `<div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                                <div class="${color} h-4 text-xs text-white rounded-full dark:bg-teal-300" style="width: ${percent}%">${count.data.use}</div>
                                </div>`
                            } else {
                                progress = `<div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                                <div class="bg-gray-300  h-4 text-xs text-white rounded-full dark:bg-teal-300" style="width: ${percent}%"></div>
                                </div>`
                            }
                            var table = $('#tableitem').DataTable();
                            // console.log(table.data());
                            table.rows().every(function() {
                                var data = this.data();
                                if (data[1] == item.area_name) {
                                    data[2] = `${data[2] - 1}`;
                                    data[3] = progress;
                                    this.data(data);
                                }
                            });
                            table.draw();
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            modal.classList.remove("modal-open");
                            // window.location.reload();
                        }
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณาเลือกพื้นที่ร้านค้าที่ต้องการลบ',
                showConfirmButton: false,
                timer: 1500
            })
        }
    }

    async function count_area(area_id) {
        try {
            var data = new FormData();
            data.append('status', 'count_area');
            data.append('area_id', area_id);
            var response = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: data
            });
            if (response.ok) {
                var res = await response.json();
                return res;
            }
        } catch (error) {
            console.log(error);
        }
    }

    async function DeleteAreaItemById(item_id) {
        try {
            var data = new FormData();
            data.append('status', 'deleteAreaItem');
            data.append('item_id', item_id);
            var response = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: data
            });
            if (response.ok) {
                var res = await response.json();
                return res;
            }
        } catch (error) {
            console.log(error);
        }
    }

    btnsaveedit.onclick = async function() {
        var regex = /^[1-9]\d*$/; //ใส่ได้เฉพาะตัวเลข
        if (slectitem.value != 'เลือก') {
            var inputWidth = document.getElementById("inputWidth");
            var inputHeight = document.getElementById("inputHeight");
            var inputPrice = document.getElementById("inputPrice");
            if (regex.test(inputWidth.value) && regex.test(inputHeight.value) && regex.test(inputPrice.value)) {
                var datares = await updateAreaItem(slectitem.value, inputHeight.value, inputWidth.value, inputPrice.value);
                if (datares.status == 'success') {
                    modal.classList.remove("modal-open");
                    Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขข้อมูลสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        }
    }

    async function updateAreaItem(id, height, width,price) {
        try {
            var data = new FormData();
            data.append('status', 'updateAreaItem');
            data.append('item_id', id);
            data.append('item_height', height);
            data.append('item_width', width);
            data.append('item_price', price);
            var response = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: data
            });
            if (response.ok) {
                var res = await response.json();
                return res;
            }
        } catch (error) {
            console.log(error);
        }
    }

    async function editAreaItem(id) {
        var BtnSaveAdd = document.getElementById("BtnSaveAdd");
        BtnSaveAdd.hidden = true;
        var titleDel = document.getElementById("titleDel");
        titleDel.innerHTML = "";
        titleDel.classList.add("hidden");
        var BtnSaveDelete = document.getElementById("BtnSaveDelete");
        BtnSaveDelete.hidden = true;
        var btnsaveedit = document.getElementById("btnsaveedit");
        btnsaveedit.hidden = false;
        modal.classList.add("modal-open");
        var title = document.getElementById("modal-title");
        title.innerHTML = "แก้ไขข้อมูลพื้นที่ร้านค้า";
        var modalcon = document.querySelector(".modal-con");
        modalcon.innerHTML = "";
        var divflex = document.createElement("div");
        divflex.setAttribute("class", " flex flex-col gap-3");
        divflex.setAttribute("id", "divflex");
        var label = document.createElement("label");
        label.setAttribute("for", "");
        label.innerHTML = "เลือกพื้นที่ร้านค้าที่คุณต้องการแก้ไข";
        divflex.appendChild(label);
        var select = document.createElement("select");
        select.setAttribute("id", "slectitem");
        select.setAttribute("class", "select select-bordered w-full");
        select.setAttribute("onchange", "changeitem()");
        var option = document.createElement("option");
        option.setAttribute("disabled", "");
        option.setAttribute("selected", "");
        option.innerHTML = "เลือก";
        select.appendChild(option);
        var area = await getAreaitem(id);
        var area_item = area.data;
        for ([key, value] of Object.entries(area_item)) {
            var option = document.createElement("option");
            option.setAttribute("value", value.item_id);
            option.innerHTML = `ตำแหน่งที่ ${(parseInt(key) + 1)}`
            select.appendChild(option);
        }
        divflex.appendChild(select);
        modalcon.appendChild(divflex);
        var modal_wh = document.createElement("div");
        modal_wh.setAttribute("class", "modal-wh");
        modalcon.appendChild(modal_wh);

    }

    async function changeitem() {
        var dataitem = await getAreaItemById(slectitem.value);
        var modal_wh = document.querySelector(".modal-wh");
        modal_wh.innerHTML = "";
        var divflex = document.createElement("div");
        divflex.setAttribute("class", "animate-fadeIn flex flex-col gap-3 mt-3");
        divflex.setAttribute("id", "divflex");
        var div1 = document.createElement("div");
        var label = document.createElement("label");
        label.setAttribute("for", "");
        label.innerHTML = "ความกว้าง";
        div1.appendChild(label);
        var inputWidth = document.createElement("input");
        inputWidth.setAttribute("type", "number");
        inputWidth.setAttribute("id", "inputWidth");
        inputWidth.setAttribute("placeholder", "ความกว้าง");
        inputWidth.setAttribute("value", dataitem.data[0].item_width);
        inputWidth.setAttribute("class", "input input-bordered w-full");
        div1.appendChild(inputWidth);
        divflex.appendChild(div1);
        var div2 = document.createElement("div");
        var label = document.createElement("label");
        label.setAttribute("for", "");
        label.innerHTML = "ความยาว";
        div2.appendChild(label);
        var inputHeight = document.createElement("input");
        inputHeight.setAttribute("type", "number");
        inputHeight.setAttribute("id", "inputHeight");
        inputHeight.setAttribute("placeholder", "ความสูง");
        inputHeight.setAttribute("value", dataitem.data[0].item_height);
        inputHeight.setAttribute("class", "input input-bordered w-full");
        div2.appendChild(inputHeight);
        divflex.appendChild(div2);
        var div3 = document.createElement("div");
        var label = document.createElement("label");
        label.setAttribute("for", "");
        label.innerHTML = "ราคาค่าเช่าต่อเดือน";
        div3.appendChild(label);
        var inputPrice = document.createElement("input");
        inputPrice.setAttribute("type", "number");
        inputPrice.setAttribute("id", "inputPrice");
        inputPrice.setAttribute("placeholder", "ราคา");
        inputPrice.setAttribute("value", dataitem.data[0].item_price);
        inputPrice.setAttribute("class", "input input-bordered w-full");
        div3.appendChild(inputPrice);
        divflex.appendChild(div3);
        modal_wh.appendChild(divflex);
    }

    async function getAreaItemById(id) {
        try {
            var data = new FormData();
            data.append('status', 'getAreaItemID');
            data.append('item_id', id);
            var response = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: data
            });
            if (response.ok) {
                var res = await response.json();
                return res;
            }
        } catch (error) {
            console.log(error);
        }
    }

    async function getArea() {
        try {
            var data = new FormData();
            data.append('status', 'getArea');
            var response = await fetch('../../rest/rest.php', {
                method: 'POST',
                body: data
            });
            if (response.ok) {
                var res = await response.json();
                return res;
            }
        } catch (error) {
            console.log(error);
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
<!-- plugin for scrollbar  -->
<!-- <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script> -->
<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>


</html>