<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8" />
    <title></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ================== css ================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assist/style.css">
    <!-- ================== css ================== -->
    <!-- BEGIN parsley css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/doc/assets/docs.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/src/parsley.css">
    <!-- END parsley css-->

    <!-- BEGIN jquery js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- END jquery js-->

    <!-- BEGIN parsley js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- END parsley js-->
</head>

<body class="login-body h-100">
    <div class="h-100 p-0 m-0">
        <div class="h-100">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="p-5 ">
                    <div class="text-center">
                        <h3>Login</h3>
                    </div>
                    <?php
                    if (isset($_SESSION['err-empty'])) {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>" . $_SESSION['err-empty'] . "</strong>  
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        unset($_SESSION['err-empty']);
                    }

                    if (isset($_SESSION['err-login'])) {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Login Failed! </strong>  " . $_SESSION['err-login'] . "
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        unset($_SESSION['err-login']);
                    }
                    ?>
                    <form action="scripts.php" method="post" data-parsley-validate>
                        <hr class="mb-3">
                        <label for="email"><b>Email Address</b></label>
                        <input class="form-control" type="email" name="email" data-parsley-trigger="keyup" required>
                        <label for="password"><b>Password</b></label>
                        <input class="form-control" type="password" name="password" required>
                        <hr class="mb-3">
                        <input class="btn btn-primary w-100 submit-button" type="submit" name="login" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>