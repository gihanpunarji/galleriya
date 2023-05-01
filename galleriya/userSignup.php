<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Galleriya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icon CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/svg/logo-black.svg">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="icon" href="resources/svg/logo-black.svg">
</head>

<body>
    <div class="vh-100" style="background-color: #c0c0c0;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form class="mx-1 mx-md-4">

                                        <div class="d-flex flex-row align-items-center mbb-2">
                                            <i class="fas fa-user fa-lg me-3 mb-4 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="user_fname" placeholder="Enter your first name"
                                                    class="form-control " />
                                                <label class="form-label" for="user_name">First Name</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mbb-2">
                                            <i class="fas fa-user fa-lg me-3 mb-4 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="user_lname" placeholder="Enter your last name"
                                                    class="form-control " />
                                                <label class="form-label" for="user_name">Last Name</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-envelope fa-lg me-3 mb-4 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="user_email" placeholder="Enter your email"
                                                    class="form-control " />
                                                <label class="form-label" for="user_email">Your Email</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-lock fa-lg me-3 mb-4 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="user_password"
                                                    placeholder="Enter your password" class="form-control " />
                                                <label class="form-label" for="user_password">Password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <i class="fas fa-key fa-lg me-3 mb-4 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="user_rp_pw"
                                                    placeholder="Re enter your password" class="form-control " />
                                                <label class="form-label" id="rpwborder" for="user_rp_pw">Repeat your
                                                    password</label>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" id="policy_check" />
                                            <label class="form-check-label" for="policy_check" id="policy_label">
                                                I agree all statements in <a href="#">Terms of service</a>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="spinner-border d-none" id="spinner" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 gap-2">
                                            <button type="button" class="btn btn-light-red btn"
                                                onclick="registerUser();">Register</button>
                                            <a href="userSignin.php" type="button" class="btn btn-outline-dark btn">Sign
                                                In</a>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="resources/svg/logo-no-background.svg" class="img-fluid">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="javaScript/script.js"></script>
</body>

</html>