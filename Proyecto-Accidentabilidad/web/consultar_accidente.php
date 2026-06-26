<?php
include_once '../../lib/helpers.php';
include_once '../../lib/conf/connection.php';

header('Content-Type: application/json');

$x = floatval($_GET['x'] ?? 0);
$y = floatval($_GET['y'] ?? 0);

if ($x == 0 || $y == 0) {
    echo json_encode(['encontrado' => false]);
    exit;
}

// Tolerancia en metros (sistema 3116). 500m es suficiente para clic en mapa
$tolerancia = 500;

$sql = "
    SELECT
        ra.id_reporte_acc,
        ra.fecha_accidente,
        ra.nomenclatura,
        ra.num_lesionados,
        ra.observaciones,
        ra.direccion,
        ra.imagen_url,
        e.nombre_estado AS estado,
        tc.nombre_tipo_choque AS tipo_choque,
        u.nombre || ' ' || u.apellido AS reportado_por,
        ST_Distance(
            ST_Transform(ra.coordenadas, 3116),
            ST_SetSRID(ST_MakePoint($x, $y), 3116)
        ) AS distancia
    FROM reporte_accidente ra
    LEFT JOIN estado e ON e.id_estado = ra.id_estado
    LEFT JOIN tipo_choque tc ON tc.id_tipo_choque = ra.id_tipo_choque
    LEFT JOIN usuarios u ON u.id = ra.id_usuario
    WHERE ra.coordenadas IS NOT NULL
      AND ST_Distance(
            ST_Transform(ra.coordenadas, 3116),
            ST_SetSRID(ST_MakePoint($x, $y), 3116)
          ) <= $tolerancia
    ORDER BY distancia ASC
    LIMIT 1
";

$result = pg_query($con, $sql);

if ($result && pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    echo json_encode([
        'encontrado'    => true,
        'id'            => $row['id_reporte_acc'],
        'fecha'         => $row['fecha_accidente'],
        'nomenclatura'  => $row['nomenclatura'],
        'lesionados'    => $row['num_lesionados'],
        'observaciones' => $row['observaciones'],
        'direccion'     => $row['direccion'],
        'imagen'        => $row['imagen_url'],
        'estado'        => $row['estado'],
        'tipo_choque'   => $row['tipo_choque'],
        'reportado_por' => $row['reportado_por'],
        'distancia'     => round($row['distancia'])
    ]);
} else {
    echo json_encode(['encontrado' => false]);
}
?>
