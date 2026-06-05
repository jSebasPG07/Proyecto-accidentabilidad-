<?php 
    session_start();
    function redirect($url){
        echo "<script>";
            echo "window.location.href='$url'";
        echo "</script>";
    }


    function dd($var){
        echo "<pre>";
        die(print_r($var));
    }
    function getUrl($modulo, $controlador, $funcion, $parametros = false, $pagina = false){
        if($pagina == false){
            $pagina = "index";
        }
        $url = "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";

        if($parametros != false){
            foreach($parametros as $key => $value){
                $url.="&$key=$value";

            }
        }
        return $url;
    }

    function resolver(){
        $modulo = ucwords($_GET['modulo']); //modulo -> carpeta dentro del controller
        $controlador = ucwords($_GET['controlador']); // archivo dentro de modulo
        $funcion = $_GET['funcion']; // funcion - metodo dentro de la clase del controlador

        //toda ruta empiza desde index.php -> carpeta web

        if(is_dir("../controller/$modulo")){
            if(is_file("../controller/$modulo/".$controlador."Controller.php")){
                
                include_once "../controller/$modulo/$controlador"."Controller.php";
                $nombreClase = $controlador."Controller";
                $objeto = new $nombreClase();

                if(method_exists($objeto, $funcion)){
                    $objeto -> $funcion();
                }else{
                    echo "<br><b>Intentando buscar en:</b> ../controller/$modulo/".$controlador."Controller.php<br>";

                    echo "la funcion especifica no exixte";
                }
            }else{
                echo "el controlador especificado no existe";
            }


        }else{
            echo "el modulo especificado no existe";
        }


    }

?>