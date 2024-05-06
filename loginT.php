<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Teacher Login</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">


</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 200px;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image teacher2">

                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Welcome to Teacher login</h1>
                                        <p class="mb-4">If you want to login in to pur platform you have to contact admin and get an verification code, username & passward to enter the System</p>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user mb-3" id="username" placeholder="Enter username">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user mb-3" id="passward" placeholder="Enter passward">
                                    </div>

                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" value="" id="remember">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remeber me
                                        </label>
                                        <a class="small ms-5" href="#" onclick="showModal();"> fogot passward.?? </a> <br/>
                                    </div>



                                    <button class="btn btn-primary btn-user btn-block" onclick="login('teacher');">
                                        Login to the system
                                    </button>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#" onclick="showVerifyModal();"> Verify Account </a> <br/>
                                        <a class="small text-warning" href="#" onclick="showModal();"> Request Access From Admin </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade " id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="msgModelTitle">Message from System</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p id="msgModelBody"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Verify Modal -->
    <div class="modal fade " id="verifyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verify your Teacher Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <label for="" class="form-label">Enter verification code</label>
                  <input type="text"
                    class="form-control"  id="code"  placeholder="enter verification code">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="verification('teacher');">Verify Account</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="login.js"></script>


</body>

</html>