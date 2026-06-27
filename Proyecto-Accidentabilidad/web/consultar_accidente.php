<?php
include_once '../model/Mapa/mapaModel.php';

$obj = new MapaModel();
header('Content-Type: application/json'); // Se indica que la respuesta del archivo será en formato JSON.

$x = floatval(isset($_GET['x']) ? $_GET['x'] : 0);// Se reciben las coordenadas X y Y enviadas desde el mapa, si no llegan, se les asigna el valor 0.
$y = floatval(isset($_GET['y']) ? $_GET['y'] : 0);

if ($x == 0 || $y == 0) {
    echo json_encode(array(
    'encontrado' => false
    ));
}

$tolerancia = 1000;

// Consulta SQL para buscar el accidente más cercano a las coordenadas recibidas.
$sql = " 
    SELECT
        ra.id_reporte_acc,
        ra.fecha_accidente,
        ra.num_lesionados,
        ra.observaciones,
        ra.direccion,
        ra.imagen_url,
        e.nombre AS estado,
        tc.nombre AS tipo_choque,
        u.nombre || ' ' || u.apellido AS reportado_por,
        ST_Distance(
            ST_Transform(ra.coordenadas, 4326),
            ST_SetSRID(ST_MakePoint($x, $y), 4326)
        ) AS distancia
    FROM reporte_accidente ra
    LEFT JOIN estado e ON e.id_estado = ra.id_estado
    LEFT JOIN tipo_choque tc ON tc.id_tipo_choque = ra.id_tipo_choque
    LEFT JOIN usuarios u ON u.id = ra.id_usuario
    WHERE ra.coordenadas IS NOT NULL
      AND ST_Distance(
            ST_Transform(ra.coordenadas, 4326),
            ST_SetSRID(ST_MakePoint($x, $y), 4326)
          ) <= $tolerancia
    ORDER BY distancia ASC
    LIMIT 1
";

$result = $obj->select($sql);

if ($result && pg_num_rows($result) > 0) { // Se verifica si la consulta encontró algún accidente.
    $row = pg_fetch_assoc($result);  // Se obtiene el primer registro encontrado.
    echo json_encode(array( // Se devuelve toda la información del accidente en formato JSON.
        'encontrado'    => true,
        'id'            => $row['id_reporte_acc'],
        'fecha'         => $row['fecha_accidente'],
        'lesionados'    => $row['num_lesionados'],
        'observaciones' => $row['observaciones'],
        'direccion'     => $row['direccion'],
        'imagen'        => $row['imagen_url'],
        'estado'        => $row['estado'],
        'tipo_choque'   => $row['tipo_choque'],
        'reportado_por' => $row['reportado_por'],
        'distancia'     => round($row['distancia'])
    ));
} else {
    echo json_encode(array('encontrado' => false));
}
?>