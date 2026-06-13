<?php


include_once "../model/Estadisticas/ZonaMayAccidentabilidadModel.php";

class ZonaMayAccidentabilidadController{


    public function getList(){

        $obj = new ZonaMayAccidentabilidadModel();

        //Consulta hecha para el total de los accidentes
        $sql = "SELECT COUNT(*) as total_accidentes FROM reporte_accidente";
        $reporte = $obj->select($sql);
        $row = pg_fetch_assoc($reporte);
        $totalAcc = $row['total_accidentes'];

        // Consulta hecha para sacar el TOtal de LESIONADOS
        //El COALESCE lo estoy usando por si no hay lesionados en la vista, mostraria null, entonces al hacer el coalesce en la vista muestra el 0
        $sql = "SELECT COALESCE(SUM(num_lesionados),0) as total_lesionados 
                 FROM reporte_accidente";
        $reporte = $obj->select($sql);
        $row = pg_fetch_assoc($reporte);
        $totalLes = $row['total_lesionados'];

        // Consulta hecha para sacar el mes con ACCIDENTES
        // El TO_CHAR convierte la fecha en el nombre del mes y ps la consulta completa muestra el mes donde hubo mas accidentes  
        $sql = "SELECT TO_CHAR(fecha_accidente, 'Mon') as mes, COUNT(*) as cantidad
                FROM reporte_accidente
                GROUP BY TO_CHAR(fecha_accidente, 'Mon')
                ORDER BY cantidad DESC
                LIMIT 1";
        $reporte = $obj->select($sql);
        $row = pg_fetch_assoc($reporte);
        $mesTop = $row ? $row['mes'] : "N/A";

        // caso de estados pendiente
        $sql = "SELECT COUNT(*) as pendientes 
                 FROM reporte_accidente 
                 WHERE id_estado = 3";
        $reporte = $obj->select($sql);
        $row = pg_fetch_assoc($reporte);
        $pendientes = $row['pendientes'];


        // Para las usamos la nomenclatura
        // esta consulta muestra la zona los cuenta cuantos accidentes hubieron en esa zona y muestra cuantos lesionados hubieron, todo lo muestra de mayor a menor 
        $sql = "SELECT 
                    nomenclatura AS zona,
                    COUNT(*) as accidentes,
                    COALESCE(SUM(num_lesionados),0) as lesionados
                 FROM reporte_accidente
                 GROUP BY nomenclatura
                 ORDER BY accidentes DESC
                 LIMIT 5";
        $reporte = $obj->select($sql);

        $zonas = array();

        //Va recorrer los resultados de la base de datos fila porf fila 
        //el row va mostrar digamos la zona los accidentes  y los lesionados de la bd 
        while($row = pg_fetch_assoc($reporte)){

            //aqui ps es el nivel de riesgo digamos por ejemplo que si hay 10 accidentes ps va ser alto, si hay 3 acccidentes es medio y si hay 1 bajo 
            if($row['accidentes'] >= 5){
                $row['riesgo'] = "Alto";
                $row['color'] = "danger";
            }elseif($row['accidentes'] >= 3){
                $row['riesgo'] = "Medio";
                $row['color'] = "warning";
            }else{
                $row['riesgo'] = "Bajo";
                $row['color'] = "success";
            }


            //aqui se guarda todo dentro del array osea todo lo que hizo el row lo guarda ahi 
            $zonas[] = $row;

        }

        include_once '../view/Estadisticas/ZonaMayAccidentabilidadView.php';
    }

    
    public function exportarExcel(){

        require_once '../lib/PHPExcel/Classes/PHPExcel.php';


        $obj = new ZonaMayAccidentabilidadModel();

        $sql = "SELECT 
                    nomenclatura AS zona,
                    COUNT(*) as accidentes,
                    COALESCE(SUM(num_lesionados),0) as lesionados
                FROM reporte_accidente
                GROUP BY nomenclatura
                ORDER BY accidentes DESC";

        $zonas = $obj->select($sql);

        $excel = new PHPExcel();
        $excel->getProperties()->setCreator("GIAV")
                           ->setTitle("Reporte de Accidentabilidad");

        $sheet = $excel->setActiveSheetIndex(0);
        
        
        //Esta parte son los encabezados de la  tabla en excel
        $sheet->setCellValue('A1', 'Zona');
        $sheet->setCellValue('B1', 'Accidentes');
        $sheet->setCellValue('C1', 'Lesionados');

        //Este es para colocarle negrita
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);

        $fila = 2;
        

        while($row = pg_fetch_assoc($zonas)){
            $sheet->setCellValue('A'.$fila, $row['zona']);
            $sheet->setCellValue('B'.$fila, $row['accidentes']);
            $sheet->setCellValue('C'.$fila, $row['lesionados']);
            $fila++;
        }

        foreach(range('A','C') as $col){
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        

        header("Content-Type: application/vnd.ms-excel");  //esta linea se puso para avisarle al navegador que es un archivo excel 
        header("Content-Disposition: attachment; filename=zonas_accidentabilidad.xls");  // esta linea lo que hace es que a la hora de descargarlo lo hace con el nombre de zonas_accidentabilidad.xls
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $writer->save('php://output');
        
        exit;
    }

}