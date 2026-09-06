$(".editarRegistroBeneficiario").click(function() {
    let codBeneficiario = $(this).attr("codValor");
    let paramClaveValor = new FormData();

    paramClaveValor.append("id", codBeneficiario);
    paramClaveValor.append("csrf_token", window.WFTW_CSRF);

    $.ajax({
        url: "app/Ajax/beneficiarioA.php",
        method: "POST",
        data: paramClaveValor,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(response) {
            $("#idedit").val(response["id"]);
            $("#nombreApelidoEdit").val(response["nombreApellido"]);
            $("#fnacimientoEdit").val(response["fnacimiento"]);
            $("#direccionEdit").val(response["direccion"]);
            $("#celularEdit").val(response["celular"]);
            $("#telefonoEdit").val(response["telefono"]);
            $("#referidoEdit").val(response["referencia"]);
            $("#tutornombreEdit").val(response["nombreTutor"]);
            $("#tutorcedulaEdit").val(response["cedula"]);

            $("#diagnosticoEdit").val(response["diagnostico"]);
            $("#tMedioEdit").val(response["tipoMedio"]);
            $("#eMedioEdit").val(response["estadoMedio"]);
            $("#nApoyoEdit").val(response["apoyoMedio"]);
            $("#tutorparentescoEdit").val(response["parentesco"]);
            $("#institucionEdit").val(response["institucion"]);

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

$(".desactivarRegistroBeneficiario").click(function() {
    let codigo = $(this).attr("codValor");
    $.post("index.php?ruta=catbeneficiario", {
        CodValor: codigo,
        csrf_token: window.WFTW_CSRF
    }).always(function() {
        window.location = "catbeneficiario";
    });
});

$(".activarBeneficiario").click(function() {
    let codigo = $(this).attr("codValor");
    $.post("index.php?ruta=catbeneficiarioBaja", {
        CodValor: codigo,
        csrf_token: window.WFTW_CSRF
    }).always(function() {
        window.location = "catbeneficiarioBaja";
    });
});

$(".beneficiarioAtendido").click(function() {
    let codigo = $(this).attr("CodValorAtendido");
    $.post("index.php?ruta=catbeneficiario", {
        CodValorAtendido: codigo,
        csrf_token: window.WFTW_CSRF
    }).done(function() {
        // Marcado como atendido: descargar/abrir el reporte de entrega.
        let url = "app/controlador/reporteBeneficiario.php?codValor=" + encodeURIComponent(codigo);
        let enlace = document.createElement("a");
        enlace.href = url;
        document.body.appendChild(enlace);
        enlace.click();
        enlace.remove();
    }).always(function() {
        window.location = "catbeneficiario";
    });
});

$("#fnacimiento").change(function() {
    calEdad("fnacimiento", "edad");
});

$("#fnacimientoEdit").change(function() {
    calEdad("fnacimientoEdit", "edadEdit");
});

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
