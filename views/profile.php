<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="../js/jquery-3.3.1.min.js"></script>

</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5 profile_pic" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold user">...</span><span class="text-black-50 user-email">....</span><span> </span></div>
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
                        <div class="col-md-12"><label class="labels">Password</label><input disabled type="password" class="form-control pass" placeholder="enter phone number" value=""></div>
                        <div class="mt-1"><button class="btn btn-danger changePass" type="button">Change Security</button></div>

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
                        if (data.data[0].profile_image == "no_profile")
                            $(".profile_pic").attr("src", "http://localhost:4200/uploads/default.png")
                        else
                            $(".profile_pic").attr("src", "http://localhost:4200/uploads/"+data.data[0].profile_image)

                        $(".username").val(data.data[0].username)
                        $(".user").text(data.data[0].username)
                      
                        $(".email").val(data.data[0].email)
                        $(".user-email").text(data.data[0].email)
                        $(".pass").val(data.data[0].password)
                        $(".username").attr("disabled", false)
                        $(".email").attr("disabled", false)
                    },
                    error: (err) => {
                        console.log(err)

                    }
                })
            }
            readProfile();

        })
    </script>
</body>

</html>