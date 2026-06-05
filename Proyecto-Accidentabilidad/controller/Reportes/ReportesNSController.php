<?php

    include_once "../model/Reportes/ReportesNSModel.php";

    class ReportesNSController{
        public function getCreate(){
            $obj = new ReportesNSModel();
            include_once "../view/Reportes/ReportesNSView.php";
        }
        
    }
?>