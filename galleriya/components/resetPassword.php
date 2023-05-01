<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Galleriya</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css///style.css">

    <!-- Bootstrap Icon CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../resources/svg/logo-black.svg">
</head>

<body>
    <div class="container">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="col-12 text-center my-5 py-2">
                        <h1>Reset your Password</h1>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-envelope fa-lg me-3 mb-4 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="email" id="email" placeholder="Enter your email" class="form-control " />
                            <label class="form-label" for="email">Your Email</label> <span class="ms-2"><a href="#"
                                    onclick="sendCode();">Send Code</a></span>
                        </div>
                    </div>

                    <div class=" d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-lock fa-lg me-3 mb-4 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" id="vcode" disabled placeholder="Enter your verification code"
                                class="form-control " />
                            <label class="form-label" for="vcode">Verification Code</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-2">
                        <i class="fas fa-key fa-lg me-3 mb-4 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="password" id="new_pw" placeholder="Enter your new password"
                                class="form-control" disabled />
                            <label class="form-label" id="rpwborder" for="new_pw">New Password</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3 text-center">
                        <a type="button" class="btn btn-light-red" onclick="resetPassword();">Reset Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="../javaScript/script.js"></script>
</body>

</html>