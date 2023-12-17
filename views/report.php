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
                        <h6 class="mt-4">Report Orders</h6>
                        <div class="alert alert-primary">
                            <strong>To print Full Data, click 👉 <i class="fa-solid fa-eye"></i> icon and then
                                print</strong>
                        </div>

                    </div>
                    <div class="card mb-4 mt-3">
                        <div class="card-header d-flex justify-content-between">
                            <label for="">
                                <i class="fas fa-table me-1"></i>
                                Report Data
                            </label>
                            <button class="btn btn-success printAll">
                                <i class="fa-solid fa-print mr-2"></i>
                                Prin All</button>
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
            $('.printAll').click(() => {

                printAllData(res => {
                    let previousCustomerName = '';
                    let totalAmount = 0;
                    $('.print-area').html('');

                    // Create a table element with Bootstrap classes and inline styles
                    const table = $(`
        <table class="table" style="width: 100%; border-collapse: collapse;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th style="padding: 8px;">ID</th>
                    <th style="padding: 8px;">Name</th>
                    <th style="padding: 8px;">Mobile</th>
                    <th style="padding: 8px;">Address</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    `);

                    let isOrderHeaderAdded = false;

                    res.data.forEach(value => {
                        // Display customer details if the current customer name is different from the previous one
                        if (value.fullName !== previousCustomerName) {
                            // Create a table row for customer details
                            const customerRow = `
                <tr>
                    <td style="padding: 8px;">${value.CustomerID}</td>
                    <td style="padding: 8px;">${value.fullName}</td>
                    <td style="padding: 8px;">${value.mobile}</td>
                    <td style="padding: 8px;">${value.address}</td>
                </tr>
            `;

                            // Append customer details row to the table body
                            table.find('tbody').append(customerRow);

                            // Update previous customer name
                            previousCustomerName = value.fullName;

                            // Reset the flag for order header and total amount
                            isOrderHeaderAdded = false;
                            totalAmount = 0;
                        }

                        // Add order details column headers if not added yet
                        if (!isOrderHeaderAdded) {
                            const orderHeader = `
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 8px;">Order ID</th>
                    <th style="padding: 8px;">Food Name</th>
                    <th style="padding: 8px;">Food Price</th>
                    <th style="padding: 8px;">Quantity</th>
                </tr>
            `;
                            table.find('tbody').append(orderHeader);

                            // Set the flag to true to prevent adding order headers again
                            isOrderHeaderAdded = true;
                        }

                        // Calculate total amount for each customer's order
                        const orderTotal = value.FoodPrice * value.quantity;
                        totalAmount += orderTotal;

                        // Create a table row for order details
                        const orderRow = `
            <tr>
                <td style="padding: 8px;">${value.order_id}</td>
                <td style="padding: 8px;">${value.food_name}</td>
                <td style="padding: 8px;">$${value.FoodPrice}</td>
                <td style="padding: 8px;">${value.quantity}</td>
            </tr>
        `;

                        // Append order details row to the table body
                        table.find('tbody').append(orderRow);

                        // Display total amount at the end of each customer's order
                        if (res.data.indexOf(value) === res.data.length - 1 || res.data[res.data.indexOf(value) + 1].fullName !== previousCustomerName) {
                            const totalRow = `
                <tr style="background-color: #f2f2f2;">
                    <td colspan="3" style="padding: 8px;"></td>
                    <td style="padding: 8px;"><strong>Total: $${totalAmount}</strong></td>
                </tr>
            `;
                            table.find('tbody').append(totalRow);
                        }
                    });

                    // Append the completed table to the print-area div
                    $('.print-area').append(table);

                    // Show the modal
                    $('.view-order').modal("show");
                });



            })
            $(document).on("click", "a.view", function() {
                var id = $(this).attr("viewID");

                readSinglePrintableData(id, res => {
                    console.log(res)
                    $('.print-area').html('');
                    var html = '';
                    if (res.data[0][0].Paid.toLowerCase() == "yes")
                        html += `<div><strong>Paid : ${res.data[0][0].Paid}</strong></div>`
                    else
                        html += `<div><strong>Paid : ${res.data[0][0].Paid}</strong></div>`

                    $('.print-area').html(`
                    
                    <h3 class='text-center fw-bold'>Report</h3>
                    <h5 class='text-center fw-bold'>HILAAL <span>FAST FOOD</span></h5>
                        <h6 class='text-center'>615178163 | 6100990090</h6>

                        <div class="order-details-area my-5">
                            <h6>Order Details</h6>
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Food</th>
                                    <th>FoodPrice</th>
                                    <th>Quantity</th>
                                    <th>total_amount</th>
                                    <th>status</th>
                                   
                                </tr>
                                <tr>
                                    <td>${res.data[0][0].order_id}</td>
                                    <td>${res.data[0][0].food_name}</td>
                                    <td>$${res.data[0][0].FoodPrice}</td>
                                    <td>${res.data[0][0].quantity}</td>
                                    <td>$${res.data[0][0].total_amount}</td>
                                    <td>${res.data[0][0].order_status}</td>
                                 
                                </tr>
                            </table>
                        </div>

                        <div class="customer-details-area my-5">
                            <h6>Customer Details</h6>
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                   
                                </tr>
                                <tr>
                                    <td>${res.data[0][0].CustomerID}</td>
                                    <td>${res.data[0][0].fullName}</td>
                                    <td>${res.data[0][0].mobile}</td>
                                    <td>$${res.data[0][0].address}</td>
                                    
                                </tr>
                            </table>
                        </div>
                 <div class="paid my-2">
                            ${html}
                        </div>
                        <div class="others">
                            <strong>The placement of this order occurred on ${res.data[0][0].order_date}.</strong>
                            <br>
                            <strong>___________________________</strong><br>
                            <strong class='text-muted text-center'>Processed By: Hilal Fast Food</strong><br>
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
                                html += `<td><a statusID=${value.order_id} data-toggle="tooltip" data-placement="top" title='Status of Order ${value.order_id}' class='text-danger block'>Pending</td>`
                            else
                                html += `<td><a statusID=${value.order_id} class='text-success active'>
                            Accepted</a></td>`


                            html += `<td>
                            
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

            function readSinglePrintableData(id, response) {

                $.ajax({
                    method: "GET",
                    dataType: "JSON",
                    url: "http://localhost:4200/orders/readSinglePrintableData/" + id,
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }

            function printAllData(response) {

                $.ajax({
                    method: "GET",
                    dataType: "JSON",
                    url: "http://localhost:4200/orders/printAllData",
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