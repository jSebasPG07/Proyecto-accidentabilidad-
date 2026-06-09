$(document).ready(function () {

    $(document).on("change", "#filtro", function () {

        let tipo = $(this).val();
        let url = $(this).attr("data-url");

        $.ajax({
            url: url,
            type: "GET",
            data: { tipo: tipo },

            success: function (data) {
                $("#resultado").html(data);
            }
        });

    });

    $("#filtro").trigger("change");

});