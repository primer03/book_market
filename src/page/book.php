<link rel="stylesheet" href="../dist/output.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<?php
if (!isset($_COOKIE['login'])) {
    header("Location: ../index.php");
}
include_once "Model/AreaModel.php";
$area = new AreaModel();
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
    // เพิ่มอีกตามที่ต้องการ
];
$char = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
$areaData = $area->getArea();
$areaUser = $area->getitemUser($_SESSION['user_id']);
$zoneData = [];
foreach ($areaUser as $key => $value) {
    $zoneData[] = $value['area_name'];
}
$zoneData = array_unique($zoneData);
?>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-3"><i class="fa-solid fa-circle-info"></i> ข้อมูลการจอง</h3>
        <h2  class="font-bold text-md mb-3 item-priceItem"><i class="fa-solid fa-money-check-dollar text-green-600"></i> 100 บาท/เดือน</h2>
        <div class="flex flex-col gap-3">
            <form class="flex gap-3 flex-col">
                <input type="text" placeholder="ขื่อร้าน" name="shopname" class="input input-bordered w-full" />
                <div class="flex gap-3">
                    <input type="text" placeholder="ขื่อ" name="firstname" class="input input-bordered w-full" />
                    <input type="text" placeholder="นามสกุล" name="lastname" class="input input-bordered w-full" />
                </div>
                <input type="email" placeholder="อีเมล" name="email" class="input input-bordered w-full" />
                <div class="phonenum">
                    <input type="tel" placeholder="เบอร์โทร" name="phone" class="input input-bordered w-full" />
                    <!-- <small class="text-red-600">*ตัวอย่าง 092-XXXXXXX</small> -->
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="submit" id="cancel-area" class=" p-3 bg-red-600 rounded-lg text-white hover:bg-red-700">ยกเลิกการจอง</button>
                    <button type="button" id="close-model" class="btn">ปิด</button>
                </div>
            </form>

        </div>
    </div>
</dialog>
<div class=" overflow-auto w-full h-screen max-h-screen bg-slate-50">
    <?php include_once "src/navbar.php"; ?>
    <div class="container mx-auto mt-3 pb-3 flex flex-col gap-5">
        <p class=" text-5xl font-bold text-center"><i class="fa-solid fa-store"></i> ข้อมูลการจอง</p>
        <?php for ($i = 0; $i < count($zoneData); $i++) { ?>
            <div class=" animate-fadeIn flex gap-2 rounded-xl shadow-xl h-auto p-4 bg-slate-50 border-2 border-slate-400 w-full">
                <div class=" <?php echo $gradient_b[array_search($zoneData[$i], $char)] ?> zone-name w-4/12 h-auto rounded-lg flex justify-center items-center">
                    <h1 class=" text-white py-5 px-10 text-[50px] font-bold"><?php echo $areaUser[$i]['area_name'] ?></h1>
                </div>
                <div class="item_area p-2 w-full h-80 overflow-auto">
                    <div class="relative grid grid-cols-1 sm:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        <?php foreach ($areaUser as $key => $value) { ?>
                            <?php if ($zoneData[$i] == $value['area_name']) { ?>
                                <?php
                                $area_item = $area->getAreaitemById($value['area_id']);
                                $dix = 0;
                                foreach ($area_item as $keyx => $valuex) {
                                    if ($valuex['item_id'] == $value['item_id']) {
                                        $dix = $keyx;
                                        break;
                                    }
                                }
                                ?>
                                <div id="item" data-item="<?php echo $valuex['item_id'] ?>" data-areaid="<?php echo $valuex['area_id'] ?>" class=" relative cursor-pointer animate-zoom-animation card h-36 bg-white duration-200 hover:scale-110 justify-center items-center p-3 shadow-lg">
                                    <?php if ($valuex['item_active'] == 1) { ?>
                                        <div class="absolute top-0 left-0">
                                            <p class=" text-yellow-600 text-xs"><i class="fa-regular fa-circle-check"></i> รออนุมัติ</p>
                                        </div>
                                    <?php } else if ($valuex['item_active'] == 2) { ?>
                                        <div class="absolute top-0 left-0">
                                            <p class=" text-green-600 text-xs"><i class="fa-solid fa-circle-check"></i> อนุมัติแล้ว</p>
                                        </div>
                                    <?php } ?>
                                    <div class=" rounded-tr-lg flex justify-center items-center text-white top-0 right-0 absolute w-5 h-5 <?php echo $gradient_b[array_search($zoneData[$i], $char)] ?>">
                                        <p><?php echo $dix + 1 ?></p>
                                    </div>
                                    <p class="text-md font-bold"><i class="fa-solid fa-store"></i> <?php echo  $value['b_shop_name'] ?></p>
                                    <!-- <p>พื้นที่ <?php echo $dix + 1 ?></p> -->
                                    <p class="text-center text-md"><?php echo $value['item_width'] . " x " . $value['item_height'] . " ซม." ?></p>
                                    <p class=" text-xs text-sky-500 font-bold"><i class="fa-solid fa-circle-info"></i> ดูรายละเอียด</p>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<script>
    var item = document.querySelectorAll('#item');
    var modal = document.querySelector('#my_modal_1');
    var b_id = null
    var cancel_area = document.querySelector('#cancel-area');
    input_shopname = document.querySelector('input[name="shopname"]');
    input_firstname = document.querySelector('input[name="firstname"]');
    input_lastname = document.querySelector('input[name="lastname"]');
    input_email = document.querySelector('input[name="email"]');
    input_phone = document.querySelector('input[name="phone"]');
    var close = document.querySelector('#close-model');
    var div_item = null;
    close.addEventListener('click', () => {
        modal.classList.remove('modal-open');
    })

    cancel_area.addEventListener('click', async (e) => {
        e.preventDefault();
        console.log(b_id);

        try {
            var formData = new FormData();
            formData.append('status', 'cancelbook');
            formData.append('b_id', b_id);
            formData.append('user_id', <?php echo $_SESSION['user_id'] ?>);
            let res = await fetch('../rest/rest.php', {
                method: 'POST',
                body: formData
            })
            if (res.ok) {
                let data = await res.json();
                if (data.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'ยกเลิกการจองสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    modal.classList.remove('modal-open');
                    var item_area = div_item.closest('.item_area').querySelectorAll('#item');
                    var count_item = item_area.length - 1
                    var back_up = div_item

                    if (count_item == 0) {
                        back_up.closest('.item_area').closest('.animate-fadeIn').remove();
                        div_item.remove();
                    } else {
                        div_item.remove();
                    }
                }
            }
        } catch (err) {
            console.log(err);
        }
    })

    item.forEach((iteme, index) => {
        iteme.addEventListener('click', async () => {
            div_item = iteme;
            console.log(iteme.dataset.item);
            console.log(iteme.dataset.areaid);
            console.log(<?php echo $_SESSION['user_id'] ?>);
            try {
                var formData = new FormData();
                formData.append('status', 'getbookuser');
                formData.append('user_id', <?php echo $_SESSION['user_id'] ?>);
                formData.append('area_id', iteme.dataset.areaid);
                formData.append('item_id', iteme.dataset.item);
                let res = await fetch('../rest/rest.php', {
                    method: 'POST',
                    body: formData
                })
                if (res.ok) {
                    let data = await res.json();
                    console.log(data);
                    if (data.status == 'success') {
                        if(data.msg.item_active == 2){
                            cancel_area.style.display = 'none';
                        }else{
                            cancel_area.style.display = 'block';
                        }
                        modal.classList.add('modal-open');
                        input_shopname.setAttribute('readonly', true);
                        input_firstname.setAttribute('readonly', true);
                        input_lastname.setAttribute('readonly', true);
                        input_email.setAttribute('readonly', true);
                        input_phone.setAttribute('readonly', true);
                        input_shopname.value = data.msg.b_shop_name;
                        input_firstname.value = data.msg.b_firstname;
                        input_lastname.value = data.msg.b_lastname;
                        input_email.value = data.msg.b_email;
                        input_phone.value = data.msg.b_phone;
                        b_id = data.msg.b_id;
                        var item_priceItem = document.querySelector('.item-priceItem');
                        item_priceItem.innerHTML = `<i class="fa-solid fa-money-check-dollar text-green-600"></i> ${data.msg.item_price} บาท/เดือน`;
                    }
                }
            } catch (err) {
                console.log(err);
            }
        })
    })
</script>