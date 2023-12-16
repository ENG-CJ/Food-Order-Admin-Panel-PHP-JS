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
</head>

<body>
    <?php include '../config/nav.php' ?>
    <div id="layoutSidenav">
        <?php include '../config/sidebar.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h5 class="mt-4">Dashboard</h5>

                    <div class="row">
                        <div class="col-4 mb-3">
                            <div class="card-container">

                                <div class="items-container">

                                    <div class="left-item">
                                        <h5>Customers</h5>
                                        <h4 class='customers'>30</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-container container-2">

                                <div class="items-container">

                                    <div class="left-item">
                                        <h5>Orders</h5>
                                        <h4 class='orders'>90</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-container container-3">

                                <div class="items-container">

                                    <div class="left-item">
                                        <h5>Pending Orders</h5>
                                        <div class="flex-items">

                                            <h4 class='pending'>30</h4>
                                        </div>
                                    </div>
                                    <div class="right-item">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-container container-2">

                                <div class="items-container">

                                    <div class="left-item">
                                        <h5>categories</h5>
                                        <h4 class='categories'>$100</h4>
                                    </div>
                                    <div class="right-item">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-container container-3">

                                <div class="items-container">

                                    <div class="left-item">
                                        <h5>Foods</h5>
                                        <h4 class='foods'>200</h4>
                                    </div>
                                    <div class="right-item">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-container">

                                <div class="items-container">

                                    <div class="left-item">
                                        <h5>Users</h5>
                                        <h4 class='users'>200</h4>
                                    </div>
                                    <div class="right-item">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pending Orders
                        </div>
                        <div class="card-body">
                            <table class='table pendingOrders'>
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Food</th>
                                        <th>Price</th>
                                        <th>Order Date</th>
                                        <th>Status</th>

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
        $(document).ready(() => {
            function count(table, endPoint, label) {
                $.ajax({
                    method: "GET",
                    url: `http://localhost:4200/dashboard/${endPoint}/` + table,
                    success: function(res) {
                        console.log(res)
                        label.text(res.data.row)
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            count("users", "count", $(".users"))
            count("customers", "count", $(".customers"))
            count("orders", "count", $(".orders"))
            count("foods", "count", $(".foods"))
            count("categories", "count", $(".categories"))
            count("orders", "countPendingOrders", $(".pending"))



            function readOrders() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/orders/pendingOrders",
                    success: function(res) {
                        $(".pendingOrders tbody").html('');
                        var html = "<tr>";
                        res.data.forEach(value => {
                            html += `<td>${value.order_id}</td>`
                            html += `<td>${value.food_name}</td>`
                            html += `<td>$${value.price}</td>`
                            html += `<td>${value.order_date}</td>`
                            html += `<td>${value.order_status}</td>`
                            html += "</tr>"
                        })

                        $(".pendingOrders tbody").html(html);
                        $('.pendingOrders').DataTable();

                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            readOrders()
        })
    </script>
</body>

</html>