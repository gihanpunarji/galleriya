// REGISTER USER
const registerUser = () => {
  const first_name = document.getElementById("user_fname");
  const last_name = document.getElementById("user_lname");
  const email = document.getElementById("user_email");
  const password = document.getElementById("user_password");
  const rp_password = document.getElementById("user_rp_pw");
  const policy = document.getElementById("policy_check");

  const form = new FormData();

  if (policy.checked) {
    if (rp_password.value != password.value) {
      const rpwborder = document.getElementById("rpwborder");
      rpwborder.classList.add("text-danger");
    } else {
      rpwborder.classList.add("text-black");
    }

    form.append("pw", password.value);
    form.append("rpw", rp_password.value);
    form.append("fname", first_name.value);
    form.append("lname", last_name.value);
    form.append("email", email.value);

    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
      if (req.readyState == 4 && req.status == 200) {
        let txt = req.responseText;
        if (txt == "success") {
          const spinner = document.getElementById("spinner");
          spinner.classList = "spinner-border d-block";
          setTimeout(() => {
            spinner.classList = "spinner-border d-none";
          }, 2000);
          window.location = "userSignin.php";
        } else {
          alert(txt);
        }
      }
    };

    req.open("POST", "middlewares/userSignupProcess.php", true);
    req.send(form);
  } else {
    const policyLable = document.getElementById("policy_label");
    policyLable.classList.add("text-danger");
  }
};

// SIGN IN USER

const userSignIn = () => {
  const loginEmail = document.getElementById("user_log_email");
  const loginPassword = document.getElementById("user_log_password");
  const rememberMe = document.getElementById("rm_me");

  const form = new FormData();
  form.append("e", loginEmail.value);
  form.append("p", loginPassword.value);
  form.append("rm", rememberMe.checked);

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let txt = req.responseText;
      if (txt == "success") {
        const spinner = document.getElementById("spinner");
        spinner.classList = "spinner-border d-block";
        setTimeout(() => {
          spinner.classList = "spinner-border d-none";
        }, 2000);
        window.location = "index.php";
      } else {
        alert(txt);
      }
    }
  };

  req.open("POST", "middlewares/userSigninProcess.php", true);
  req.send(form);
};

//  FORGOT PASSWORD

const sendCode = () => {
  const email = document.getElementById("email");

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let t = req.responseText;
      if (t == "success") {
        alert(
          "Verification code has been sent to your inbox, Please check your email!"
        );
        document.getElementById("new_pw").removeAttribute("disabled");
        document.getElementById("vcode").removeAttribute("disabled");
      } else {
        alert(t);
      }
    }
  };

  req.open("GET", "../middlewares/sendCodeProcess.php?e=" + email.value, true);
  req.send();
};

// RESET PASSWORD

const resetPassword = () => {
  const email = document.getElementById("email");
  const vcode = document.getElementById("vcode");
  const newpw = document.getElementById("new_pw");

  const form = new FormData();
  form.append("e", email.value);
  form.append("vc", vcode.value);
  form.append("npw", newpw.value);

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let t = req.responseText;
      if (t == "success") {
        alert("Password reset Successful");
        window.location.href = "../userSignin.php";
      } else {
        alert(t);
      }
    }
  };

  req.open("POST", "../middlewares/resetPasswordProcess.php", true);
  req.send(form);
};

// CLEAR FILTERS

const clearFilter = () => {};

// FITER OUT RESULTS

const searchPaints = (x) => {
  let search = document.getElementById("search");

  const form = new FormData();

  form.append("search", search.value);
  form.append("page", x);

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let t = req.responseText;
      // alert(t)
      document.getElementById("paints").innerHTML = t;
    }
  };

  req.open("POST", "middlewares/filterCategoryProcess.php", true);
  req.send(form);
};

// SEND PRODUCT ID

// const sendProductId = (id) => {
//     const req = new XMLHttpRequest();

//     req.onreadystatechange = () => {
//         if(req.readyState == 4 && req.status == 200) {
//             let t = req.responseText;
//             alert(t)
//         }
//     }

//     req.open("GET", "middlewares/singleProductView.php", true);
//     req.send();
// }

// CHECK THE QUANTITY

const check_qty = (qty) => {
  let qty_input = document.getElementById("qty");

  if (qty_input.value >= qty) {
    alert("No stocks available! ");
    qty_input.value = qty;
  }
};

// ADD TO CART

const addToCart = (id) => {
  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let t = req.responseText;
      alert(t);
      window.location.reload();
    }
  };

  req.open("GET", "middlewares/addToCartProcess.php?id=" + id, true);
  req.send();
};

// Remove From Cart

const removeFromCart = (id) => {
  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let t = req.responseText;
      window.location.reload();
      alert(t);
    }
  };

  req.open("GET", "middlewares/removeFromCartProcess.php?id=" + id, true);
  req.send();
};

// SIGN OUT

function signout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      }
    }
  };

  r.open("GET", "signoutProcess.php", true);
  r.send();
}

// ADD PHOTO

const addPhoto = () => {
  const img = document.getElementById("viewImg");
  const img_chooser = document.getElementById("profileimg");

  img_chooser.onchange = function () {
    file = this.files[0];
    url = window.URL.createObjectURL(file);

    img.src = url;
  };
};

// GET PROVINCE ID

// SAVE PROFILE

const saveProfile = () => {
  const mobile = document.getElementById("mobile");
  const addr1 = document.getElementById("addr_1");
  const addr2 = document.getElementById("addr_2");
  const pcode = document.getElementById("pcode");
  const province = document.getElementById("province");
  const district = document.getElementById("district");
  const img_chooser = document.getElementById("profileimg");

  const f = new FormData();

  f.append("m", mobile.value);
  f.append("ad1", addr1.value);
  f.append("ad2", addr2.value);
  f.append("pc", pcode.value);
  f.append("pr", province.value);
  f.append("d", district.value);

  if (img_chooser.files.length == 0) {
  } else {
    f.append("image", img_chooser.files[0]);
  }

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let t = req.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  req.open("POST", "updateProfileProcess.php", true);
  req.send(f);
};

// ADMIN SIGN IN PROCESS

const adminSignIn = () => {
  const email = document.getElementById("email");
  const vcode = document.getElementById("vcode");

  const f = new FormData();

  f.append("e", email.value);
  f.append("vc", vcode.value);

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200 && req.status == 200) {
      let t = req.responseText;
      if (t == "success") {
        alert("Sign In successful");
        const spinner = document.getElementById("spinner");
        spinner.classList = "spinner-border d-block";
        setTimeout(() => {
          spinner.classList = "spinner-border d-none";
        }, 2000);
        window.location = "adminPanel.php";
      }
    }
  };

  req.open("POST", "middlewares/adminSignInProcess.php", true);
  req.send(f);
};

// SEND ADMIN CODE

const sendAdminCode = () => {
  const email = document.getElementById("email");
  console.log(email.value);

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let t = req.responseText;
      if (t == "success") {
        alert(
          "Verification code has been sent to your inbox, Please check your email!"
        );
        document.getElementById("vcode").removeAttribute("disabled");
        document.getElementById("btn").removeAttribute("disabled");
      } else {
        alert(t);
      }
    }
  };

  req.open(
    "GET",
    "middlewares/sendAdminCodeProcess.php?e=" + email.value,
    true
  );
  req.send();
};

// ADD A PHOTO FOR PAINT

const addPhoto2 = function () {
  const img = document.getElementById("img");
  const img_chooser = document.getElementById("paint_img");

  img_chooser.onchange = function () {
    file = this.files[0];
    url = window.URL.createObjectURL(file);

    img.src = url;
  };
};

// ADD NEW PAINT

const addNewPaint = () => {
  const title = document.getElementById("title");
  const category = document.getElementById("category");
  const des = document.getElementById("des");
  const artist_name = document.getElementById("artist_name");
  const delivery = document.getElementById("delivery");
  const price = document.getElementById("price");
  const img_chooser = document.getElementById("paint_img");
  const qty = document.getElementById("qty");

  const form = new FormData();

  form.append("t", title.value);
  form.append("c", category.value);
  form.append("price", price.value);
  form.append("des", des.value);
  form.append("an", artist_name.value);
  form.append("del", delivery.value);
  form.append("qty", qty.value);

  if (img_chooser.files.length != 0) {
    form.append("img", img_chooser.files[0]);
  }

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      let t = req.responseText;
      if (t == "success") {
        window.location.reload();
      }
      alert(t);
    }
  };

  req.open("POST", "middlewares/addNewPaintProcess.php", true);
  req.send(form);
};

function buyNow(id) {
  var id = id;
  var qty = document.getElementById("qty").value;

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      var t = req.responseText;
      var response = JSON.parse(t);
      if (t == "0") {
        alert("Please update the profile info");
      } else if (t == "-1") {
        alert("Please sign up first");
      } else {
        DirectPayCardPayment.init({
          container: "card_container", //<div id="card_container"></div>
          merchantId: response["merchant_id"], //your merchant_id
          amount: response["amount"],
          refCode: response["id"], //unique referance code form merchant
          currency: "LKR",
          type: "ONE_TIME_PAYMENT",
          customerEmail: response["email"],
          customerMobile: response["phone"],
          description: response["item"], //product or service description
          debug: true,
          responseCallback: responseCallback,
          errorCallback: errorCallback,
          logo: "https://test.com/directpay_logo.png",
          apiKey: response["api"],
        });

        email = response["email"];
        qty = response["qty"];

        //response callback.
        function responseCallback(result) {
          console.log("successCallback-Client", result);

          referenceId = result.data.reference;
          amount = result.data.amount;

          if (result.data.status != "FAILED") {
            saveInvoice(referenceId, id, email, amount, qty);
          } else {
            alert("Failed to preceed");
          }
        }

        //error callback
        function errorCallback(result) {
          console.log("successCallback-Client", result);
          alert(JSON.stringify(result));
        }
      }
    }
  };

  req.open(
    "GET",
    "middlewares/buyNowProcess.php?id=" + id + "&qty=" + qty,
    true
  );
  req.send();
}

function saveInvoice(referenceId, id, email, amount, qty) {
  var f = new FormData();

  f.append("rid", referenceId);
  f.append("id", id);
  f.append("email", email);
  f.append("amount", amount);
  f.append("qty", qty);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        setTimeout(() => {
          console.log("waiting");
        }, 5000);
        window.location = "review.php?id=" + id + "&e=" + email;
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "middlewares/saveInvoice.php", true);
  r.send(f);
}

function postReview(id, email) {
  var feedback = document.getElementById("message").value;
  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var t = req.responseText;
      if (t == "1") {
        alert("Thanks for the feedback");
        window.location = "invoice.php?id=" + id + "&e=" + email;
      }
    }
  };

  var form = new FormData();

  form.append("id", id);
  form.append("e", email);
  form.append("m", feedback);

  req.open("POST", "middlewares/saveReview.php", true);
  req.send(form);
}

function getPressedPaintId(cid) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("paints").innerHTML = t;
    }
  };

  r.open("GET", "middlewares/filterPaintProcess.php?cid=" + cid, true);
  r.send();
}
