$(".TablaUsuario").on("click", ".EditRegistroUsuario", function() {
    let codValor = $(this).attr("codValor");
    let datos = new FormData();
    datos.append("id", codValor);
    datos.append("csrf_token", window.WFTW_CSRF);

    $.ajax({
        method: "POST",
        url: "app/Ajax/usuarioA.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response) {
            $("#idEdit").val(response["id"]);
            $("#usuarioEdit").val(response["usuario"]);
            $("#claveEdit").val("");
            $("#rolEdit").val(response["rolid"]);
            $("#fotoActual").val(response["foto"]);

            if (response["foto"] != "") {
                $(".visor").attr("src", response["foto"]);
            } else {
                $(".visor").attr("src", "app/vista/img/usuario/defecto.png");
            }
        }
    });
});

$(".TablaUsuario").on("click", ".DesactivarRegistroUsuario", function() {
    let codValor = $(this).attr("codValor");

    $.post("index.php?ruta=catusuarios", {
        CodValor: codValor,
        csrf_token: window.WFTW_CSRF
    }).always(function() {
        window.location = "catusuarios";
    });
});
