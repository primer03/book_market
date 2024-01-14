<?php
if (!isset($_SESSION['user_emailverifly'])) {
    echo "<script>window.location.href='../index.php';</script>";
}
?>
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
                <div id="veriflyContainer" class=" flex flex-col gap-3 w-96 p-3 border-2 rounded-lg border-violet-600 shadow-lg">
                    <p class=" text-3xl font-bold text-center"></p>
                    <p class=" text-center">กรุณากรอกรหัสที่คุณได้รับ</p>
                    <form id="verifly" class="flex gap-3">
                        <input type="number" name="verifly" placeholder="Code" class=" input w-full input-bordered input-primary" required />
                        <button type="submit" id="btnverifly" class="p-3 rounded-md duration-150 bg-violet-500 text-white hover:bg-violet-700">ยืนยัน</button>
                    </form>
                    <div id="NewPassword"></div>
                    <!-- <form id="newpassword" class=" flex flex-col gap-3" >
                        <input type="password" name="newpassword" placeholder="New Password" class=" input w-full input-bordered input-primary" />
                        <input type="password" name="newpassword2" placeholder="Confirm Password" class=" input w-full input-bordered input-primary" />
                        <button type="submit" class="p-3 rounded-md duration-150 bg-violet-500 text-white hover:bg-violet-700">ยืนยัน</button>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var formverifly = document.querySelector('#verifly');
    var veriflyContainer = document.querySelector('#veriflyContainer');
    formverifly.addEventListener('submit', async (e) => {
        e.preventDefault();
        var verifly = document.querySelector('input[name="verifly"]');
        var btn = document.querySelector('#btnverifly');
        var va = verifly.value;
        console.log(verifly.value);
        var data = new FormData();
        data.append('verifly', verifly.value);
        data.append('status', 'verifly');
        data.append('user_email', '<?php echo $_SESSION['user_emailverifly']; ?>');
        try {
            var req = await fetch('../rest/rest.php', {
                method: 'POST',
                body: data
            });
            var res = await req.json();
            console.log(res);
            if (res.status == 'success') {
                verifly.disabled = true;
                verifly.value = va
                btn.disabled = true;
                var NewPassword = document.querySelector('#NewPassword');
                NewPassword.innerHTML += `<form id="newpassword" class=" flex flex-col gap-3" >
                        <input type="password" name="newpassword" placeholder="New Password" class=" input w-full input-bordered input-primary" />
                        <input type="password" name="newpassword2" placeholder="Confirm Password" class=" input w-full input-bordered input-primary" />
                        <button type="submit" class="p-3 rounded-md duration-150 bg-violet-500 text-white hover:bg-violet-700">ยืนยัน</button>
                    </form>`

                var formnewpassword = document.querySelector('#newpassword');
                formnewpassword.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    var newpassword = document.querySelector('input[name="newpassword"]').value;
                    var newpassword2 = document.querySelector('input[name="newpassword2"]').value;
                    var reguregex = /^[A-Z][a-zA-Z0-9]{7,}$/
                    if (newpassword == newpassword2) {
                        if (reguregex.test(newpassword)) {
                            var data = new FormData();
                            data.append('newpassword', newpassword);
                            data.append('status', 'newpassword');
                            data.append('user_email', '<?php echo $_SESSION['user_emailverifly']; ?>');
                            try {
                                var req = await fetch('../rest/rest.php', {
                                    method: 'POST',
                                    body: data
                                });
                                var res = await req.json();
                                console.log(res);
                                if (res.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'เปลี่ยนรหัสผ่านสำเร็จ',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            window.location.href = '../index.php';
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'เปลี่ยนรหัสผ่านไม่สำเร็จ',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            } catch (err) {
                                console.log(err);
                            }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'รหัสผ่านต้องขึ้นต้นด้วยตัวใหญ่และมีความยาวอย่างน้อย 8 ตัวอักษร',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'รหัสผ่านไม่ตรงกัน',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            } else {
                inputverifly.classList.remove('input-primary');
                inputverifly.classList.add('input-error');
            }
        } catch (err) {
            console.log(err);
        }
    })
</script>

</html>