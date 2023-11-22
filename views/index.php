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
                                        <h4>30</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-container container-2">

                                <div class="items-container">

                                    <div class="left-item">
                                        <h5>Active Orders</h5>
                                        <h4>90</h4>
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
                                            <i class="fab fa-facebook"></i>
                                            <h4>30</h4>
                                        </div>
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
                                        <h5>Balance ($)</h5>
                                        <h4>$100</h4>
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
                                        <h4>200</h4>
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
                                        <h5>Users</h5>
                                        <h4>200</h4>
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
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>StartDate</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>
                                <tbody>







                                    <tr>
                                        <td>Cara Stevens</td>
                                        <td>Sales Assistant</td>
                                        <td>New York</td>
                                        <td>46</td>
                                        <td>2011/12/06</td>
                                        <td>$145,600</td>
                                    </tr>
                                    <tr>
                                        <td>Hermione Butler</td>
                                        <td>Regional Director</td>
                                        <td>London</td>
                                        <td>47</td>
                                        <td>2011/03/21</td>
                                        <td>$356,250</td>
                                    </tr>
                                    <tr>
                                        <td>Lael Greer</td>
                                        <td>Systems Administrator</td>
                                        <td>London</td>
                                        <td>21</td>
                                        <td>2009/02/27</td>
                                        <td>$103,500</td>
                                    </tr>
                                    <tr>
                                        <td>Jonas Alexander</td>
                                        <td>Developer</td>
                                        <td>San Francisco</td>
                                        <td>30</td>
                                        <td>2010/07/14</td>
                                        <td>$86,500</td>
                                    </tr>
                                    <tr>
                                        <td>Shad Decker</td>
                                        <td>Regional Director</td>
                                        <td>Edinburgh</td>
                                        <td>51</td>
                                        <td>2008/11/13</td>
                                        <td>$183,000</td>
                                    </tr>
                                    <tr>
                                        <td>Michael Bruce</td>
                                        <td>Javascript Developer</td>
                                        <td>Singapore</td>
                                        <td>29</td>
                                        <td>2011/06/27</td>
                                        <td>$183,000</td>
                                    </tr>
                                    <tr>
                                        <td>Donna Snider</td>
                                        <td>Customer Support</td>
                                        <td>New York</td>
                                        <td>27</td>
                                        <td>2011/01/25</td>
                                        <td>$112,000</td>
                                    </tr>
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
</body>

</html>