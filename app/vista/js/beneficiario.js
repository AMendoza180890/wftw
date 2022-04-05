$(".editarRegistroBeneficiario").click(function () {
  let codBeneficiario = $(this).attr("codValor");
  let paramClaveValor = new FormData();

  paramClaveValor.append("id", codBeneficiario);

  $.ajax({
    url: "app/Ajax/beneficiarioA.php",
    method: "POST",
    data: paramClaveValor,
    cache: false,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      console.log(response);
    },
    error: function (request) {
      console.log(request.responseText);
    },
  });
});
