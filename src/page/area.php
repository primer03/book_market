<link rel="stylesheet" href="../../dist/output.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
<?php
if (!isset($_COOKIE['login'])) {
    header("Location: ../../index.php");
}
include_once "Model/AreaModel.php";
$area = new AreaModel();
// echo $area_id;
$areaitem = $area->getAreaById($area_id);
// echo "<pre>";
// print_r($areaitem);
// echo "</pre>";
// $zone = $areaitem[0]['area_name'];
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
$idx = array_search($areaitem['area_name'], $char);
$areaData = $area->getArea();
?>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-3">Hello!</h3>
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
                    <small class="text-red-600">*ตัวอย่าง 092-XXXXXXX</small>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="submit" id="save-area" class="btn btn-success">SAVE</button>
                    <button type="button" id="close-model" class="btn">Close</button>
                </div>
            </form>

        </div>
    </div>
</dialog>
<div class=" overflow-auto w-full h-screen max-h-screen bg-slate-50">
    <?php include_once "src/navbar.php"; ?>
    <div class="container mx-auto mt-3 flex flex-col gap-3">

        <?php foreach ($areaData as $key => $value) { ?>
            <?php
            $idx = array_search($value['area_name'], $char);
            ?>
            <div class=" animate-fadeIn flex gap-2 rounded-xl shadow-xl h-auto p-3 bg-slate-50 border-2 border-slate-400 w-full">
                <div class="zone-name w-4/12 h-auto <?php echo $gradient_b[$idx] ?> rounded-lg flex justify-center items-center">
                    <h1 class=" text-white py-5 px-10 text-[50px] font-bold"><?php echo $value['area_name'] ?></h1>
                </div>
                <div class="item_area p-2 w-full h-80 overflow-auto">
                    <div class=" relative grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        <?php $item = $area->getAreaitem($value['area_id']); ?>
                        <?php for ($i = 0; $i < count($item); $i++) {  ?>
                            <div id="item" data-item="<?php echo $item[$i]['item_id'] ?>" data-areaid="<?php echo $value['area_id'] ?>" class=" relative cursor-pointer animate-zoom-animation card h-36 bg-white duration-200 hover:scale-110 justify-center items-center p-3 shadow-lg">
                                <?php
                                $xd = "";
                                $bookitem = $area->itemActive($item[$i]['item_id']);
                                if ($bookitem != null) {
                                    $xd = "disabled";
                                };
                                ?>
                                <?php if ($item[$i]['item_active'] == 1) { ?>
                                    <div class=" flex flex-col justify-center items-center absolute rounded-lg bg-opacity-70 w-full h-full bg-black">
                                        <img class=" h-16 w-16 object-cover rounded-full " src="<?php echo "data:image/jpeg;base64," . base64_encode($bookitem[0]['user_image_data'])  ?>" alt="">
                                        <p class=" text-white font-bold text-sm"><i class="fa-solid fa-store"></i> <?php echo $bookitem[0]['b_shop_name'] ?></p>
                                        <p class=" text-yellow-400 font-bold text-sm"><i class="fa-regular fa-square-check"></i> รออนุมัติ</p>
                                    </div>
                                <?php } else if ($item[$i]['item_active'] == 2) { ?>
                                    <div class=" flex flex-col justify-center items-center absolute rounded-lg bg-opacity-70 w-full h-full bg-black">
                                        <img class=" h-16 w-16 object-cover rounded-full " src="<?php echo "data:image/jpeg;base64," . base64_encode($bookitem[0]['user_image_data'])  ?>" alt="">
                                        <p class=" text-white font-bold text-sm"><i class="fa-solid fa-store"></i> <?php echo $bookitem[0]['b_shop_name'] ?></p>
                                        <p class=" text-green-600 font-bold text-sm"><i class="fa-regular fa-square-check"></i> อนุมัติแล้ว</p>
                                    </div>
                                <?php } ?>
                                <p class="text-xl font-bold"><?php echo $i + 1 ?></p>
                                <p class="text-center text-xs sm:text-xs md:text-md lg:text-md"><?php echo $item[$i]['item_width'] . " x " . $item[$i]['item_height'] . " ซม." ?></p>
                                <p class="text-center text-xs sm:text-xs md:text-md lg:text-md"><?php echo number_format($item[$i]['item_price'],0) . " บาท/เดือน" ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<script>
    var item = document.querySelectorAll("#item");
    var close_model = document.getElementById("close-model");
    var zone_name;
    var area_name;
    var form = document.querySelector("form");
    var item_id;
    var item_area_id;
    var item_click;
    var item_price = 0;
    window.onload = function() {
        item.forEach((e, index) => {
            e.addEventListener("click", async () => {
                item_click = e;
                var dara = new FormData();
                dara.append("status", "getareaitemBYid");
                dara.append("id", e.dataset.areaid);
                try {
                    let respons = await fetch("../../rest/rest.php", {
                        method: "POST",
                        body: dara
                    })
                    if (respons.ok) {
                        let data = await respons.json();
                        console.log(data);
                        data.filter((ex, index) => {
                            if (ex.item_id == e.dataset.item) {
                                zone_name = ex.area_name;
                                area_name = index + 1;
                                item_id = ex.item_id;
                                item_area_id = ex.item_area_id;
                                item_price = ex.item_price;
                            }
                        })
                        if (data[area_name - 1].item_active == 0) {
                            var my_modal_1 = document.getElementById("my_modal_1");
                            var h3_name = my_modal_1.querySelector(".modal-box h3");
                            h3_name.innerHTML = "พื้นที่ " + zone_name + " ที่ " + area_name + " ราคา " + item_price + " บาท ต่อเดือน";
                            my_modal_1.classList.add("modal-open");
                        }
                    }
                } catch (err) {
                    console.log(err);
                }
            })
        })
        close_model.addEventListener("click", () => {
            var my_modal_1 = document.getElementById("my_modal_1");
            my_modal_1.classList.remove("modal-open");
            form.reset();
            form.querySelectorAll(".input").forEach((e) => {
                e.classList.remove("input-error");
            })
        })
        form.onsubmit = async (e) => {
            e.preventDefault();
            var shopname = form.querySelector("input[name='shopname']")
            var firstname = form.querySelector("input[name='firstname']")
            var lastname = form.querySelector("input[name='lastname']")
            var email = form.querySelector("input[name='email']")
            var phone = form.querySelector("input[name='phone']")
            var datashop = new FormData();
            datashop.append("status", "addshop");
            datashop.append("shopname", shopname.value);
            datashop.append("firstname", firstname.value);
            datashop.append("lastname", lastname.value);
            datashop.append("email", email.value);
            datashop.append("phone", phone.value);
            // console.log();
            var thaiPhoneNumberRegex = /^0[0-9]{2}-[0-9]{7}$/;
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            var check = true;
            if (checkinputx([shopname, firstname, lastname, email, phone])) {
                if (thaiPhoneNumberRegex.test(phone.value)) {
                    phone.classList.remove("input-error");
                    check = true;
                } else {
                    check = false;
                    phone.classList.add("input-error");
                    return;
                }
                if (emailRegex.test(email.value)) {
                    check = true;
                    email.classList.remove("input-error");
                } else {
                    check = false;
                    email.classList.add("input-error");
                }
                if (check) {
                    var user_id = "<?php echo $_SESSION['user_id'] ?>"
                    var formData = new FormData();
                    formData.append("status", "addBookarea");
                    formData.append("b_item_id", item_id);
                    formData.append("b_user_id", user_id);
                    formData.append("b_shop_name", shopname.value);
                    formData.append("b_firstname", firstname.value);
                    formData.append("b_lastname", lastname.value);
                    formData.append("b_email", email.value);
                    formData.append("b_phone", phone.value);
                    let resx = await fetch("../../rest/rest.php", {
                        method: "POST",
                        body: formData
                    })
                    if (resx.ok) {

                        let data = await resx.json();
                        console.log(data);
                        var imagex = await getimage(item_id);
                        var shop_name = await get_shopname(item_id)
                        // console.log(profile);
                        if (data.msg == "success") {
                            form.reset();
                            console.log(item_click);
                            item_html = item_click.innerHTML;
                            console.log(item_html);
                            item_click.innerHTML = ''
                            item_click.innerHTML += `<div class="flex flex-col justify-center items-center absolute rounded-lg bg-opacity-70 w-full h-full bg-black">
                                        <img class=" h-16 w-16 object-cover rounded-full " src="data:image/jpeg;base64,${imagex.replace(/"/g, '')}" alt="">
                                        <p class=" text-white font-bold text-sm"><i class="fa-solid fa-store"></i> ${shop_name.msg}</p>
                                        <p class=" text-yellow-400 font-bold text-sm"><i class="fa-regular fa-square-check"></i> รออนุมัติ</p>
                                    </div>`
                            item_click.innerHTML += item_html
                            var my_modal_1 = document.getElementById("my_modal_1");
                            my_modal_1.classList.remove("modal-open");
                            Swal.fire({
                                title: "จองพื้นที่สำเร็จ!",
                                text: "ต้องการไปหน้าจัดการพื้นที่หรือไม่?",
                                icon: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                cancelButtonText: "ปิด",
                                confirmButtonText: "ตกลง"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "../../index.php/itembook";
                                }
                            });
                            // setTimeout(() => {
                            //     window.location.href = "../../index.php/itembook";
                            // }, 3000);
                            // alert("success");
                            // window.location.reload();
                        }
                    }
                }
            }

        }

        async function getimage(id) {
            try {
                var formData = new FormData();
                formData.append("status", "getimage");
                formData.append("item_id", id);
                let resx = await fetch("../../rest/rest.php", {
                    method: "POST",
                    body: formData
                })
                if (resx.ok) {
                    let data = await resx.text();
                    return data;
                }
            } catch (err) {
                console.log(err);
            }
        }

        async function get_shopname(id) {
            try {
                var formData = new FormData();
                formData.append("status", "get_item_user");
                formData.append("item_id", id);
                let resx = await fetch("../../rest/rest.php", {
                    method: "POST",
                    body: formData
                })
                if (resx.ok) {
                    let data = await resx.json();
                    return data;
                }
            } catch (err) {
                console.log(err);
            }
        }

        function checkinputx(datainput) {
            var check = true;
            datainput.forEach((e) => {
                if (e.value == "") {
                    e.classList.add("input-error");
                    check = false;
                } else {
                    e.classList.remove("input-error");
                }
            })
            return check;
        }
    }
</script>