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

$(document).ready(function () {

    $("#orientacion").change(function () {

        let id = $(this).val();

        let url = $(this).data("url");

        $.ajax({

            url: url,

            type: "GET",

            data: {
                id_orientacion: id
            },

            success: function (respuesta) {

                $("#tsenal").html(respuesta);

            }

        });

    });

});

$(document).ready(function () {

    function actualizarDireccion() {

        let tipo = $("#tipo_via").val();
        let n1 = $("#numero1").val();
        let c1 = $("#comp1").val();
        let q1 = $("#cuad1").val();
        let n2 = $("#numero2").val();
        let c2 = $("#comp2").val();
        let q2 = $("#cuad2").val();
        let n3 = $("#numero3").val();
        

        let direccion = "";

        if (tipo) direccion += tipo + " ";
        if (n1) direccion += n1 + " ";
        if (c1) direccion += c1 + " ";
        if (q1) direccion += q1 + " ";
        if (n2) direccion += "# " + n2 + " ";
        if (c2) direccion += c2 + " ";
        if (q2) direccion += q2 + " ";
        if (n3) direccion += "- " + n3;
    


        $("#direccionPreview").val(direccion.trim());
    }

    $(document).on(
        "keyup change",
        "#tipo_via,#numero1,#comp1,#cuad1,#numero2,#comp2,#cuad2,#numero3",
        actualizarDireccion
    );

});