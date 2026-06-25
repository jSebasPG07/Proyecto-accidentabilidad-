<script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

<script src="../web/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script>
		<?php if(isset($_GET['msg']) && $_GET['msg'] == 'ok'){ ?>
      swal("Bien hecho", "Registro guardado correctamente", "success");
    <?php } ?>
  
    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'error'){ ?>
      swal("Error", "No se pudo guardar el registro", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'imgerror'){ ?>
      swal("Error", "No se pudo subir la imagen", "error");
    <?php } ?>

    <?php if($_GET['msg'] == 'numero1_formato'){ ?>
      swal("Error", "El numero de vía debe contener entre 1 y 3 dígitos y opcionalmente una letra al final. Ej: 1A, 25, 80B", "error");
    <?php } ?>

    <?php if($_GET['msg'] == 'numero2_formato'){ ?>
      swal("Error", "El numero después del # debe contener entre 1 y 3 dígitos y opcionalmente una letra al final. Ej: 49, 80A", "error");
    <?php } ?>

    <?php if($_GET['msg'] == 'numero3_formato'){ ?>
      swal("Error", "El numero del predio debe contener entre 1 y 3 dígitos", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'obs_largo'){ ?>
      swal("Error", "Las observaciones no pueden superar los 200 caracteres", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'obs_formato'){ ?>
      swal("Error", "Las observaciones tienen caracteres no validos", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'obs_letra'){ ?>
      swal("Error", "Las observaciones deben contener solo letras", "error");
    <?php } ?>

    <?php if($_GET['msg'] == 'obs_palabras'){ ?>
      swal("Error", "Las observaciones deben contener al menos 2 palabras", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'desc_largo'){ ?>
      swal("Error", "Las descripciones no pueden superar los 200 caracteres", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'desc_formato'){ ?>
      swal("Error", "Las descripciones tienen caracteres no validos", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'desc_letra'){ ?>
      swal("Error", "Las descripciones deben contener solo letras", "error");
    <?php } ?>


    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'ref_largo'){ ?>
      swal("Error", "El lugar de referencia no pueden superar los 200 caracteres", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'ref_formato'){ ?>
      swal("Error", "El lugar de referencia tienen caracteres no validos", "error");
    <?php } ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'ref_letra'){ ?>
      swal("Error", "El lugar de referencia deben contener solo letras", "error");
    <?php } ?>

    <?php if($_GET['msg'] == 'ref_palabras'){ ?>
      swal("Error", "El lugar de referencia deben contener al menos 2 palabras", "error");
    <?php } ?>

    <?php if($_GET['msg'] == 'tipoimg'){ ?>
      swal("Error", "Solo se permiten imagenes JPG o PNG", "error");
    <?php } ?>


	</script>
  
	<script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="../web/js/global.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/js/kaiadmin.min.js"></script>
  
  <script src="assets/prism.js"></script>
  <script src="assets/prism-normalize-whitespace.min.js"></script>
  <script type="text/javascript">
  
    // Optional
    Prism.plugins.NormalizeWhitespace.setDefaults({
      "remove-trailing": true,
      "remove-indent": true,
      "left-trim": true,
      "right-trim": true,
    });

    // handle links with @href started with '#' only
    $(document).on("click", 'a[href^="#"]:not([data-bs-toggle="collapse"])', function (e) {
      // target element id
      var id = $(this).attr("href");

      // target element
      var $id = $(id);
      if ($id.length === 0) {
        return;
      }

      // prevent standard hash navigation (avoid blinking in IE)
      e.preventDefault();

      // top position relative to the document
      var pos = $id.offset().top - 80;

      // animated top scrolling
      $("body, html").animate({ scrollTop: pos });
    });
  </script>