<aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
    <div class="h-19.5">
        <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="">
            <img src="https://i.imgur.com/gzvkzoJ.png" class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">ระบบจัดการพื้นที่ขาย</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
    <?php
    // echo $page;
    $pageDat = ['แดชบอร์ด', 'จัดการข้อมูลพื้นที่', 'จัดการข้อมูลพื้นที่ร้านค้า', 'จัดการอนุมัติการจองร้านค้า', 'จัดการจองร้านค้า', 'ประวัติการชำระ', 'จัดการข้อมูลผู้ใช้','โปรไฟล์'];
    $bg_active = ['', '', '', '', ''];
    $bg_gd_active = ['', '', '', '', ''];
    $icon_active = ['', '', '', '', ''];
    foreach ($pageDat as $key => $value) {
        if ($value == $page) {
            $bg_active[$key] = 'shadow-soft-xl rounded-lg bg-white font-semibold text-slate-700';
            $bg_gd_active[$key] = 'bg-gradient-to-tl from-purple-700 to-pink-500';
            $icon_active[$key] = 'text-white';
        } else {
            $bg_active[$key] = '';
            $bg_gd_active[$key] = '';
            $icon_active[$key] = '';
        }
    }
    $dashboard = '';
    $logout = '';
    $areapage = '';
    $areaitempage = '';
    $approvemaket = '';
    $pageBookItem = '';
    $pagehistory = '';
    $pageDataUser = '';
    $pageprofile = '';
    if ($page == 'แดชบอร์ด') {
        $dashboard = 'index.php';
        $logout = '../rest/rest.php?logout=logout';
        $areapage = 'pages/areatable.php';
        $areaitempage = 'pages/areaitem.php';
        $approvemaket = 'pages/approvemaket.php';
        $pageBookItem = 'pages/bookitem.php';
        $pagehistory = 'pages/billhistory.php';
        $pageDataUser = 'pages/datauser.php';
        $pageprofile = 'pages/profile.php';
    } elseif ($page == 'จัดการข้อมูลพื้นที่') {
        $dashboard = '../index.php';
        $logout = '../../rest/rest.php?logout=logout';
        $areapage = '../pages/areatable.php';
        $areaitempage = '../pages/areaitem.php';
        $approvemaket = '../pages/approvemaket.php';
        $pageBookItem = '../pages/bookitem.php';
        $pagehistory = '../pages/billhistory.php';
        $pageDataUser = '../pages/datauser.php';
        $pageprofile = '../pages/profile.php';
    } elseif ($page == 'จัดการข้อมูลพื้นที่ร้านค้า') {
        $dashboard = '../index.php';
        $logout = '../../rest/rest.php?logout=logout';
        $areapage = '../pages/areatable.php';
        $areaitempage = '../pages/areaitem.php';
        $approvemaket = '../pages/approvemaket.php';
        $pageBookItem = '../pages/bookitem.php';
        $pagehistory = '../pages/billhistory.php';
        $pageDataUser = '../pages/datauser.php';
        $pageprofile = '../pages/profile.php';
    } elseif ($page == 'จัดการอนุมัติการจองร้านค้า') {
        $dashboard = '../index.php';
        $logout = '../../rest/rest.php?logout=logout';
        $areapage = '../pages/areatable.php';
        $areaitempage = '../pages/areaitem.php';
        $approvemaket = '../pages/approvemaket.php';
        $pageBookItem = '../pages/bookitem.php';
        $pagehistory = '../pages/billhistory.php';
        $pageDataUser = '../pages/datauser.php';
        $pageprofile = '../pages/profile.php';
    } elseif ($page == 'จัดการจองร้านค้า') {
        $dashboard = '../index.php';
        $logout = '../../rest/rest.php?logout=logout';
        $areapage = '../pages/areatable.php';
        $areaitempage = '../pages/areaitem.php';
        $approvemaket = '../pages/approvemaket.php';
        $pageBookItem = '../pages/bookitem.php';
        $pagehistory = '../pages/billhistory.php';
        $pageDataUser = '../pages/datauser.php';
        $pageprofile = '../pages/profile.php';
    } elseif ($page == 'ประวัติการชำระ') {
        $dashboard = '../index.php';
        $logout = '../../rest/rest.php?logout=logout';
        $areapage = '../pages/areatable.php';
        $areaitempage = '../pages/areaitem.php';
        $approvemaket = '../pages/approvemaket.php';
        $pageBookItem = '../pages/bookitem.php';
        $pagehistory = '../pages/billhistory.php';
        $pageDataUser = '../pages/datauser.php';
        $pageprofile = '../pages/profile.php';
    } elseif ($page == 'จัดการข้อมูลผู้ใช้') {
        $dashboard = '../index.php';
        $logout = '../../rest/rest.php?logout=logout';
        $areapage = '../pages/areatable.php';
        $areaitempage = '../pages/areaitem.php';
        $approvemaket = '../pages/approvemaket.php';
        $pageBookItem = '../pages/bookitem.php';
        $pagehistory = '../pages/billhistory.php';
        $pageDataUser = '../pages/datauser.php';
        $pageprofile = '../pages/profile.php';
    }elseif ($page == 'โปรไฟล์') {
        $dashboard = '../index.php';
        $logout = '../../rest/rest.php?logout=logout';
        $areapage = '../pages/areatable.php';
        $areaitempage = '../pages/areaitem.php';
        $approvemaket = '../pages/approvemaket.php';
        $pageBookItem = '../pages/bookitem.php';
        $pagehistory = '../pages/billhistory.php';
        $pageDataUser = '../pages/datauser.php';
        $pageprofile = '../pages/profile.php';
    }
    // print_r($bg_active);
    ?>
    <div class="items-center block w-auto max-h-screen overflow-auto grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a class="py-2.7 <?php echo $bg_active[0] ?>  text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap  px-4  transition-colors" href="<?php echo $dashboard ?>">
                    <div class="<?php echo $bg_gd_active[0] ?> shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class='bx bxs-dashboard <?php echo $icon_active[0] ?>'></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 <?php echo $bg_active[1] ?> text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="<?php echo $areapage ?>">
                    <div class="shadow-soft-2xl <?php echo $bg_gd_active[1] ?> mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class='bx bxs-area <?php echo $icon_active[1] ?>'></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">จัดการโซนขาย</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7  <?php echo $bg_active[2] ?> text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="<?php echo $areaitempage ?>">
                    <div class="shadow-soft-2xl <?php echo $bg_gd_active[2] ?> mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class='bx bxs-store <?php echo $icon_active[2] ?>'></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">จัดการข้อมูลพื้นที่ร้านค้า</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7  <?php echo $bg_active[3] ?> text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="<?php echo $approvemaket ?>">
                    <div class="shadow-soft-2xl <?php echo $bg_gd_active[3] ?> mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class='bx bx-badge-check <?php echo $icon_active[3] ?>'></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">อนุมัติการจองร้านค้า</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7  <?php echo $bg_active[4] ?> text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="<?php echo $pageBookItem ?>">
                    <div class="shadow-soft-2xl <?php echo $bg_gd_active[4] ?> mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class='bx bx-store <?php echo $icon_active[4] ?>'></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">จัดการจองร้านค้า</span>
                </a>
            </li>
            <li class="mt-0.5 w-full">
                <a class="py-2.7  <?php echo $bg_active[5] ?> text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="<?php echo $pagehistory ?>">
                    <div class="shadow-soft-2xl <?php echo $bg_gd_active[5] ?> mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class='bx bx-receipt <?php echo $icon_active[5] ?>'></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">ประวัติการชำระ</span>
                </a>
            </li>
            <li class="mt-0.5 w-full">
                <a class="py-2.7  <?php echo $bg_active[6] ?> text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="<?php echo $pageDataUser ?>">
                    <div class="shadow-soft-2xl <?php echo $bg_gd_active[6] ?> mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class="fa-solid fa-user-pen <?php echo $icon_active[6] ?> text-xs"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">จัดการข้อมูลผู้ใช้</span>
                </a>
            </li>

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Account pages</h6>
            </li>
            <li class="mt-0.5 w-full">
                <a class="py-2.7  <?php echo $bg_active[7] ?> text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="<?php echo $pageprofile ?>">
                    <div class="shadow-soft-2xl <?php echo $bg_gd_active[7] ?> mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class='fa-regular fa-address-card <?php echo $icon_active[7] ?>'></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">โปร์ไฟล์</span>
                </a>
            </li>
            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="<?php echo $logout ?>">
                    <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>spaceship</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(4.000000, 301.000000)">
                                            <path class="fill-slate-800" d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                                            <path class="fill-slate-800 opacity-60" d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                                            <path class="fill-slate-800 opacity-60" d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"></path>
                                            <path class="fill-slate-800 opacity-60" d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>