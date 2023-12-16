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
                        <h6 class="mt-4">View and Manage All Incoming Orders</h6>

                    </div>
                    <div class="p-2">
                        <div class="row">
                            <div class="col-6">
                                <select name="" id="" class="form-select customers">
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <input type="date" class="date form-control">
                            </div>
                            <div class="col-6">
                                <button class="btn mt-3 btn-success approve">
                                    Approve Payment Amount $
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div> <i class="fas fa-table me-1"></i>
                                List of Orders</div>

                            <div> <button class="btn btn-success activateAll">Activate All</button>
                                <button class="btn btn-danger deactivateAll">Deactivate All</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="ordersTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Food</th>
                                        <th>Quantity</th>

                                        <th>TotalAmount</th>
                                        <!-- <th>OrderDate</th> -->
                                        <th>Status</th>
                                        <th>Action</th>

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

    <div class="modal fade bd-example-modal-lg view-order" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    View And Print
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary">
                        <strong>
                            <i class="fa-solid fa-circle-info mr-2"></i>
                            The entire order information will be displayed on this page.
                        </strong>
                    </div>

                    <hr>

                    <div class="print-area">

                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success print">
                        <i class="fa-solid fa-print mr-2"></i>
                        Print</button>
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
    <script src='./printThis.js'></script>

    <script>
        $(document).ready(function() {
            $('.print').click(() => $('.print-area').printThis({
                // importCss: true,
                importCSS: true,
                importStyle: true,
                loadCSS: "http://localhost/NodeProject/Online%20Food%20AdminPanel/css/styles.css"
            }))



            $(".createUser").click(() =>
                $("#usersModal").modal("show")
            )
            $(".close").click(() => {
                $("#usersModal").modal("hide")
            })


            $(document).on("click", "a.delete", function() {
                var id = $(this).attr("delID");
                alert(id)

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
                                swal("Order data has been removed!", {
                                    icon: "success",
                                });
                                readOrders();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })
            $(document).on("click", "a.view", function() {
                var id = $(this).attr("viewID");

                readOderData(id, res => {
                    $('.print-area').html(`
                    
                    <h5 class='text-center fw-bold'>HILAAL <span>FAST FOOD</span></h5>
                        <h6 class='text-center'>615178163 | 6100990090</h6>

                        <div class="customer-details-area my-5">
                            <h6>Customer Details</h6>
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                </tr>
                                <tr>
                                    <td>${res.data[0].cust_id}</td>
                                    <td>${res.data[0].fullName}</td>
                                    <td>${res.data[0].email}</td>
                                    <td>${res.data[0].mobile}</td>
                                    <td>${res.data[0].address}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="order-details-area my-5">
                            <h6>Order Details</h6>
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Food</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                </tr>
                                <tr>
                                    <td>${res.data[0].order_id}</td>
                                    <td>${res.data[0].food_name}</td>
                                    <td>${res.data[0].quantity}</td>
                                    <td>$${res.data[0].total_amount}</td>
                                    <td>${res.data[0].order_status}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="others">
                            <strong>The placement of this order occurred on ${res.data[0].order_date}.</strong>
                            <br>
                            <strong>___________________________</strong><br>
                            <strong class='text-muted text-center'>Proccessed By: Hilal Fast Food</strong><br>
                            <img src="http://localhost/NodeProject/Online%20Food%20AdminPanel/images/logo.png" class='img-fluid' style='width: 200px; height: 200px' />
                        </div>
                    
                    `);
                })
                $('.view-order').modal("show")

            })
            $(document).on("click", "a.block", function() {
                var id = $(this).attr("statusID");


                swal({
                        title: "Approved?",
                        text: "Do You want to Approve this Order?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            activate(id, "approved", (res) => {
                                swal("Order status Has been updated successfully!", {
                                    icon: "success",
                                });
                                readOrders()
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
                        title: "inactive?",
                        text: "Do You want to make this data to be inactive?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            activate(id, "pending", (res) => {
                                swal("Order status Has been updated successfully!", {
                                    icon: "success",
                                });
                                readOrders();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })

            $('.approve').click(() => {
                if ($('.customers').val() == "" || $(".date").val() == "") {
                    displayToast("Provide customer and order date to approve!", "error", 4000);
               return;
                }

                checkoutPaymentAmount($(".customers").val(), $(".date").val(), res => {
                
                    if (res.data[0].total > 0) {
                        swal({
                                title: "Confirm?",
                                text: "Do you want to approve this traction? amount is : $" + res.data[0].total,
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    updatePayment($(".customers").val(), $(".date").val(), (res) => {
                                        swal("Payment With the customer " + $(".customers").val() + " Approved Successfully", {
                                            icon: "success",
                                        });

                                    })

                                }
                                // else {
                                //     swal("Your imaginary file is safe!");
                                // }
                            });
                    } else {
                        swal("The customer does not have any orders placed on this date.!");
                    }
                })
            })


            // read users
            function readOrders() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/orders/",
                    success: function(res) {
                        $(".ordersTable tbody").html('');
                        var html = "<tr>";
                        res.data.forEach(value => {
                            html += `<td>${value.order_id}</td>`
                            html += `<td>${value.fullName}</td>`
                            html += `<td>${value.food_name}</td>`
                            html += `<td>${value.quantity}</td>`

                            html += `<td>$${value.total_amount}</td>`
                            // html += `<td>${value.order_date}</td>`
                            if (value.order_status.toLowerCase() == "pending")
                                html += `<td><a statusID=${value.order_id} data-toggle="tooltip" data-placement="top" title='Update Status On Order ${value.order_id}' class='btn btn-danger block'><i class="fa-solid fa-ban"></i></a></td>`
                            else
                                html += `<td><a statusID=${value.order_id} class='btn btn-success active'>
                            <i class="fa-solid fa-check"></i></a></td>`


                            html += `<td>
                            <a delID=${value.order_id} class='btn btn-danger delete'><i class="fa-solid fa-circle-minus"></i></a>
                           <a viewID=${value.order_id} class='btn btn-success view'><i class="fa-solid fa-eye"></i></a>
                            </td>
                            `

                            html += "</tr>"
                        })

                        $(".ordersTable tbody").html(html);
                        $('.ordersTable').DataTable();

                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            readOrders()

            // delete
            function deleteUser(id, response) {
                $.ajax({
                    method: "DELETE",
                    url: "http://localhost:4200/orders/deleteOrder/" + id,
                    success: function(res) {
                        response(res)
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }

            $('.activateAll').click(() => {
                swal({
                        title: "Are you sure?",
                        text: "Confirm That, You want to activate All pending Orders",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            activateAll((res) => {
                                swal("All Orders has been activated", {
                                    icon: "success",
                                });
                                readOrders();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })
            $('.deactivateAll').click(() => {
                swal({
                        title: "Are you sure?",
                        text: "Confirm That, You want to Deactivate All Accepted Orders",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            DeactivateAll((res) => {
                                swal("All Orders has been deactivated", {
                                    icon: "success",
                                });
                                readOrders();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })

            function activate(id, status, response) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "status": status,
                        "id": id
                    },
                    url: "http://localhost:4200/orders/activate",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }

            function checkoutPaymentAmount(id, date, response) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "cust_id": id,
                        "date": date
                    },
                    url: "http://localhost:4200/orders/getTotalAmount",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }

            function updatePayment(id, date, response) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "cust_id": id,
                        "date": date
                    },
                    url: "http://localhost:4200/orders/updatePayment",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }

            function readCustomers() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/customers/",
                    success: function(res) {

                        var html = "";
                        res.data.forEach(value => {

                            html += `<option value='${value.cust_id}'>${value.fullName}</option>`





                        })

                        $(".customers").append(html);


                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            readCustomers()

            function activateAll(response) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    url: "http://localhost:4200/orders/activateAll",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }

            function DeactivateAll(response) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    url: "http://localhost:4200/orders/deactivateAll",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }

            function readOderData(id, response) {
                $.ajax({
                    method: "GET",
                    dataType: "JSON",

                    url: "http://localhost:4200/orders/" + id,
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