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
                        <h6 class="mt-4">View and Manage All Customers</h6>

                    </div>
                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            List of Users
                        </div>
                        <div class="card-body">
                            <table class="customersTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FullName</th>
                                        <th>Mobile</th>
                                        <th>Email</th>

                                        <th>Address</th>
                                        <th>Status</th>
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
                var id = $(this).attr("delID");

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
                                swal("Customer data has been removed!", {
                                    icon: "success",
                                });
                                readCustomers();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })
            $(document).on("click", "a.block", function() {
                var id = $(this).attr("statusID");


                swal({
                        title: "Activation ?",
                        text: "Do You want to activate this account?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            activate(id, "active", (res) => {
                                swal("Customer status has been updated!", {
                                    icon: "success",
                                });
                                readCustomers();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })
            $(document).on("click", "a.active", function() {
                var id = $(this).attr("statusID");


                swal({
                        title: "Blocked ?",
                        text: "Do You want to block this account?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            activate(id, "block", (res) => {
                                swal("Customer status has been updated!", {
                                    icon: "success",
                                });
                                readCustomers();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })


            // read users
            function readCustomers() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/customers/",
                    success: function(res) {
                        $(".usersTable tbody").html('');
                        var html = "<tr>";
                        res.data.forEach(value => {
                            html += `<td>${value.cust_id}</td>`
                            html += `<td>${value.fullName}</td>`
                            html += `<td>${value.mobile}</td>`
                            html += `<td>${value.email}</td>`

                            html += `<td>${value.address}</td>`
                            if (value.account_status.toLowerCase() == "block")
                                html += `<td><a statusID=${value.cust_id} class='btn btn-danger block'>Blocked</a>`
                            else
                                html += `<td><a statusID=${value.cust_id} class='btn btn-success active'>Active</a>`


                            html += `<td><a delID=${value.cust_id} class='btn btn-danger delete'><i class="fa-solid fa-circle-minus"></i></a>`
                            html += "</tr>"
                        })

                        $(".customersTable tbody").html(html);
                        $('.customersTable').DataTable();

                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            readCustomers()

            // delete
            function deleteUser(id, response) {
                $.ajax({
                    method: "DELETE",
                    url: "http://localhost:4200/customers/deleteCustomer/" + id,
                    success: function(res) {
                        if (!res.status) {
                            displayToast("Something Went Wrong, During Deletion", "error", 3000);
                            return;
                        }
                        response(res)
                    },
                    error: function(res) {
                        console.log(res);
                        displayToast(res.responseText, 'error', 5000);
                    }
                })

            }

            function activate(id, status, response) {
                var data = new FormData();
                data.append("status", status);
                data.append("id", id);

                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "status": status,
                        "id": id
                    },
                    url: "http://localhost:4200/customers/activate",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }


            // create user
            function createUser(data, hasFile = false) {
                if (!hasFile) {

                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: data,
                        url: "http://localhost:4200/users/register",
                        success: function(res) {
                            const {
                                status,
                                message
                            } = res;
                            if (status) {
                                $('.error-handler-body').html(`
                              <div class="alert alert-success">
                            <strong>${message} 🔥</strong>
                        </div>
                                `);

                                setTimeout(() => {
                                    $('.error-handler-body').html('');
                                }, 2000)
                                readUsers();
                            } else {
                                $('.error-handler-body').html(` <
                                                                        div class = "alert alert-danger" >
                                                                        <
                                                                        strong > $ {
                                                                            message
                                                                        }🔥 < /strong> <
                                                                        /div>
                                                                        `)
                                setTimeout(() => {
                                    $('.error-handler-body').html('');
                                }, 2000)
                                readUsers();

                            }


                        },
                        error: function(res) {
                            console.log(res);
                        }
                    })
                } else {
                    $.ajax({
                        method: "POST",
                        dataType: "JSON",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: data,
                        url: "http://localhost:4200/users/register",
                        success: function(res) {

                            console.log(res);
                            readUsers();
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    })
                }
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