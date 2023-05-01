<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Galleriya</title>

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

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign In</p>

                                    <form class="mx-1 mx-md-4">

                                        <?php  

                                            $email = "";
                                            $password = "";

                                            if(isset($_COOKIE["email"])) {
                                                $email = $_COOKIE["email"];
                                            }

                                            if(isset($_COOKIE["password"])) {
                                                $password = $_COOKIE["password"];
                                            }

                                        ?>


                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="user_log_email" <?php echo $password ?>
                                                    class="form-control shadow-none border-0 border-dark border-bottom" />
                                                <label class="form-label" for="user_log_email">Your Email</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="user_log_password"
                                                    value="<?php echo $password ?>"
                                                    class="form-control shadow-none border-0 border-dark border-bottom" />
                                                <label class="form-label" for="user_log_password">Password</label>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-between">
                                            <div class="ps-3">
                                                <div class="form-check d-flex justify-content-center mb-5">
                                                    <input class="form-check-input me-2" type="checkbox" value="1"
                                                        id="rm_me" />
                                                    <label class="form-check-label" for="rm_me">
                                                        Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="components/resetPassword.php">Forgot Password</a>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <div class="spinner-border d-none" id="spinner" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 gap-2">
                                            <a type="button" class="btn btn-light-red" onclick="userSignIn();">Sign
                                                In</a>
                                            <a href="userSignup.php" type="button"
                                                class="btn btn-outline-dark">Register</a>
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