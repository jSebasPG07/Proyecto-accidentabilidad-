<?php

include_once "../lib/helpers.php";
include_once "../lib/Permisos.php";

$moduloPorControlador = array(
    'ReportesA' => 2,
    'ReportesNS' => 2,
    'ReportesSME' => 2,
    'ReportesSolicitudNR' => 2,
    'ReportesRME' => 2,
    'SolicitudVME' => 2,
    'MiHistorial' => 3,
    'ManualU' => 4,
    'ManualS' => 4,
    'ZonaMayAccidentabilidad' => 6,
    'GestionUsuario' => 7,
);


echo "<!DOCTYPE html>";
echo "<html lang='es'>";

include '../view/partials/head.php';

echo "<body>";
echo "<div class='wrapper'>";


include_once '../view/partials/menu.php';

echo "<div class='main-panel'>";


include_once '../view/partials/navbar.php';


echo "<div class='content' style='min-height: 750px; position: relative;'>";
if (!isset($_SESSION['auth']) || $_SESSION['auth'] != "ok") {
  redirect("login.php");
}


if (isset($_GET['modulo'])) {
    $controlador = isset($_GET['controlador']) ? ucwords($_GET['controlador']) : '';
    if (isset($moduloPorControlador[$controlador])) {
        $idModulo = $moduloPorControlador[$controlador];
        if (!Permisos::hasModule($idModulo)) {
            echo "<div class='alert alert-danger m-4'>";
            echo "<h4>Acceso denegado</h4>";
            echo "<p>No tienes permiso para acceder a este modulo.</p>";
            echo "</div>";
        } else {
            resolver();
        }
    } else {
        resolver();
    }
} else {
    include_once '../view/partials/contenido.php';
}
echo "</div>";




//include_once '../view/partials/footer.php';
echo "</div>";

echo "</div>";

include_once '../view/partials/script.php';
echo "</body>";

echo "</html>";
