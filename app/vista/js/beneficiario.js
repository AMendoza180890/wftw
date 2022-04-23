$(".editarRegistroBeneficiario").click(function() {
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
        success: function(response) {
            //input text
            console.log(response);
            $("#idedit").val(response["id"]);
            $("#nombreApelidoEdit").val(response["nombreApellido"]);
            $("#fnacimientoEdit").val(response["fnacimiento"]);
            $("#direccionEdit").val(response["direccion"]);
            $("#celularEdit").val(response["celular"]);
            $("#telefonoEdit").val(response["telefono"]);
            $("#referidoEdit").val(response["referencia"]);
            $("#tutornombreEdit").val(response["nombreTutor"]);
            $("#tutorcedulaEdit").val(response["cedula"]);

            //select options
            $("#diagValor").val(response["diagnostico"]);
            $("#diagValor").html(response["diagnostico"]);

            $("#tutorValor").val(response["parentesco"]);
            $("#tutorValor").html(response["parentesco"]);

            // file and img
            $("#fotoActual").val(response["foto"]);
            if (response["foto"] != "") {
                $(".visor").attr("src", response["foto"]);
            } else {
                $(".visor").attr("src", "app/vista/img/beneficiario/defecto.png");
            }
        },
        error: function(request) {
            console.log(request.responseText);
        },
    });
});


$(".DesactivarRegistroBeneficiario").click(function() {
    let codigo = $(this).attr("codValor");
    window.location = "index.php?ruta=catbeneficiario&CodValor=" + codigo;
    console.log("valor en js " + codigo);

});