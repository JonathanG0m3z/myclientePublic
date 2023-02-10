$(document).ready(function () {
  var consulta;
  var timer;
   $("#nombrec").focus();

  //comprobamos si se pulsa una tecla
  $("#nombrec").keyup(function (e) {
        clearTimeout(timer);
        timer = setTimeout(soliajax, 1250);
  });
    function soliajax() {
          consulta = $("#nombrec").val();
          $.ajax({
                type: "POST",
                url: "buscarcliente.php",
                data: "b=" + consulta,
                dataType: "html",
                error: function () {
                      //alert("error petición ajax");
                },
                success: function (data) {

                      $("#divcliente").empty();
                      $("#divcliente").append(data);

                }
          });
    }

});

$(document).ready(function () {
  var consulta;
  var timer;
   $("#cuenta").focus();

  //comprobamos si se pulsa una tecla
  $("#cuenta").keyup(function (e) {
        clearTimeout(timer);
        timer = setTimeout(soliajax, 1500);
  });
    function soliajax() {
          consulta = $("#cuenta").val();
          $.ajax({
                type: "POST",
                url: "buscarcuenta.php",
                data: "b=" + consulta,
                dataType: "html",
                error: function () {
                      //alert("error petición ajax");
                },
                success: function (data) {

                      $("#divcuenta").empty();
                      $("#divcuenta").append(data);

                }
          });
    }

});