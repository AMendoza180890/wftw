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

            $("#tMedioValue").val(response["tipoMedio"]);
            $("#tMedioValue").html(response["tipoMedio"]);

            $("#eMedioValue").val(response["estadoMedio"]);
            $("#eMedioValue").html(response["estadoMedio"]);

            $("#nApoyoValue").val(response["apoyoMedio"]);
            $("#nApoyoValue").html(response["apoyoMedio"]);

            // file and img
            $("#fotoActual").val(response["foto"]);
            if (response["foto"] != "") {
                $(".visor").attr("src", response["foto"]);
            } else {
                $(".visor").attr("src", "app/vista/img/beneficiario/defecto.png");
            }

            calEdad("fnacimientoEdit", "edadEdit");
        },
        error: function(request) {
            console.log(request.responseText);
        },
    });
});

//dar de baja al beneficiario
$(".desactivarRegistroBeneficiario").click(function() {
    let codigo = $(this).attr("codValor");
    window.location = "index.php?ruta=catbeneficiario&CodValor=" + codigo;
    console.log("valor en js " + codigo);
});

//dar de alta al beneficiario
$(".activarBeneficiario").click(function() {
    let codigo = $(this).attr("codValor");
    window.location = "index.php?ruta=catbeneficiarioBaja&CodValor=" + codigo;
    console.log("valor en js " + codigo);
});

//mostrar la edad cuando cambie la fecha de nacimento cuando se ingrese el beneficiario
$("#fnacimiento").change(function() {
    calEdad("fnacimiento", "edad");
});

//mostrar la edad cuando cambie la fecha de nacimiento cuando se edite el beneficiario.
$("#fnacimientoEdit").change(function() {
    calEdad("fnacimientoEdit", "edadEdit");
});

// calcular edad.
function calEdad(idEntrada, idSalida) {
    let simbol = "#";
    let entrada = simbol.concat(idEntrada);
    let salida = simbol.concat(idSalida);

    let dob = $(entrada).val();
    dob = new Date(dob);
    let today = new Date();
    let age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
    $(salida).val(age + " Años");
}