<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="../iziToast-master/dist/css/iziToast.css">
    <link rel="stylesheet" href="../iziToast-master/dist/css/iziToast.min.css">

</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <label for="select_profile"><img class="rounded-circle mt-5 profile_pic" width="150px" src="../images/avatar.png"></label>
                    <span class="font-weight-bold user">...</span>
                    <span class="text-black-50 user-email">....</span><span> </span>
                    <input type="file" hidden class="new_profile" id="select_profile">
                </div>
            </div>
            <div class="col-md-9 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Username</label><input type="text" class="form-control username" placeholder="first name" value=""></div>
                        <div class="col-md-6"><label class="labels">Email</label><input type="text" class="form-control email" value="" placeholder="surname"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Password</label><input disabled type="password" class="form-control password" placeholder="enter phone number" value=""></div>
                        <div class="mt-1"><button class="btn btn-danger enable" type="button">Enable/Disable</button></div>

                    </div>

                    <div class="mt-4"><button class="btn btn-primary profile-button w-100 save" type="button">Save Profile</button></div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src='../iziToast-master/dist/js/iziToast.min.js'></script>
    <script src='../iziToast-master/dist/js/iziToast.js'></script>

    <script>
        $(document).ready(() => {
            function containsOnlyCharsAndDigits(username) {

                const charDigitRegex = /^[a-zA-Z0-9]+$/;

                return charDigitRegex.test(username);
            }

            function isValidEmail(email) {

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                return emailRegex.test(email);
            }

            function hasSpaces(username) {

                const spaceRegex = /\s/;

                return spaceRegex.test(username);
            }
            $(".save").click(() => {

                if ($('.username').val() == "" || $('.email').val() == "" || $('.password').val() == "") {
                    displayToast("All fields are required", "error", 3000);
                    return;
                }
                if (!containsOnlyCharsAndDigits($('.username').val())) {
                    displayToast("username must be only alphanumeric values", "error", 3000);
                    return;
                }
                if (!isValidEmail($('.email').val())) {
                    displayToast("Incorrect Email format", "error", 3000);
                    return;
                }
                $.ajax({
                    method: "POST",

                    data: {

                        "username": $(".username").val(),
                        "email": $(".email").val(),
                        "password": $(".password").val(),
                        "user_id": localStorage.getItem("user_id"),

                    },


                    url: "http://localhost:4200/users/profile_update",
                    success: (res) => {
                        console.log(res);
                        displayToast("Profile has been updated! ", "success", 4000)
                    },
                    error: (err) => {
                        console.log(err);
                    }


                })

            })

            $('.enable').click(() => {
                if ($('.password').attr("disabled")) {
                    $('.password').attr("disabled", false);
                } else {
                    $('.password').attr("disabled", true);
                }

            })

            const readProfile = () => {
                $.ajax({
                    method: "GET",
                    dataType: "JSON",
                    url: "http://localhost:4200/users/profile/" + localStorage.getItem("user_id"),
                    beforeSend: () => {
                        $(".username").attr("disabled", true)
                        $(".email").attr("disabled", true)

                    },
                    success: (data) => {

                        $(".username").val(data.data[0].username)
                        $(".user").text(data.data[0].username)

                        $(".email").val(data.data[0].email)
                        $(".user-email").text(data.data[0].email)
                        $(".password").val(data.data[0].password)
                        $(".username").attr("disabled", false)
                        $(".email").attr("disabled", false)
                    },
                    error: (err) => {
                        console.log(err)

                    }
                })
            }
            readProfile();

            function displayToast(message, type, timeout) {
                if (type == "error") {
                    iziToast.error({
                        title: 'Error Encountered! ',
                        message: message,
                        backgroundColor: "#D83A56",
                        titleColor: "white",
                        messageColor: "white",
                        position: "topRight",
                        timeout: timeout
                    });
                } else if (type == "success") {
                    iziToast.success({

                        message: message,
                        backgroundColor: "#54B435",
                        titleColor: "white",
                        messageColor: "white",
                        position: "topRight",
                        timeout: timeout
                    });
                } else if (type == "ask") {
                    iziToast.question({
                        timeout: timeout,
                        close: false,
                        overlay: true,
                        displayMode: 'once',
                        id: 'question',
                        zindex: 999,
                        title: "Condirm!",
                        message: message,
                        position: 'topRight',
                        titleColor: "#86E5FF",
                        messageColor: "white",
                        backgroundColor: "#0081C9",
                        iconColor: "white",
                        buttons: [
                            ['<button style="background: #DC3535; color: white;"><b>YES</b></button>', function(instance, toast) {
                                alert("Ok Deleted...");
                                instance.hide({
                                    transitionOut: 'fadeOut'
                                }, toast, 'button');

                            }, true],
                            ['<button style="background: #ECECEC; color: #2b2b2b;">NO</button>', function(instance, toast) {
                                alert("Retuned");
                                instance.hide({
                                    transitionOut: 'fadeOut'
                                }, toast, 'button');

                            }],
                        ],
                        onClosing: function(instance, toast, closedBy) {
                            //  console.info('Closing | closedBy: ' + closedBy);
                        },
                        onClosed: function(instance, toast, closedBy) {
                            // console.info('Closed | closedBy: ' + closedBy);
                        }
                    });
                }
            }
        })
    </script>
</body>

</html>