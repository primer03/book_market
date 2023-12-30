<style>
    @font-face {
        font-family: 'Tonphai';
        src: url('fonts/TonphaiThin.ttf') format('truetype');
    }

    .font-kumo {
        font-family: 'Tonphai';
    }
</style>
<div class="h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex justify-center items-center">
    <div class="card w-[35rem] p-3 h-auto border-2 bg-white shadow-2xl overflow-auto border-[0.4rem] border-purple-800">
        <div class="flex flex-col w-full items-center gap-4 font-mono">
            <img class=" animate-bounceIn w-28 h-auto object-cover" src="https://i.imgur.com/gzvkzoJ.png" alt="">
            <p class=" animate-zoom-animation text-3xl font-bold font-mono">เข้าสู่ระบบ</p>
            <form method="post" class="flex flex-col w-full items-center gap-4">
                <input type="email" placeholder="Email" name="email" class="input input-bordered input-primary w-full" />
                <div class=" block relative w-full">
                    <span class=" cursor-pointer absolute top-3 right-2 text-xl"><i class="fa-solid fa-eye"></i></span>
                    <input type="password" placeholder="Password" class="input input-bordered input-primary w-full" />
                </div>
                <button type="submit" class="btn  bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500  w-full text-xl text-white">เข้าสู่ระบบ</button>
            </form>
            <div class="flex w-full gap-3 items-center">
                <div class="w-full h-[1px] bg-zinc-400"></div>
                <p class="text-slate-400 font-bold">OR</p>
                <div class="w-full h-[1px] bg-zinc-400"></div>
            </div>
            <p>ถ้ายังไม่ได้สมัคร? <a class=" font-kumo font-bold text-lg  text-purple-800" href="index.php/register">สมัครสมาชิกตอนนี้</a></p>
            <small><a href="index.php/forgot">คุณลืมรหัสผ่านใช่หรือไม่?</a></small>
        </div>
    </div>
</div>
<script>
    var input_password = document.querySelector('input[type="password"]');
    var input_email = document.querySelector('input[type="email"]');
    var icon_eye = document.querySelector('.fa-eye');
    var timeout;
    var form = document.querySelector('form');
    icon_eye.addEventListener('mousedown', function() {
        input_password.type = 'text';
        icon_eye.classList.remove('fa-eye');
        icon_eye.classList.add('fa-eye-slash');
        timeout = setTimeout(function() {
            input_password.type = 'password';
            icon_eye.classList.remove('fa-eye-slash');
            icon_eye.classList.add('fa-eye');
        }, 1000);
    });
    icon_eye.addEventListener('mouseup', function() {
        clearTimeout(timeout);
        input_password.type = 'password';
        icon_eye.classList.remove('fa-eye-slash');
        icon_eye.classList.add('fa-eye');
    });
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        var email = input_email.value;
        var password = input_password.value;
        var data = new FormData();
        data.append('user_email', email);
        data.append('user_password', password);
        data.append('status', 'login');
        //console.log(data);
        try {
            let res = await fetch('rest/rest.php', {
                method: 'POST',
                body: data
            });
            if (res.ok) {
                let data = await res.text();
                data = JSON.parse(data);
                if (data.status == 'success') {
                    if (data.role == 'user') {
                        Swal.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบสำเร็จ',
                            text: 'กำลังพาไปหน้าหลัก',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบสำเร็จ',
                            text: 'กำลังพาไปหน้าจัดการระบบ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = 'admin/index.php';
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'เข้าสู่ระบบไม่สำเร็จ',
                        text: 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        } catch (err) {
            console.log(err);
        }
    })
</script>