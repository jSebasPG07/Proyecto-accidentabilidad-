<?php

include_once "../lib/helpers.php";

echo "<!DOCTYPE html>";
echo "<html lang='es'>";

include '../view/partials/head.php';

echo "<body>";
echo "<div class='wrapper'>";


include_once '../view/partials/menu.php';

echo "<div class='main-panel'>";


include_once '../view/partials/navbar.php';


echo "<div class='content'>";
if (!isset($_SESSION['auth']) || $_SESSION['auth'] != "ok") {
  redirect("login.php");
}
if (isset($_GET['modulo'])) {
  resolver();
}
//include_once '../view/partials/contenido.php'; 
echo "</div>";


include_once '../view/partials/footer.php';

echo "</div>";

echo "</div>";
include_once '../view/partials/script.php';
echo "</body>";

echo "</html>";
