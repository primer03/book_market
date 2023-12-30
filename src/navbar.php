<div class="navbar bg-sky-950 shadow-md shadow-sky-200 sticky top-0" style="z-index: 999">
    <div class="flex-1 gap-3">
        <div class=" w-10 rounded-full object-cover">
            <?php
            $urlxx = "index.php";
            $urlx = "rest/rest.php?logout=logout";
            $itemurl = "index.php/itembook";
            if (isset($_SERVER['REQUEST_URI'])) {
                $urls = $_SERVER['REQUEST_URI'];
                $urls = explode('/', $urls);
                $urls = array_filter($urls);
                $urls = array_merge($urls, array());

                if (isset($urls[2])) {
                    if ($urls[2] == 'area') {
                        $urlxx =  '../../index.php';
                        $urlx =  '../../rest/rest.php?logout=logout';
                        $itemurl =  '../../index.php/itembook';
                    } else if ($urls[2] == 'itembook') {
                        $urlxx =  '../index.php';
                        $urlx =  '../rest/rest.php?logout=logout';
                        $itemurl =  '../index.php/itembook';
                    } else {
                        $urlxx = 'index.php';
                        $urlx = 'rest/rest.php?logout=logout';
                        $itemurl = 'index.php/itembook';
                    }
                }
            }
            ?>
            <a href="<?php echo $urlxx ?>"><img src="https://i.imgur.com/gzvkzoJ.png" alt=""></a>
        </div>
        <span class=" text-xl font-bold text-white">มหาวิทยาลัยราชภัฏเลย</span>
    </div>
    <div class="flex-none gap-4">
        <div class=" hidden sm:hidden md:block ">
            <a class=" text-white font-bold" href="<?php echo $itemurl ?>"><i class="fa-solid fa-user"></i> ข้อมูลการจอง</a>
        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full border-2 border-white">
                    <?php
                    if (isset($_COOKIE['login'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($_SESSION['user_image_data']) . '" alt="">';
                    } else {
                        echo '<p class=" inline text-3xl text-white"><i class="fa-solid fa-user"></i></p>';
                    }
                    ?>
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="<?php echo $itemurl ?>"><i class="fa-solid fa-user"></i> ข้อมูลการจอง</a></li>

                <li><a href="<?php echo $urlx ?>"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a></li>
            </ul>
        </div>
    </div>
</div>