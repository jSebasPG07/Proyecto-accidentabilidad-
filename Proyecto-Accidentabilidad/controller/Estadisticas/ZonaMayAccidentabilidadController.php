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

        $excel = new PHPExcel(); //esta linea hace saber de que se va crear un archivo excel desde 0
        $excel->getProperties()// las propiedades del archivo
                ->setCreator("Sebastian") //esta linea es para decir quien es el autor  
                ->setTitle("Reporte de Accidentabilidad"); //esta linea el titulo

        $sheet = $excel->setActiveSheetIndex(0); //esta linea lo que hace es decir que se va trabajar en la hoia 1 del archivo 

        //TITULO PRINCIPAL
        $sheet->mergeCells('A1:C1'); //Esta linea lo que hace es unir las celdas A1,B1,C1 para poner el reporte de accidentabilidad 
        $sheet->setCellValue('A1', 'REPORTE DE ACCIDENTABILIDAD'); //aqui se escribe el texto osea es como uno dar click en la celda y escribir

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14); //Esto hace que el texto tenga negrita y que el tamaño sea de 14 
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //esto centra el texto

        //ENCABEZADOS
        $sheet->setCellValue('A3', 'Zona'); //Este crea el titulo de  la celda A3
        $sheet->setCellValue('B3', 'Accidentes'); //Este crea el titulo de  la celda b3
        $sheet->setCellValue('C3', 'Lesionados'); //Este crea el titulo de  la celda C3

        
        $sheet->getStyle('A3:C3')->getFont()->setBold(true); //Este le pone negrita a los titulos

        $sheet->getStyle('A3:C3')->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()->setRGB('D9D9D9');    //Todo el bloque lo que hace es ponerle color a los fondos de las celdas de los titulos creados arriba
                                                        //El color D9D9D9 es gris entonces se ponen gris los fondos    

        //aqui lo que hace es que los datos se muestran desde la fila 4
        $fila = 4;
        $inicioTabla = 4;

        //Esto llena fila por fila con los datos de la base de datos
        while($row = pg_fetch_assoc($zonas)){
            $sheet->setCellValue('A'.$fila, $row['zona']);
            $sheet->setCellValue('B'.$fila, $row['accidentes']);
            $sheet->setCellValue('C'.$fila, $row['lesionados']);
            $fila++;
        }

        $finTabla = $fila - 1; //Esta guarda cual fue la ultima fila donde se puso datos

        //Esto aqui es para poner los bordes finos en la tabla
        //Es como hacerlo uno mismo manual que uno selecciona toda la tabla y le da Todos los bordes 
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
            ),
        );

        $sheet->getStyle('A3:C'.$finTabla)->applyFromArray($styleArray); //Esta lo que hace es que aplica esos bordes desde la 
                                                                        //A3 hasta la ultima fila

        //TOTAL
        $sheet->setCellValue('A'.$fila, 'TOTAL'); //Esta linea lo que hace es escribir la palabra TOTAL en la ultima fila
        $sheet->setCellValue('B'.$fila, '=SUM(B4:B'.$finTabla.')'); //Esto lo que hace es una suma de todos los acccidentes de la BD
        $sheet->setCellValue('C'.$fila, '=SUM(C4:C'.$finTabla.')'); //Esto hace lo mismo pero en este caso va ser con los lesionados

        $sheet->getStyle('A'.$fila.':C'.$fila)->getFont()->setBold(true); //Esta pone toda la fina en negrita 

        
        foreach(range('A','C') as $col){ //reccore cada columna 
            $sheet->getColumnDimension($col)->setAutoSize(true); //Aqui ajusta el ancho de cada columna
        }

        //ALINEAR NÚMEROS
        $sheet->getStyle('B4:C'.$finTabla) //Esta selecciona el rango de donde empiezan los datos en este caso seria desde B4 hasta donde termine c
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //Esta centra el contenido
        

        header("Content-Type: application/vnd.ms-excel"); //esta linea se puso para avisarle al navegador que es un archivo excel 
        header("Content-Disposition: attachment; filename=zonas_accidentabilidad.xls");  // esta linea lo que hace es que a la hora de descargarlo lo hace con el nombre de zonas_accidentabilidad.xls
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $writer->save('php://output');
        
        exit;
    }

}