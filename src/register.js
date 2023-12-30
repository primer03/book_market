var input_password = document.querySelectorAll('input[type="password"]');
var input_file = document.querySelector('input[type="file"]');
var input_email = document.querySelector('input[type="email"]');
var form = document.querySelector('form');
var icon_eye = document.querySelectorAll('.fa-eye');
var timeout;
var showimge = document.querySelector('#showimge');
icon_eye.forEach((e, index) => {
    e.addEventListener('mousedown', function() {
        if (input_password[index].type == 'password') {
            input_password[index].type = 'text';
            icon_eye[index].classList.remove('fa-eye');
            icon_eye[index].classList.add('fa-eye-slash');
            timeout = setTimeout(function() {
                input_password[index].type = 'password';
                icon_eye[index].classList.remove('fa-eye-slash');
                icon_eye[index].classList.add('fa-eye');
            }, 1000);
        }
    });
    e.addEventListener('mouseup', function() {
        clearTimeout(timeout);
        input_password[index].type = 'password';
        icon_eye[index].classList.remove('fa-eye-slash');
        icon_eye[index].classList.add('fa-eye');
    });
})
input_file.addEventListener('change', function() {
    var file = this.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            showimge.innerHTML = `<img class="w-full h-full object-cover rounded-full" src="${e.target.result}" alt="">`;
        }
        reader.readAsDataURL(file);
    }
});

form.addEventListener('submit', async function(e) {
    e.preventDefault();
    if (checkinput([input_file, input_email, ...input_password])) {
        const regpsw = /^[A-Z][a-zA-Z0-9]{7,}$/;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (emailRegex.test(input_email.value)) {
            if (regpsw.test(input_password[0].value)) {
                if (input_password[0].value == input_password[1].value) {
                    let formData = new FormData();
                    formData.append('user_email', input_email.value);
                    formData.append('user_password', input_password[0].value);
                    formData.append('images', input_file.files[0]);
                    formData.append('status', 'register')
                    formData.append('user_status', '0')
                    let response = await fetch('../rest/rest.php', {
                        method: 'POST',
                        body: formData
                    });
                    if (response.ok) {
                        let result = await response.json();
                        console.log(result);
                        if (result.status == 'success') {
                            showalert('success', 'สมัครสมาชิกสำเร็จ');
                            setTimeout(function() {
                                window.location.href = '../index.php';
                            }, 3000);
                        } else {
                            showalert('error', result.msg);
                        }
                    }
                    //showalert('success', 'สมัครสมาชิกสำเร็จ');
                } else {
                    showalert('error', 'รหัสผ่านไม่ตรงกัน');
                }
            } else {
                showalert('error', 'รหัสผ่านไม่ถูกต้อง');
            }
        } else {
            showalert('error', 'อีเมลไม่ถูกต้อง');
        }
    } else {
        showalert('error', 'กรุณากรอกข้อมูลให้ครบถ้วน');
    }
});

function checkinput(input) {
    var check = true;
    input.forEach(e => {
        if (e.value == "") {
            if (e.type != 'file') {
                e.classList.remove('input-primary');
                e.classList.add('input-error');
            }
            check = false;
        }
    });
    return check;
}

function showalert(icon, msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: icon,
        title: msg
    });
}