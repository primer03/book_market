<?php
$gradient = [
    "bg-gradient-to-r from-purple-700 to-cyan-400",
    "bg-gradient-to-r from-blue-700 to-green-400",
    "bg-gradient-to-r from-indigo-700 to-yellow-400",
    "bg-gradient-to-r from-pink-700 to-amber-400",
    "bg-gradient-to-r from-red-700 to-teal-400",
    "bg-gradient-to-r from-orange-700 to-blue-400",
    "bg-gradient-to-r from-yellow-700 to-indigo-400",
    "bg-gradient-to-r from-green-700 to-purple-400",
    "bg-gradient-to-r from-teal-700 to-red-400",
    "bg-gradient-to-r from-blue-700 to-orange-400",
    "bg-gradient-to-r from-cyan-700 to-purple-400",
    "bg-gradient-to-r from-rose-700 to-amber-400",
    "bg-gradient-to-r from-lime-700 to-violet-400",
    "bg-gradient-to-r from-fuchsia-700 to-yellow-400",
    "bg-gradient-to-r from-emerald-700 to-red-400",
    "bg-gradient-to-r from-indigo-700 to-rose-400",
    "bg-gradient-to-r from-cyan-700 to-fuchsia-400",
    "bg-gradient-to-r from-purple-700 to-lime-400",
    "bg-gradient-to-r from-amber-700 to-emerald-400",
    "bg-gradient-to-r from-teal-700 to-blue-400",
    "bg-gradient-to-r from-red-700 to-yellow-400",
    "bg-gradient-to-r from-green-700 to-indigo-400",
    "bg-gradient-to-r from-orange-700 to-pink-400",
    "bg-gradient-to-r from-yellow-700 to-rose-400",
    "bg-gradient-to-r from-blue-700 to-lime-400",
    "bg-gradient-to-r from-purple-700 to-indigo-400",
    "bg-gradient-to-r from-pink-700 to-amber-400",
    "bg-gradient-to-r from-teal-700 to-red-400",
    "bg-gradient-to-r from-orange-700 to-cyan-400",
    "bg-gradient-to-r from-green-700 to-yellow-400",
    "bg-gradient-to-r from-indigo-700 to-fuchsia-400",
    "bg-gradient-to-r from-lime-700 to-rose-400",
    "bg-gradient-to-r from-blue-700 to-amber-400",
    "bg-gradient-to-r from-yellow-700 to-red-400",
    "bg-gradient-to-r from-cyan-700 to-indigo-400",
    "bg-gradient-to-r from-purple-700 to-blue-400",
    "bg-gradient-to-r from-red-700 to-green-400",
    "bg-gradient-to-r from-orange-700 to-teal-400",
    "bg-gradient-to-r from-fuchsia-700 to-yellow-400",
    "bg-gradient-to-r from-emerald-700 to-indigo-400",
];
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
$area = 20;
$book = 12;
$dix = [];
$percent = ($book / $area) * 100;
include_once "../Model/AreaModel.php";
$area = new AreaModel();
$areacout = count($area->getArea());
$areaData = $area->getArea();
?>
<style>
    /* Custom scrollbar styles */
    .w-full.overflow-auto::-webkit-scrollbar {
        width: 10px;
        /* Width of the scrollbar */
    }

    .w-full.overflow-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Color of the tracking area */
        border-radius: 10px;
    }

    .w-full.overflow-auto::-webkit-scrollbar-thumb {
        background: #888;
        /* Color of the thumb itself */
        border-radius: 10px;
    }

    .w-full.overflow-auto::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Color when hovered */
    }

    /* Styles for the scrollable container */
    .overflow-x-auto {
        scrollbar-width: thin;
        /* For Firefox */
        scrollbar-color: #e2e2e2 #f1f1f1;
        /* For Firefox */
        -webkit-overflow-scrolling: touch;
        /* Momentum scrolling for iOS and Safari */
    }

    .overflow-x-auto::-webkit-scrollbar {
        height: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #e2e2e2;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Enhancements for the individual items */
    .zone {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .zone:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Overlay enhancements */
    .zone .absolute {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .zone img {
        transition: border-color 0.3s ease;
    }

    .zone:hover img {
        border-color: #fff;
    }
</style>
<div class=" flex p-3 w-full gap-3">
    <div class="flex justify-center items-center">
        <div class="w-5 h-5 rounded-full border-2 border-yellow-400"></div>
        <p class="ml-2">รออนุมัติ</p>
    </div>
    <div class="flex justify-center items-center">
        <div class="w-5 h-5 rounded-full border-2 border-green-400"></div>
        <p class="ml-2">อนุมัติแล้ว</p>
    </div>
</div>
<div class=" w-full gap-3 rounded-md">
    <div class="flex flex-col sm:flex-col md:flex-col lg:flex-row gap-3">
        <div class=" overflow-auto shadow-md w-full lg:w-3/5 xl:w-3/5 2xl:w-4/5 h-[44rem] sm:h-[43rem] md:h-[43rem]  lg:h-[44rem] rounded-md bg-white flex flex-col gap-1 p-2">
            <?php for ($i = 0; $i < $areacout; $i++) { ?>
                <div class="flex zone-area w-full gap-2">
                    <div class="header-zone rounded-md w-14 h-16 <?php echo $gradient_b[$i] ?> flex justify-center items-center">
                        <p class=" m-0  text-2xl text-white font-bold"><?php echo $areaData[$i]['area_name'] ?></p>
                    </div>
                    <div class="w-[1px] h-16 bg-stone-600"></div>
                    <div class=" w-full h-auto overflow-x-auto">
                        <div id="item-sale" class="flex w-[70rem] md:w-[86rem] lg:w-[70rem] xl:w-[90rem] 2xl:w-[90rem] overflow-auto gap-1">
                            <?php
                            $item = $area->getAreaitem($areaData[$i]['area_id']);
                            $randx = count($item);
                            ?>
                            <?php for ($x = 0; $x < count($item); $x++) { ?>
                                <?php
                                $bookitem = $area->itemActive($item[$x]['item_id']);
                                ?>
                                <div class="zone animate-zoom-animation overflow-hidden relative h-16 w-14 sm:w-12 md:w-16 lg:w-24 rounded-md text-black flex justify-center items-center bg-white border border-slate-300">
                                    <?php if ($item[$x]['item_active'] > 0) { ?>
                                        <div class=" absolute w-full h-full top-0 right-0 bg-black bg-opacity-90 flex justify-center items-center rounded-md">
                                            <?php if ($bookitem[0]['item_active'] == 1) { ?>
                                                <img class=" object-cover border-2 border-yellow-400 rounded-full w-10 h-10" src="<?php echo "data:image/jpeg;base64," . base64_encode($bookitem[0]['user_image_data'])  ?>" alt="">
                                            <?php } else if ($bookitem[0]['item_active'] == 2) { ?>
                                                <img class=" object-cover  border-2 border-green-500 rounded-full w-10 h-10" src="<?php echo "data:image/jpeg;base64," . base64_encode($bookitem[0]['user_image_data'])  ?>" alt="">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <p class=" m-0 text-2xl font-bold"><?php echo $x + 1 ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="w-full shadow-md lg:w-2/5 xl:w-2/5 2xl:w-1/5 h-[36rem] sm:h-[42rem] md:h-[43rem] lg:h-[44rem] overflow-auto bg-white p-3 rounded-md">
            <div class="grid grid-cols-1 gap-3">
                <?php foreach ($areaData as $i => $value) { ?>
                    <?php
                    $usedata = $area->count_area($value['area_id']);
                    // print_r($usedata);
                    $percent = 0;
                    $notuse = 0;
                    $use = 0;
                    if ($usedata['check']==true) {
                        $use = $usedata['use'];
                        $notuse = $usedata['notuse'];
                        $percent = ($use / $notuse) * 100;
                    }else{
                        $use = 0;
                        $notuse = 0;
                    }
                    ?>
                    <div class="card animate-fadeIn w-full bg-white px-3 py-7 shadow-lg duration-150 ease-linear hover:-translate-y-1">
                        <div class="flex justify-between gap-3">
                            <div class="content w-full">
                                <h1 class="text-xl font-bold mb-3">พื้นที่ <?php echo $notuse ?> ที่ จองแล้ว <?php echo $use ?></h1>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="<?php echo $gradient[$i] ?> h-2.5 rounded-full dark:bg-purple-500" style="width: <?php echo $percent ?>%"></div>
                                </div>
                            </div>
                            <div class="zone w-16 rounded-md text-white flex justify-center items-center <?php echo $gradient_b[$i] ?>">
                                <p class="text-2xl font-bold"><?php echo $value['area_name'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>