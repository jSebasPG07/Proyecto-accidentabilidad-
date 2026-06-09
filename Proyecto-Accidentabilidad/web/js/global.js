$(document).ready(function () {

    console.log("READY OK");

    $(document).on("change", "#filtro", function () {

        let tipo = $(this).val();
        let url = $(this).attr("data-url");

        console.log("TIPO:", tipo);

        $.ajax({
            url: url,
            type: "GET",
            data: { tipo: tipo },

            success: function (data) {
                console.log("RESPUESTA:", data);
                $("#resultado").html(data);
            }
        });

    });

    // carga automática
    $("#filtro").trigger("change");

});