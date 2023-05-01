<?php

include "components/header.php";

$user = $_SESSION['user'];

if (!isset($user)) {
?>
<h1>Bad Request</h1 😒>
<?php
} else {
?>
<!DOCTYPE html>
<html lang="en">

<?php


    $user_name = $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"];

    ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title><?php echo $user_name ?> | Galleriya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">


    <!-- Bootstrap Icon CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="resources/svg/logo-no-background.svg">


</head>

<body>

    <?php

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $user["email"] . "' ");
        $user_data = $user_rs->fetch_assoc();

        // Images Table

        $img_rs = Database::search("SELECT * FROM `profile_images` WHERE `user_email` = '" . $user["email"] . "'");
        $img_data = $img_rs->fetch_assoc();

        ?>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <?php if (empty($img_data["path"])) {
                        ?>
                    <img class="mt-5" style="width: 150px; height: 150px; border-radius: 50%;" id="viewImg"
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <?php
                        } else {
                        ?>
                    <img class="mt-5" style="width: 150px; height: 150px; border-radius: 50%;" id="viewImg"
                        src="<?php echo $img_data["path"]; ?> ">
                    <?php
                        } ?>

                    <span class="font-weight-bold mt-5"><?php echo $user_data['fname'] . " " . $user_data["lname"]; ?>
                    </span>
                    <span class="text-black-50 mb-3"><?php echo $user_data['email']; ?>
                    </span>
                    <input type="file" class="d-none" accept="image/*" onclick="addPhoto();" id="profileimg" />
                    <label for="profileimg" class="btn border px-3 p-1 add-experience w-100">Upload Profile
                        Image</label>
                </div>

            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">First Name</label><input disabled type="text"
                                class="form-control" placeholder="first name"
                                value="<?php echo $user_data['fname']; ?>"></div>
                        <div class="col-md-6"><label class="labels">Last Name</label><input disabled type="text"
                                class="form-control" value="<?php echo $user_data['lname']; ?>" placeholder="last name">
                        </div>
                    </div>

                    <?php

                        // // ADDRESS. PROVINCE, DISTRICT TABLE

                        $details_table = Database::search("SELECT * FROM `user_has_address` uha
                    INNER JOIN `address` a ON uha.address_id = a.id
                    INNER JOIN `district` d ON a.district_id = d.id 
                    INNER JOIN `province` p ON d.province_id = p.id 
                    WHERE uha.user_email = '" . $_SESSION["user"]["email"] . "'");

                        $details_data = $details_table->fetch_assoc();

                        // Province 
                        $province_table = Database::search("SELECT * FROM `province`");

                        // District 
                        $district_table = Database::search("SELECT * FROM `district`");

                        ?>


                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Mobile Number</label><input required type="text"
                                class="form-control" placeholder="+94712233444" id="mobile"
                                value="<?= (!isset($user_data["mobile"])) ? "No mobile" : $user_data["mobile"] ?>">
                        </div>
                        <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text"
                                class="form-control" placeholder="enter address line 1" required id="addr_1"
                                value="<?= (!isset($details_data["line1"])) ? "" : $details_data["line1"] ?>">
                        </div>
                        <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text"
                                class="form-control" placeholder="enter address line 2" id="addr_2"
                                value="<?= (!isset($details_data["line2"])) ? "" : $details_data["line2"] ?>"></div>
                        <div class="col-md-12"><label class="labels">Postal code</label><input required type="text"
                                class="form-control" placeholder="postal code" id="pcode"
                                value="<?= (!isset($details_data["postal_code"])) ? "Enter postal code" : $details_data["postal_code"] ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Province</label>
                            <select id="province" class="form-select"">
                                <option value=" 0">Select Province</option>
                                <?php
                                    for ($i = 0; $i < $province_table->num_rows; $i++) {
                                        $data = $province_table->fetch_assoc();
                                    ?>
                                <option value="<?php echo $data["id"] ?>">
                                    <?php echo $data["province_name"] ?></option>
                                <?php
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="labels">District</label>
                            <select id="district" class="form-select">
                                <option value="0">Select District</option>
                                <?php
                                    for ($i = 0; $i < $district_table->num_rows; $i++) {
                                        $data = $district_table->fetch_assoc();
                                    ?>
                                <option value="<?php echo $data["id"] ?>"><?php echo $data["district_name"] ?></option>
                                <?php
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="col-md-12"><label class="labels">Email Address</label><input type="text"
                                class="form-control" value="<?php echo $user_data['email']; ?>" disabled></div>
                    </div>
                    <div class="mt-5 text-center"><button onclick="saveProfile();" class="btn btn-light-red"
                            type="button">Save
                            Profile</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Your Details</span>
                    </div><br>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-6">Mobile : </div>
                        <div class="col-md-6 text-black-50">
                            <?= (!isset($user_data["mobile"])) ? "No mobile" : $user_data["mobile"] ?></div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-6">Province :
                        </div>
                        <div class="col-md-6 text-black-50">
                            <?= (!isset($details_data["province_name"])) ? "Select province first" : $details_data["province_name"] ?>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-6">District :
                        </div>
                        <div class="col-md-6 text-black-50">
                            <?= (!isset($details_data["district_name"])) ? "Select district first" : $details_data["district_name"] ?>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-6">Address line 1 : </div>
                        <div class="col-md-6 text-black-50">
                            <?= (!isset($details_data["line1"])) ? "Enater address line 1" : $details_data["line1"] ?>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-6">Address line 2 : </div>
                        <div class="col-md-6 text-black-50">
                            <?= (!isset($details_data["line2"])) ? "Enater address line 2" : $details_data["line2"] ?>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-md-6">Postal Code : </div>
                        <div class="col-md-6 text-black-50">
                            <?= (!isset($details_data["postal_code"])) ? "Enater postal code" : $details_data["postal_code"] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    }

    <?php include "components/footer.php"; ?>

    <script src="javaScript/script.js"></script>

</body>
<?php
}
?>

</html>