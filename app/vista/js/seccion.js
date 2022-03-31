// funcion para obtener registros por ajax
$(".TablaUsuario").on("click", ".EditRegistroseccion", function() {
    let codValor = $(this).attr("codValor");
    let datos = new FormData();
    datos.append("id", codValor);

    $.ajax({
        method: "POST",
        url: "Ajax/seccionA.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response) {
            $("#idEdit").val(response["id"]);
            $("#tituloEdit").val(response["titulo"]);
            $("#descripCortaEdit").val(response["descripcionCorta"]);
            $("#descripLargaEdit").val(response["descripcionLarga"]);
            $("#urlEdit").val(response["enlace"]);
            $("#cantidadEdit").val(response["cantidad"]);
            $("#costoEdit").val(response["costo"]);

            $("#estadoEdit").html(response["descripcion"]);
            $("#estadoEdit").val(response["estadoid"]);

            $("#fotoActual").val(response["imagen"]);
            if (response["foto"] != "") {
                $(".visor").attr("src", response["imagen"]);
            } else {
                $(".visor").attr("src", "vista/img/usuario/defecto.png");
            }
            console.log("response: " + response);
        }
    });
});

// funcion para desactivar registro por GET
$(".TablaUsuario").on("click", ".DesactivarRegistroseccion", function() {
    let codValor = $(this).attr("codValor");
    window.location = "index.php?ruta=catseccion&CodValor=" + codValor;
    console.log("valor en js " + codValor);
})