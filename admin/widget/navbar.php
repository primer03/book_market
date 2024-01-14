<!-- <?php echo $_SESSION['user_status'] ?> -->
<nav class="relative sticky bg-white top-0 z-50 flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
            <!-- breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                <li class="text-sm leading-normal">
                    <a class="opacity-50 text-slate-700" href="javascript:;">หน้า</a>
                </li>
                <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page"><?php echo $page ?></li>
            </ol>
            <h6 class="mb-0 font-bold capitalize"><?php echo $page ?></h6>
        </nav>

        <div class="flex items-center justify-end mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            <ul class="flex flex-row gap-3 justify-end pl-0 mb-0 list-none md-max:w-full">
                <li class="flex justify-center gap-2 items-center">
                    <?php
                    $usernamex = explode('@', $_SESSION['user_email']); 
                    ?>
                    <img id="imageLogo" class=" shadow-md border-2 border-violet-600 w-11 h-11 rounded-full object-cover" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['user_image_data']) ?>" alt="">
                    <!-- <p class=" font-bold text-xl"><?php echo $usernamex[0] ?></p> -->
                    <!-- <a href="./pages/sign-in.html" class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500">
                        <i class="fa fa-user sm:mr-1"></i>
                        <span class="hidden sm:inline">Sign In</span>
                    </a> -->
                </li>
                <li class="flex items-center pl-4 xl:hidden">
                    <a href="javascript:;" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500" sidenav-trigger>
                        <div class="w-4.5 overflow-hidden">
                            <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                        </div>
                    </a>
                </li>
                <!-- <li class="flex items-center px-4">
                    <a href="javascript:;" class="p-0 text-sm transition-all ease-nav-brand text-slate-500">
                        <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                    </a>
                </li> -->
                <!-- <li>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn m-1"><i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i></div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a>Item 1</a></li>
                            <li><a>Item 2</a></li>
                        </ul>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>
</nav>