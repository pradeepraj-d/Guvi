// $("#registrationForm").submit(function (event) {
//     event.preventDefault();
// var email = $("#email").val();
// var username = $("#username").val();
// var password = $("#password").val();
// var confirmPassword = $("#confirmPassword").val();
// if (password !== confirmPassword) {
//     alert("Password and Confirm Password do not match");
//     return;
// }
//     var formData = {
//         username: username,
//         email: email,
//         password: password,
//     };

//     $.ajax({
//         type: "POST",
//         url: "http://localhost/../php/register.php",
//         data: formData,
//         success: function (response) {
//             alert("Registration successful!");
//             window.location.href = "login.html";
//         },
//         error: function (error) {
//             console.log(error);
//         }
//     });
// });


$("#registerButton").click(function (ev) {
    ev.preventDefault();
    var email = $("#email").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();
    if (password !== confirmPassword) {
        alert("Password and Confirm Password do not match");
        return;
    }
    var formData = {
        username: username,
        email: email,
        password: password,
    };

    var url = "http://localhost/Guvi/php/register.php";

    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        dataType: 'json',
        success: function (response) {
            const res = response
            if (res.status == 'success') {
                alert(res.message);
                window.location.href = "login.html";
            }
            else {
               alert(res.message);    
            }
        },
        error: function (error) {
            console.log(error);
        }
    }

    )
});