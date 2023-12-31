<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hilal Fast Food</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="../iziToast-master/dist/css/iziToast.css">
    <link rel="stylesheet" href="../iziToast-master/dist/css/iziToast.min.css">
</head>

<body>
    <?php include '../config/nav.php' ?>
    <div id="layoutSidenav">
        <?php include '../config/sidebar.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="">
                        <h6 class="mt-4">Manage All Users</h6>
                        <button class="btn btn-success createUser">Create User</button>
                    </div>
                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            List of Users
                        </div>
                        <div class="card-body">
                            <table class="usersTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>username</th>
                                        <th>Email</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Hilal Fast Food</div>

                    </div>
                </div>
            </footer>
        </div>
    </div>

    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error-handler-body">

                    </div>
                    <div class="form-group mb-2">
                        <label>Username *</label>
                        <input type="text" class="form-control username" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Email *</label>
                        <input type="email" class="form-control email" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Password *</label>
                        <input type="password" class="form-control password" required>
                    </div>
                    <!-- <div class="form-group mb-2">
                        <label>Profile (Optional)</label>
                        <input type="file" class="form-control profile_image" required>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save">Save</button>
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
        $(document).ready(function() {
            $(".createUser").click(() =>
                $("#usersModal").modal("show")
            )
            $(".close").click(() => {
                $("#usersModal").modal("hide")
            })


            $(document).on("click", "a.delete", function() {
                var id = $(this).attr("deleteID");

                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            deleteUser(id, (res) => {
                                swal(res.message, {
                                    icon: "success",
                                });
                                readUsers();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })
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
                checkUser($(".email").val(), $(".username").val(), (res) => {

                    if (res.status) {
                        if (res.data.length > 0) {
                            displayToast("User with this email or username already exist", "error", 3000)
                            return;
                        }

                        createUser({

                            "username": $(".username").val(),
                            "email": $(".email").val(),
                            "password": $(".password").val()

                        })
                    } else {
                        console.log("here is error");
                        displayToast(res.description, "error", 3000)
                    }

                })


            })

            // read users
            function readUsers() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/users/",
                    success: function(res) {
                        $(".usersTable tbody").html('');
                        var html = "<tr>";
                        res.data.forEach(value => {
                            html += `<td>${value.id}</td>`
                            html += `<td>${value.username}</td>`
                            html += `<td>${value.email}</td>`
                            html += `<td><a deleteID=${value.id} class='btn btn-danger delete'><i class="fa-solid fa-circle-minus"></i></a>`
                            html += "</tr>"
                        })

                        $(".usersTable tbody").html(html);
                        $('.usersTable').DataTable();

                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            readUsers()

            // delete
            function deleteUser(id, response) {
                $.ajax({
                    method: "DELETE",
                    url: "http://localhost:4200/users/" + id,
                    success: function(res) {
                        response(res)
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }

            // create user
            function createUser(data) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "http://localhost:4200/users/register",
                    success: function(res) {
                        if (res.status) {
                            readUsers()
                            displayToast("User Created Successfully", "success", 4000);
                        } else {
                            console.log("here is error2");
                            displayToast(res.description, "error", 4000);
                        }
                    },
                    error: function(res) {
                        console.log(res);
                        displayToast(res.responseText, "error", 4000);
                    }
                })

            }

            function checkUser(email, username, response) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "email": email,
                        "username": username
                    },
                    url: "http://localhost:4200/users/validateUser",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                        displayToast(res.responseText, 4000);
                    }
                })

            }

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
            // toast
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