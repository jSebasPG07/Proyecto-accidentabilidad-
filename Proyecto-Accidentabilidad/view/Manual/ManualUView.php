<?php
/**
 * Vista: Manual de Usuario
 * Modulo: Manual (GIAV)
 * PHP compatible con versiones antiguas (sin [], sin <?=)
 */

$secciones = array(
    array(
        'titulo'    => 'A. Bienvenida a GIAV',
        'tipo'      => 'parrafos',
        'contenido' => array(
            'GIAV (Geovisor Inteligente de Accidentalidad Vial) es una plataforma colaborativa que permite a la comunidad reportar accidentes de transito, problemas de infraestructura vial y hacer seguimiento a sus solicitudes ante las autoridades competentes.',
            'Este manual te explica paso a paso como usar cada modulo de la plataforma.',
        ),
    ),

    array(
        'titulo'    => 'B. Crear y gestionar tu cuenta',
        'tipo'      => 'pasos',
        'contenido' => array(
            'Registrate con tu correo electronico y crea una contrasena segura desde la pantalla de registro.',
            'Inicia sesion desde la pantalla principal con tus credenciales.',
            'En "Gestion de Usuarios" puedes actualizar tus datos de contacto y consultar tu informacion de cuenta.',
        ),
    ),

    array(
        'titulo'    => 'C. Modulo de Reportes',
        'tipo'      => 'pasos',
        'contenido' => array(
            'Ingresa al modulo "Mapa" para visualizar los reportes de accidentalidad vial cercanos a tu ubicacion.',
            'En "Reportes - Nuevo reporte" puedes registrar un accidente: selecciona el tipo de choque, los vehiculos involucrados, la ubicacion en el mapa y agrega una descripcion.',
            'Tambien puedes generar solicitudes de senalizacion: reportar senal en mal estado, solicitar nueva senal, reportar reductor en mal estado, solicitar nuevo reductor o reportar via en mal estado.',
            'Adjunta evidencia fotografica cuando este disponible para agilizar la validacion.',
        ),
    ),

    array(
        'titulo'    => 'D. Historial de Reportes',
        'tipo'      => 'parrafos',
        'contenido' => array(
            'En "Historial Reportes - Mi historial" puedes consultar todos los reportes y solicitudes que has registrado, junto con su estado actual.',
            'Los estados posibles son: <strong>Pendiente</strong>, <strong>En revision</strong>, <strong>En proceso</strong>, <strong>Completada</strong> o <strong>Rechazada</strong>.',
        ),
    ),

    array(
        'titulo'    => 'E. Manual de Senalizacion',
        'tipo'      => 'parrafos',
        'contenido' => array(
            'En "Manual - Manual senalizacion" encontraras el catalogo completo de senales viales (reglamentarias, informativas y preventivas) tomado del Manual de Senalizacion Vial de Colombia 2024.',
            'La seccion E del manual contiene los enlaces directos a cada formulario de solicitud (senal danada, nueva senal, reductor danado, nuevo reductor, via en mal estado).',
        ),
    ),

    array(
        'titulo'    => 'F. Visualizar Reportes y PQRSF',
        'tipo'      => 'parrafos',
        'contenido' => array(
            'El modulo "Visualizar Reportes" permite consultar los reportes ciudadanos registrados en la plataforma.',
            'Desde el modulo PQRSF puedes radicar Peticiones, Quejas, Reclamos, Sugerencias y Felicitaciones relacionadas con el servicio o con la infraestructura vial. Cada PQRSF queda asociada a tu usuario y puedes hacerle seguimiento desde tu historial.',
        ),
    ),

    array(
        'titulo'    => 'G. Estadisticas',
        'tipo'      => 'parrafos',
        'contenido' => array(
            '<strong>Zona de Mayor Accidentabilidad:</strong> identifica los puntos criticos de la via con mayor concentracion de siniestros viales, mediante graficas y mapas de calor.',
            '<strong>Trazabilidad:</strong> permite hacer seguimiento historico a los reportes y solicitudes, filtrando por fecha, tipo, estado y sector.',
        ),
    ),

    array(
        'titulo'    => 'H. Preguntas frecuentes',
        'tipo'      => 'faq',
        'contenido' => array(
            array('p' => 'Como se el estado de mi reporte o solicitud?',         'r' => 'Ingresa a "Historial Reportes - Mi historial" y revisa la columna de estado.'),
            array('p' => 'Puedo editar una solicitud despues de enviarla?',       'r' => 'No. Si necesitas corregir informacion, comunicate con soporte a traves del modulo PQRSF.'),
            array('p' => 'La senal que quiero reportar no aparece en el catalogo?','r' => 'Selecciona la mas parecida y agrega el detalle en el campo de descripcion del formulario.'),
            array('p' => 'Puedo adjuntar mas de una foto?',                       'r' => 'Cada formulario de solicitud permite adjuntar una imagen como evidencia principal.'),
        ),
    ),
    
);
?>

<div class="container-fluid px-4 py-3">

    <!-- Encabezado -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <div class="bg-success bg-opacity-10 rounded-3 p-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#198754" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
        </div>
        <div>
            <h4 class="mb-0 fw-bold">Manual de Usuario</h4>
            <p class="text-muted mb-0 small">Guia rapida para usar la plataforma GIAV</p>
        </div>
    </div>

    <!-- Acordeon -->
    <div class="accordion accordion-flush" id="accordionUsuario">

        <?php $i = 0; foreach ($secciones as $sec): ?>
        <div class="accordion-item border rounded-3 mb-2 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button <?php if ($i !== 0) { echo 'collapsed'; } ?> rounded-3 fw-semibold"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#secU<?php echo $i; ?>"
                        aria-expanded="<?php echo ($i === 0) ? 'true' : 'false'; ?>">
                    <?php echo $sec['titulo']; ?>
                </button>
            </h2>
            <div id="secU<?php echo $i; ?>"
                 class="accordion-collapse collapse <?php if ($i === 0) { echo 'show'; } ?>"
                 data-bs-parent="#accordionUsuario">
                <div class="accordion-body">

                    <?php if ($sec['tipo'] === 'parrafos'): ?>
                        <?php foreach ($sec['contenido'] as $p): ?>
                            <p class="text-muted"><?php echo $p; ?></p>
                        <?php endforeach; ?>

                    <?php elseif ($sec['tipo'] === 'pasos'): ?>
                        <ol class="ps-3">
                            <?php foreach ($sec['contenido'] as $paso): ?>
                                <li class="text-muted mb-2"><?php echo $paso; ?></li>
                            <?php endforeach; ?>
                        </ol>

                    <?php elseif ($sec['tipo'] === 'faq'): ?>
                        <div class="accordion" id="faqInner<?php echo $i; ?>">
                            <?php $j = 0; foreach ($sec['contenido'] as $f): ?>
                                <div class="accordion-item border-0 border-bottom">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed px-0 py-2 small fw-semibold bg-transparent"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faq<?php echo $i; ?>_<?php echo $j; ?>">
                                            <?php echo $f['p']; ?>
                                        </button>
                                    </h2>
                                    <div id="faq<?php echo $i; ?>_<?php echo $j; ?>"
                                         class="accordion-collapse collapse"
                                         data-bs-parent="#faqInner<?php echo $i; ?>">
                                        <div class="accordion-body px-0 pt-0 pb-2 small text-muted">
                                            <?php echo $f['r']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php $j++; endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php $i++; endforeach; ?>

    </div>
</div>