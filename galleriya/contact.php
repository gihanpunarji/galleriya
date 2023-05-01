<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Galleriya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap Icon CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="resources/svg/logo-black.svg">
</head>

<body>
    <?php include "components/header.php" ?>

    <div class="container">
        <section class="mb-4">

            <!--Section heading-->
            <h1 class="fw-bold text-center my-4 py-3">Contact us</h1>
            <!--Section description-->
            <p class="text-center mx-auto mb-5">Do you have any questions? Please do not hesitate to
                contact us
                directly. Our team will come back to you within
                a matter of hours to help you.</p>

            <div class="row">
                <div class="col-12 col-md-9 mb-md-0 mb-5">
                    <form id="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-12 mb-2">
                                    <input type="text" id="name" class="form-control">
                                    <label for="name" class="">Your name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-12 mb-2">
                                    <input type="text" id="email" class="form-control">
                                    <label for="email" class="">Your email</label>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-12 mt-2">
                                    <input type="text" id="subject" class="form-control">
                                    <label for="subject" class="">Subject</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="mt-2">
                                    <textarea type="text" id="message" rows="4" class="form-control"></textarea>
                                    <label for="message">Your message</label>
                                </div>

                            </div>
                        </div>
                    </form>

                    <div class="text-center">
                        <a class="btn btn-light-red px-5">Send</a>
                    </div>
                </div>
                <div class="col-12 col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-map-marker-alt fa-2x"></i>
                            <p>Kegalle, I 52/2 Pannala North Ampagala</p>
                        </li>

                        <li><i class="fas fa-phone mt-4 fa-2x"></i>
                            <p>+ 94 715327065</p>
                        </li>

                        <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                            <p>info@galleriya.com</p>
                        </li>
                    </ul>
                </div>
            </div>

        </section>
    </div>
    <?php include "components/footer.php" ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>