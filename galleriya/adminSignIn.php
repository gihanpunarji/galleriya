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

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Admin Sign In</p>

                                    <!-- <form class="mx-1 mx-md-4"> -->

                                    <div class="col-12">
                                        <input type="text" id="email" autocomplete="off"
                                            class="form-control shadow-none border-0 border-dark border-bottom">
                                        <label for="email" class="form-label">Email</label>
                                    </div>

                                    <span class="sendCode text-end" href="#" onclick="sendAdminCode();">Send
                                        code</span>

                                    <div class="col-12">
                                        <input type="text" id="vcode"
                                            class="form-control shadow-none border-0 border-dark border-bottom"
                                            disabled>
                                        <label for="vcode" class="form-label">Verification code</label>
                                    </div>



                                    <div class="col-12">
                                        <span style="color: #808080; font-size: 12px;">Note: If you want to change
                                            your admin
                                            details please contact the developer.</span>
                                    </div>
                                    <div class="d-flex justify-content-center mb-2">
                                        <div class="spinner-border d-none" id="spinner" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button id="btn" disabled class="btn btn-light-red w-100"
                                            onclick="adminSignIn();">Sign
                                            In</button>
                                    </div>

                                    <!-- </form> -->

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