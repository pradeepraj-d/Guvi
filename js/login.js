$("#loginbutton").click(function (ev) {
    ev.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();

    var loginData = {
        email: email,
        password: password,
    };
    console.log(loginData);
    var url = "http://localhost/Guvi/php/login.php";
    $.ajax({
        type: "POST",
        url: url,
        data: loginData,
        dataType: 'json',
        success: function (response) {
            const res = response
            if (res.status == 'success') {
                console.log(res.email);
                localStorage.setItem("email", res.email);
                window.location.href = "profile.html";
            }
            else {
                alert(res.message);
            }
        },
    });

});
function togglePassword() {
    var passwordInput = document.getElementById('password');
    var eyeIcon = document.querySelector('.eye-icon i');
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}