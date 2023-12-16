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
                        <h6 class="mt-4">View and Manage All Different Fast Foods</h6>
                        <button class="btn btn-success createFood">Add New Food</button>
                    </div>
                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            List of Fast Foods Available
                        </div>
                        <div class="card-body">
                            <table class="foodsTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Food</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Available</th>
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

    <div class="modal fade bd-example-modal-lg foodsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    Add / Edit Food
                </div>
                <div class="modal-body">
                    <div class="error-area">

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="form-label">Food</label>
                            <input type="text" name="" id="" placeholder="e.g Pizza Large" class="form-control foodName">
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Category</label>
                            <select name="" id="" class="form-select food-category">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Price ($)</label>
                            <input type="number" name="" placeholder="10" id="" class="form-control price">
                        </div>
                        <div class="col-12 my-2">
                            <label for="" class="form-label">Image *</label>
                            <input type="file" name="" id="" class="form-control image">
                            <input type="text" hidden name="" id="" class="form-control default-image">
                            <input type="text" hidden name="" id="" class="form-control updated_id">
                            <img src='' class='img-fluid food-image-view mt-2' style='width: 140px; height: 140px; border: 1px solid green; border-radius: 10px' />
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Availability</label>
                            <input type="text" disabled value="yes" name="" id="" class="form-control available">
                            <div class="info-area">
                                <strong class='text-muted'>By Default Availability is Yes, You can change it letter</strong>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success save">save</button>
                    <button class="btn btn-danger close">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade view-image-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body body-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>

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

            $(".createFood").click(() => {
                resetInputs()
                $('.info-area').html(`
                <strong class='text-muted'>By Default Availability is Yes, You can change it letter</strong>

                `)
                $('.save').text("save")
                $(".foodsModal").modal("show")
            })
            $(".close").click(() => {
                $(".foodsModal").modal("hide")
                $(".view-image-modal").modal("hide")
            })

            $(document).on("click", ".image-view", function() {
                $('.body-content').html(`
                <img src='http://localhost:4200/uploads/${$(this).attr('image-name')}' class='img-fluid w-100'/>
                
                `)
                $('.view-image-modal').modal("show")
            })
            $(".save").click(() => {
                if ($('.save').text().toLocaleLowerCase() == "save") {
                    if ($('.foodName').val() == "" || $('.food-category').val() == "" || $('.price') == "") {
                        $('.error-area').html(`
                         <div class="alert alert-danger"><strong>All Fields Are Required *</strong></div>
                        
                        `)
                        clearHtmlData(".error-area")
                        return;
                    }
                    if (!validateName($('.foodName').val())) {
                        $('.error-area').html(`
                         <div class="alert alert-danger"><strong>The Food name provided is considered invalid. It must exclusively consist of spaces and alphabetical characters.</strong></div>
                        
                        `)
                        clearHtmlData(".error-area")
                        return;
                    }
                    if (($('.price').val() > 40 || $('.price').val() < 0)) {
                        $('.error-area').html(`
                         <div class="alert alert-danger"><strong>The price you provided is out of range, price must vary between $0 and $40.</strong></div>
                        
                        `)
                        clearHtmlData(".error-area")
                        return;
                    }
                    var extensions = ["jpg", 'png', "jpeg"]


                    var data = new FormData();
                    if ($('.image')[0].files.length > 0) {
                        var extension = $('.image').val().toLowerCase().split('.')[1];
                        if (!extensions.includes(extension)) {
                            $('.error-area').html(`
                         <div class="alert alert-danger"><strong>Files with the ${extension} extension are prohibited or not permitted..</strong></div>
                        
                        `)
                            clearHtmlData(".error-area")
                            return;
                        }
                        checkFoodName($('.foodName').val(), res => {
                            if (res.data.length > 0) {
                                $('.error-area').html(`
                         <div class="alert alert-danger"><strong>Food with the name ${$('.foodName').val()} Already Exist..</strong></div>
                        
                        `)
                                clearHtmlData(".error-area")
                                return;
                            }
                            data.append("name", $('.foodName').val())
                            data.append("category_id", $('.food-category').val())
                            data.append("price", $('.price').val())
                            data.append("image", $('.image')[0].files[0])

                            createFood(data)
                            $("#categoryModal").modal("hide")

                        })

                    } else {
                        $('.error-area').html(`
                         <div class="alert alert-danger"><strong>Food Image is Required, Please select one image.</strong></div>
                        
                        `)
                        clearHtmlData(".error-area")
                        return;
                    }

                } else {
                    if ($('.foodName').val() == "" || $('.food-category').val() == "" || $('.price') == "") {
                        $('.error-area').html(`
                         <div class="alert alert-danger"><strong>All Fields Are Required *</strong></div>
                        
                        `)
                        clearHtmlData(".error-area")
                        return;
                    }
                    if (!validateName($('.foodName').val())) {
                        $('.error-area').html(`
                         <div class="alert alert-danger"><strong>The Food name provided is considered invalid. It must exclusively consist of spaces and alphabetical characters.</strong></div>
                        
                        `)
                        clearHtmlData(".error-area")
                        return;
                    }
                    if (($('.price').val() > 40 || $('.price').val() < 0)) {
                        $('.error-area').html(`
                         <div class="alert alert-danger"><strong>The price you provided is out of range, price must vary between $0 and $40.</strong></div>
                        
                        `)
                        clearHtmlData(".error-area")
                        return;
                    }
                    var extensions = ["jpg", 'png']
                    var extension = $('.image').val().toLowerCase().split('.')[1];

                    if ($('.image')[0].files.length > 0) {
                        if (!extensions.includes(extension)) {
                            $('.error-area').html(`
                         <div class="alert alert-danger"><strong>Files with the ${extension} extension are prohibited or not permitted..</strong></div>
                        
                        `)
                            clearHtmlData(".error-area")
                            return;
                        }
                        var data = new FormData();
                        data.append("name", $('.foodName').val())
                        data.append("category_id", $('.food-category').val())
                        data.append("price", $('.price').val())
                        data.append("image", $('.image')[0].files[0])
                        data.append("default_image", $('.default-image').val())
                        data.append("id", $('.updated_id').val())
                        updateFood(data, $('.updated_id').val(), true)
                        $('.foodsModal').modal("hide")
                    } else {

                        updateFood({
                            "name": $('.foodName').val(),
                            "category_id": $('.food-category').val(),
                            "price": $('.price').val(),
                            "default_image": $('.default-image').val(),
                            "id": $('.updated_id').val(),
                        })
                        $('.foodsModal').modal("hide")
                    }
                }
            })

            $('.image').change(() => {
                displaySelectedImage()
            })

            function resetInputs() {
                $('.foodName').val('')
                $('.food-category').val('')
                $('.price').val('')
                $('.image').val('')
                $('.food-image-view').attr("src", "../images/placeholder.jpg")
                $(".available").val("yes")
            }

            function displaySelectedImage() {
                if ($('.image')[0].files.length > 0) {
                    $('.food-image-view').attr("src", URL.createObjectURL($('.image')[0].files[0]))
                }
            }

            function clearHtmlData(htmlArea, timeout = 4000) {
                setTimeout(() => {
                    $(htmlArea).html('')
                }, timeout);
            }

            function readCategories() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/categories/",
                    success: function(res) {
                        var op = "<option value=''>Select</option>"
                        res.data.forEach(value => {
                            op += `<option value='${value.cat_id}'>${value.name}</option>`
                        })
                        $('.food-category').html(op)
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            readCategories()

            function readFoods() {
                $.ajax({
                    method: "GET",
                    url: "http://localhost:4200/foods/",
                    success: function(res) {
                        $(".foodsTable tbody").html('');
                        var html = "<tr>";
                        res.data.forEach(value => {
                            html += `<td>${value.id}</td>`
                            html += `<td>${value.food_name}</td>`
                            html += `<td>${value.name}</td>`
                            html += `<td>${value.price}</td>`


                            html += `<td class='image-view' image-name='${value.image}'>
                            <img src='http://localhost:4200/uploads/${value.image}' class='img-fluid' style='width: 40px; height: 40px'/>
                            
                            </td>`
                            // html += `<td>${value.order_date}</td>`
                            if (value.status.toLowerCase() == "no")
                                html += `<td><a statusID=${value.id} data-toggle="tooltip" data-placement="top" title='Update Status On Food ${value.id}' class='btn btn-danger block'><i class="fa-solid fa-ban"></i></a></td>`
                            else
                                html += `<td><a statusID=${value.id} class='btn btn-success active'>
                            <i class="fa-solid fa-check"></i></a></td>`


                            html += `<td>
                            <a delID=${value.id} class='btn btn-danger delete'><i class="fa-solid fa-circle-minus"></i></a>
                           <a editID=${value.id} class='btn btn-success edit'><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            `

                            html += "</tr>"
                        })

                        $(".foodsTable tbody").html(html);
                        $('.foodsTable').DataTable();
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })

            }
            readFoods()

            function validateName(name) {

                const nameRegex = /^[a-zA-Z\s]+$/;
                return nameRegex.test(name);
            }

            function createFood(data) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    url: "http://localhost:4200/foods/create",
                    success: function(res) {
                        // alert(res.message)
                        if (res.status) {
                            displayToast(res.message, "success", 4000);
                            readFoods()
                        } else {
                            displayToast(res.description, "error", 4000);

                        }

                    },
                    error: function(res) {
                        console.log(res);
                        displayToast(res.responseText, "error", 4000);
                    }
                })

            }

            function updateFood(data, id, hasFile = false) {
                if (hasFile) {
                    $.ajax({
                        method: "PUT",
                        dataType: "JSON",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: data,
                        url: "http://localhost:4200/foods/update/" + id,
                        success: function(res) {
                            alert(res.message)
                            readFoods()
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    })
                } else {
                    $.ajax({
                        method: "PUT",
                        dataType: "JSON",
                        data: data,
                        url: "http://localhost:4200/foods/update/" + data.id,
                        success: function(res) {
                            alert(res.message)
                            readFoods()
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    })
                }


            }

            function checkFoodName(name, response) {
                $.ajax({
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "name": name,

                    },
                    url: "http://localhost:4200/foods/checkFoodName",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                        displayToast(res.responseText, 4000);
                    }
                })

            }
            $(document).on("click", "a.edit", function() {
                var id = $(this).attr("editID");
                fetchSingleData(id, res => {
                    resetInputs()
                    $('.foodName').val(res.data[0].food_name)
                    $('.updated_id').val(res.data[0].id)
                    $('.default-image').val(
                        res.data[0].image)
                    $('.food-category').val(res.data[0].category_id)
                    $('.price').val(res.data[0].price)
                    $('.available').val(res.data[0].status)
                    $('.food-image-view').attr("src", `http://localhost:4200/uploads/${res.data[0].image}`)
                    $('.info-area').html(`
                    <div class='alert alert-primary mt-2'>                
                       <strong class='text-muted'>to change availability, use available column in dataTable</strong>
                    </div>
                    
                    `)
                    $('.save').text("Edit")
                    $('.foodsModal').modal("show")
                })

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
                                swal("Food data has been removed!", {
                                    icon: "success",
                                });
                                readFoods();
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
                            activate(id, "no", (res) => {
                                swal("Food Availability  Has been updated successfully!", {
                                    icon: "success",
                                });
                                readFoods();
                            })

                        }

                    });
            })
            $(document).on("click", "a.block", function() {
                var id = $(this).attr("statusID");


                swal({
                        title: "Activate?",
                        text: "Do You want to make this data to be Available?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            activate(id, "yes", (res) => {
                                swal("Food Availability  Has been updated successfully!", {
                                    icon: "success",
                                });
                                readFoods();
                            })

                        }

                    });
            })




            // delete
            function deleteUser(id, response) {
                $.ajax({
                    method: "DELETE",
                    url: "http://localhost:4200/foods/" + id,
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
                    url: "http://localhost:4200/foods/updateStatus",
                    success: function(res) {
                        response(res);
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }

            function fetchSingleData(id, response) {
                $.ajax({
                    method: "GET",
                    dataType: "JSON",

                    url: "http://localhost:4200/foods/" + id,
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