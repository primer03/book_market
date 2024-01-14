<?php
include_once "../Model/AreaModel.php";
$area = new AreaModel();

$usercount = $area->count_user();
$zonecount = $area->count_area_all();
$areacount = $area->count_item_all();
$bookitemcount = $area->count_book_item();
$approvedbookitemcount = count($area->get_approved());
?>
<div class="flex flex-wrap -mx-3">
    <!-- card1 -->
    <div class=" animate-zoom-animation w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row justify-between -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">จำนวนสมาชิก</p>
                            <h5 class="mb-0 font-bold">
                                <?php echo $usercount ?>
                                <!-- <span class="text-sm leading-normal font-weight-bolder text-lime-500">+55%</span> -->
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right">
                        <div class=" flex justify-center items-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class='bx bxs-user-rectangle bx-sm text-white'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card2 -->
    <div class=" animate-zoom-animation w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex justify-between flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">จำนวน zone ทั้งหมด</p>
                            <h5 class="mb-0 font-bold">
                                <?php echo $zonecount ?>
                                <!-- <span class="text-sm leading-normal font-weight-bolder text-lime-500">+3%</span> -->
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right ">
                        <div class=" flex items-center justify-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class='bx bxs-area bx-sm text-white'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card3 -->
    <div class=" animate-zoom-animation w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row justify-between -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">จำนวนพื้นที่ขาย</p>
                            <h5 class="mb-0 font-bold">
                                <?php echo $areacount ?>
                                <!-- <span class="text-sm leading-normal text-red-600 font-weight-bolder">-2%</span> -->
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right">
                        <div class=" flex items-center justify-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class='bx bxs-cart bx-sm text-white'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card4 -->
    <div class=" animate-zoom-animation w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row justify-between -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">จำนวนการจองทั้งหมด</p>
                            <h5 class="mb-0 font-bold">
                                <?php echo $bookitemcount ?>
                                <!-- <span class="text-sm leading-normal font-weight-bolder text-lime-500">+5%</span> -->
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right">
                        <div class=" flex justify-center items-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class='bx bxs-bookmarks bx-sm text-white'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" animate-zoom-animation w-full max-w-full px-3 py-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row justify-between -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">จำนวนการจองที่ยังไม่ได้อนุมัติ</p>
                            <h5 class="mb-0 font-bold">
                                <?php echo $approvedbookitemcount ?>
                                <!-- <span class="text-sm leading-normal font-weight-bolder text-lime-500">+5%</span> -->
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right">
                        <div class=" flex justify-center items-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <!-- <i class='bx bxs-bookmarks bx-sm text-white'></i> -->
                            <i class='bx bx-check-square bx-sm text-white'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $thaimonth = array(
        "01" => "มกราคม",
        "02" => "กุมภาพันธ์",
        "03" => "มีนาคม",
        "04" => "เมษายน",
        "05" => "พฤษภาคม",
        "06" => "มิถุนายน",
        "07" => "กรกฎาคม",
        "08" => "สิงหาคม",
        "09" => "กันยายน",
        "10" => "ตุลาคม",
        "11" => "พฤศจิกายน",
        "12" => "ธันวาคม"
    );
    $date = date("Y-m-d");
    $month = date("m");
    $year = date("Y");
    $day = date("d");
    $countReceipt = $area->get_count_month($month, $year);
    $monthThaiX = $thaimonth[$month];
    ?>
    <div class=" animate-zoom-animation w-full max-w-full px-3 py-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row justify-between -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">จำนวนการชำระประจำเดือน <?php echo $monthThaiX  ?></p>
                            <h5 class="mb-0 font-bold">
                                <?php echo $countReceipt."/".$bookitemcount ?>
                                <!-- <span class="text-sm leading-normal font-weight-bolder text-lime-500">+5%</span> -->
                            </h5>
                        </div>
                    </div>

                    <div class="px-3 text-right">
                        <div class=" flex justify-center items-center w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <!-- <i class='bx bxs-bookmarks bx-sm text-white'></i> -->
                            <i class='bx bxs-calendar bx-sm text-white'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>