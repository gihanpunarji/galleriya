const addPaint = () => {
  window.location = "addPaint.php";
};

function signoutAdmin() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      }
    }
  };

  r.open("GET", "middlewares/signOutAdmin.php", true);
  r.send();
}
// function getId() {
//   document.addEventListener("DOMContentLoaded", function () {
//     var form = document.querySelector("#myform");
//     var submitButton = document.querySelector("#submit-btn");
//     var resultDiv = document.querySelector("#result");

//     submitButton.addEventListener("click", function (event) {
//       event.preventDefault(); // Prevent default button behavior

//       // Create new FormData object from form data
//       var formData = new FormData(form);

//       // Send form data to server using AJAX
//       var xhr = new XMLHttpRequest();
//       xhr.open("POST", ""); // Use current page URL to submit form data
//       xhr.onload = function () {
//         if (xhr.status === 200) {
//           // Handle response from server
//           resultDiv.innerHTML = "Selected option is: " + xhr.responseText;
//         }
//       };
//       xhr.send(formData);
//     });
//   });
// }

// getId();

function addStock(id) {
  var stock = document.getElementById("stock").value;
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText == "Added Succesfully") {
        window.location.reload();
      }
    }
  };

  xhr.open("GET", "middlewares/addStock.php?q=" + stock + "&id=" + id, true);
  xhr.send();
}
