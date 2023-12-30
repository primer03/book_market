<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css">
    <title>Document</title>
</head>
<body>
    <div class=" overflow-auto w-full h-screen max-h-screen bg-slate-50">
        <div class=" container mx-auto">
            <div class=" h-screen flex justify-center items-center">
                <div class=" flex flex-col gap-3 w-96 p-3 border-2 rounded-lg border-violet-600 shadow-lg">
                    <p class=" text-3xl font-bold text-center">ลืมรหัสผ่าน</p>
                    <p class=" text-center">กรุณากรอกอีเมลของคุณเพื่อรับรหัสยืนยัน</p>
                    <form method="post" class=" flex flex-col gap-3">
                        <input type="email" name="email" placeholder="Email" class=" input input-bordered input-primary" />
                        <button type="submit" class="p-3 rounded-md duration-150 bg-violet-500 text-white hover:bg-violet-700">ยืนยัน</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var form = document.querySelector('form');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        var email = document.querySelector('input[name="email"]').value;
        var data = new FormData();
        data.append('user_email', email);
        try {
            var btn = document.querySelector('button[type="submit"]');
            btn.innerHTML = `<i class="animate-spin  fa-solid fa-spinner"></i> กำลังส่ง...`
            btn.disabled = true;
            var req = await fetch('../auth/sendEmail.php', {
                method: 'POST',
                body: data
            });
            var res = await req.json();
            console.log(res);
            if (res.status == 'success') {
                btn.innerHTML = `ยืนยัน`
                btn.disabled = false;
                let timerInterval;
                Swal.fire({
                    title: "ส่งอีเมลสำเร็จ",
                    html: "ระบบกำลังนำท่านไปยังหน้ายืนยันอีเมล <b></b> วินาที",
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../index.php/verifly';
                    }
                });
            } else {
                btn.innerHTML = `ยืนยัน`
                btn.disabled = false;
                Swal.fire({
                    icon: 'error',
                    title: 'ส่งอีเมลไม่สำเร็จ',
                    text: 'กรุณาตรวจสอบอีเมลของคุณ',
                })
            }
        } catch (error) {
            console.log(error);
        }
    });
</script>

</html>