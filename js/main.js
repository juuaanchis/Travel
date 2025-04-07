$(document).ready(function () {
  $("#loginForm").submit(function (event) {
      event.preventDefault();

      // Obtener los valores de los campos de entrada
      var email = $.trim($('input[name="email"]').val());
      var password = $.trim($('input[name="password"]').val());

      // Sanitizar datos antes de enviarlos
      password = encodeURIComponent(password);

      loginUser(email, password);
  });
});

function loginUser(email, password) {
  $.ajax({
      url: "./backend/login.php",
      method: "POST",
      data: { email: email, password: password },
      dataType: "json",
      success: function (response) {
          console.log("Respuesta nuevo user");
          console.log(response);

          if (response.status === "success") {
              window.location.href = "views/index.php";
          } else if (response.status === "error") {
              if (response.message === "El usuario está inactivo") {
                  // Usuario inactivo
              } else {
                  console.log("Error: " + response.message);
                  $('input[name="email"]').val("");
                  $('input[name="password"]').val("");
              }
          } else {
              console.log("Otro error");
              $("#result").html("<p>Error in AJAX call</p>");
          }
      },
  });
}
