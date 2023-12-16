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
                        <h6 class="mt-4">Manage All Categories</h6>
                        <button class="btn btn-success createCategory">Create Category</button>
                    </div>
                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            List of Users
                        </div>
                        <div class="card-body">
                            <table class="categories">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Description</th>
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

    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add / Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error-handler-body">

                    </div>
                    <div class="form-group mb-2">
                        <label>Category *</label>
                        <input type="text" class="form-control category" placeholder="e.g Pizza" required>
                        <input type="text" hidden class="form-control id" placeholder="e.g Pizza" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Description [optional]</label>
                        <textarea name="description" placeholder="you can optionally Describe this category" id="" cols="30" rows="10" class="form-control description"></textarea>
                    </div>


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
            $(".createCategory").click(() => {

                $('.category').val('')
                $('.description').val('')
                $('.save').text("save")
                $("#categoryModal").modal("show")
            })
            $(".close").click(() => {
                $("#categoryModal").modal("hide")
            })

            function fetchSingle(id, response) {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/categories/" + id,
                    success: function(res) {
                        response(res)
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
            }
            $(document).on("click", "a.edit", function() {
                var id = $(this).attr("editID");
                fetchSingle(id, res => {
                    console.log(res)
                    $('.category').val(res.data[0].name)
                    $('.description').val(res.data[0].description)
                    $('.id').val(id)
                    $('.save').text("Edit")
                    $('#categoryModal').modal('show')
                })
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
                            deleteCategory(id, (res) => {
                                swal(res.message, {
                                    icon: "success",
                                });
                                readCategories();
                            })

                        }
                        // else {
                        //     swal("Your imaginary file is safe!");
                        // }
                    });
            })
            $(".save").click(() => {
                if ($('.save').text().toLocaleLowerCase() == "save") {
                    if ($('.category').val() == "") {
                        displayToast("Category Is required", "error", 3000);
                        return;
                    }
                    checkCategory($('.category').val(), res => {
                        if (res.data.length > 0) {
                            displayToast("Category already exist", "error", 3000);
                            return;
                        }
                        createCategory({
                            name: $('.category').val(),
                            description: $('.description').val() == "" ? "No Description" : $('.description').val(),
                        })
                        $("#categoryModal").modal("hide")
                    })

                } else {
                    if ($('.category').val() == "") {
                        displayToast("Category Is required", "error", 3000);
                        return;
                    }
                    updateCategory({
                        id: $('.id').val(),
                        name: $('.category').val(),
                        description: $('.description').val() == "" ? "No Description" : $('.description').val(),
                    })
                    $("#categoryModal").modal("hide")
                }
            })

            // read users
            function readCategories() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/categories/",
                    success: function(res) {
                        $(".categories tbody").html('');
                        var html = "<tr>";
                        res.data.forEach(value => {
                            html += `<td>${value.cat_id}</td>`
                            html += `<td>${value.name}</td>`
                            html += `<td>${value.description.slice(0,50)}...</td>`
                            html += `<td>
                            <a deleteID=${value.cat_id} class='btn btn-danger delete'><i class="fa-solid fa-circle-minus"></i>
                            </a>
                            <a editID=${value.cat_id} class='btn btn-success edit'><i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                            </td>`
                            html += "</tr>"
                        })

                        $(".categories tbody").html(html);
                        $('.categories').DataTable();

                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            readCategories()

            // delete
            function deleteCategory(id, response) {
                $.ajax({
                    method: "DELETE",
                    url: "http://localhost:4200/categories/" + id,
                    success: function(res) {
                        if (!res.status) {
                            displayToast("Something Went Wrong, During Deletion", "error", 3000);
                            return;
                        }
                        response(res)
                    },
                    error: function(res) {

                        console.log(res);
                        displayToast(res.responseText, "error", 5000);
                    }
                })

            }

            // create user
            function createCategory(data) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "http://localhost:4200/categories/addCategory",
                    success: function(res) {
                        displayToast("Category added successfully", "success", 3000);
                        readCategories()
                    },
                    error: function(res) {
                        console.log(res);
                        displayToast(res.responseText, "error", 3000);
                    }
                })

            }

            function updateCategory(data) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: data,
                    url: "http://localhost:4200/categories/updateCategory",
                    success: function(res) {
                        displayToast("Category updated successfully", "success", 3000);
                        readCategories()
                        $('#categoriesModal').modal("hide")
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }

            function checkCategory(name, response) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "name": name,

                    },
                    url: "http://localhost:4200/categories/checkCategory",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                        displayToast(res.responseText, 4000);
                    }
                })

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