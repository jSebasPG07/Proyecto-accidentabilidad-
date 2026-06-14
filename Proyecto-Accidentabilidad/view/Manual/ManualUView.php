<?php

$manualUsuario = [
  
  [
    'titulo' => 'A. Bienvenidos a GIAV',
    'tipo' => 'parrafos',
    'contenido' => [
      'GIAV (Geovisor Inteligente de Accidentalidad Vial) es una plataforma colaborativa que permite a la comunidad reportar accidentes de tránsito, problemas de infraestructura vial y hacer seguimiento a sus solicitudes ante las autoridades competentes.',
      'Este manual te explica paso a paso cómo usar cada módulo de la plataforma.',
    ],
  ],

  [
    'titulo' => 'B. Crear y gestionar tu cuenta',
    'tipo' => 'pasos',
    'contenido' => [
      'Regístrate con tu correo electrónico y crea una contraseña segura desde la pantalla de registro.',
      'Inicia sesión desde la pantalla principal con tus credenciales.',
      'Desde "Gestión de Usuarios" puedes actualizar tus datos de contacto y consultar tu información.',
    ],
  ],

  [
    'titulo' => 'C. Módulo de Reportes',
    'tipo' => 'pasos',
    'contenido' => [
      'Ingresa al módulo "Mapa" para visualizar los reportes de accidentalidad vial cercanos a tu ubicación.',
      'En "Reportes" puedes registrar un accidente (tipo de choque, vehículos involucrados y ubicación), o generar una solicitud relacionada con señalización vial:',
      '— Solicitud nueva señal, Solicitud señal en mal estado, Solicitud nuevo reductor, Solicitud reductor en mal estado y Solicitud vía en mal estado.',
      'Adjunta evidencia fotográfica cuando esté disponible para agilizar la validación.',
    ],
  ],

  [
    'titulo' => 'D. Historial de Reportes',
    'tipo' => 'parrafos',
    'contenido' => [
      'En "Historial Reportes → Mi historial" puedes consultar todos los reportes y solicitudes que has registrado, junto con su estado actual.',
      'Los estados posibles son: Pendiente, En revisión, En proceso, Completada o Rechazada.',
    ],
  ],

  [
    'titulo' => 'E. Manual de Señalización',
    'tipo' => 'parrafos',
    'contenido' => [
      'En "Manual → Manual señalización" encontrarás los tipos de señales viales (reglamentarias, informativas y preventivas), su significado, y enlaces directos para reportar señales dañadas o solicitar señales y reductores nuevos.',
    ],
  ],

  [
    'titulo' => 'F. PQRSF',
    'tipo' => 'parrafos',
    'contenido' => [
      'El módulo "PQRSF" permite consultar los reportes ciudadanos registrados y radicar Peticiones, Quejas, Reclamos, Sugerencias y Felicitaciones (PQRSF) relacionadas con el servicio o la infraestructura vial.',
    ],
  ],

  [
    'titulo' => 'G. Estadísticas',
    'tipo' => 'parrafos',
    'contenido' => [
      'El módulo de Estadísticas incluye "Zona de Mayor Accidentabilidad", que identifica los puntos críticos de la vía, y "Trazabilidad", que permite hacer seguimiento histórico a los reportes y solicitudes.',
    ],
  ],

  [
    'titulo' => 'H. Preguntas frecuentes',
    'tipo' => 'faq',
    'contenido' => [
      ['p' => '¿Cómo sé el estado de mi reporte o solicitud?', 'r' => 'Ingresa a "Historial Reportes → Mi historial" y revisa la columna de estado.'],
      ['p' => '¿Puedo editar una solicitud después de enviarla?', 'r' => 'No. Si necesitas corregir información, comunícate con soporte a través del módulo PQRSF.'],
      ['p' => '¿Qué hago si la señal que quiero reportar no aparece en el catálogo?', 'r' => 'Selecciónala lo más parecida posible y agrega el detalle en el campo de descripción del formulario.'],
    ],
  ],
];

?>

<div class="page-inner manual-usuario">

  <div class="manual-header">
    <div class="icon-box">
      <i class="fas fa-user-graduate"></i>
    </div>
    <div>
      <h3>Manual de Usuario</h3>
      <p>Guía rápida para usar la plataforma GIAV.</p>
    </div>
  </div>

  <div class="accordion" id="accordionManualUsuario">
    <?php foreach ($manualUsuario as $sec): ?>
      <div class="acc-item">
        <div class="acc-header" onclick="toggleAccU(this)">
          <span class="acc-title"><?= $sec['titulo'] ?></span>
          <span class="chevron">▾</span>
        </div>
        <div class="acc-body">
          <div class="acc-content">

            <?php if ($sec['tipo'] === 'parrafos'): ?>
              <?php foreach ($sec['contenido'] as $p): ?>
                <p><?= $p ?></p>
              <?php endforeach; ?>

            <?php elseif ($sec['tipo'] === 'pasos'): ?>
              <ol class="pasos-list">
                <?php foreach ($sec['contenido'] as $paso): ?>
                  <li><?= $paso ?></li>
                <?php endforeach; ?>
              </ol>

            <?php elseif ($sec['tipo'] === 'faq'): ?>
              <div class="faq-list">
                <?php foreach ($sec['contenido'] as $f): ?>
                  <div class="faq-item">
                    <div class="pregunta"><?= $f['p'] ?></div>
                    <div class="respuesta"><?= $f['r'] ?></div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<style>

  .manual-usuario{
    --bg-card:#1c2a45;
    --bg-card-soft:#243456;
    --text-light:#e7ecf6;
    --text-muted:#9aa7c2;
    --border-soft:#33446b;
    --azul:#3b82f6;
    --verde:#22c55e;
  }

  .manual-usuario .manual-header{
    display:flex;
    align-items:center;
    gap:14px;
    background:#fff;
    border-radius:12px;
    padding:18px 20px;
    margin-bottom:18px;
    box-shadow:0 1px 3px rgba(0,0,0,.06);
  }

  .manual-usuario .manual-header .icon-box{
    width:46px;
    height:46px;
    border-radius:10px; 
    background:#dcfce7;
    display:flex; 
    align-items:center; 
    justify-content:center; 
    flex-shrink:0;
    color:#22c55e; 
    font-size:1.2rem;
  }

  .manual-usuario .manual-header h3{
    margin:0; 
    font-size:1.2rem;
  }

  .manual-usuario .manual-header p{
    margin:2px 0 0; 
    font-size:.85rem; 
    color:#64748b;
  }

  .manual-usuario .accordion{
    display:flex; 
    flex-direction:column; 
    gap:10px;
  }

  .manual-usuario .acc-item{
    background:var(--bg-card); 
    border-radius:10px; 
    overflow:hidden; 
    color:var(--text-light);
  }

  .manual-usuario .acc-header{
    display:flex; 
    align-items:center; 
    gap:12px; 
    padding:16px 18px;
    cursor:pointer; 
    user-select:none; 
    border-left:4px solid var(--azul);
  }

  .manual-usuario .acc-title{
    flex:1; 
    font-weight:600; 
    font-size:.97rem;
  }

  .manual-usuario .chevron{
    transition:transform .2s ease; 
    color:var(--text-muted);
  }

  .manual-usuario .acc-item.open .chevron{
    transform:rotate(180deg);
  }

  .manual-usuario .acc-body{
    max-height:0; 
    overflow:hidden; 
    transition:max-height .25s ease;
  }

  .manual-usuario .acc-item.open .acc-body{
    border-top:1px solid var(--border-soft);
  }

  .manual-usuario .acc-content{
    padding:18px 20px 22px;
  }

  .manual-usuario .acc-content p{
    font-size:.88rem; 
    line-height:1.55; 
    color:var(--text-muted); 
    margin:0 0 10px;
  }

  .manual-usuario .pasos-list{
    counter-reset:paso; 
    list-style:none; 
    margin:6px 0 0; 
    padding:0; 
    display:flex; 
    flex-direction:column; 
    gap:10px;
  }
  
  .manual-usuario .pasos-list li{
    counter-increment:paso;
    background:var(--bg-card-soft);
    border-radius:8px;
    padding:12px 14px 12px 46px;
    position:relative;
    font-size:.85rem;
    color:var(--text-muted);
  }

  .manual-usuario .pasos-list li::before{
    content:counter(paso); 
    position:absolute; 
    left:12px; top:50%; 
    transform:translateY(-50%);
    width:24px; 
    height:24px; 
    border-radius:50%; 
    background:var(--azul);
    color:#fff; 
    font-weight:700; 
    font-size:.78rem; 
    display:flex; 
    align-items:center; 
    justify-content:center;
  }

  .manual-usuario .faq-list{
    display:flex; 
    flex-direction:column; 
    gap:8px; 
    margin-top:6px;
  }

  .manual-usuario .faq-item{
    background:var(--bg-card-soft); 
    border-radius:8px; 
    padding:12px 14px;
  }

  .manual-usuario .faq-item .pregunta{
    font-weight:700; 
    font-size:.86rem; 
    color:var(--text-light); 
    margin-bottom:4px;
  }

  .manual-usuario .faq-item .respuesta{
    font-size:.82rem; 
    color:var(--text-muted);
  }

</style>

<script>
  function toggleAccU(header){
    const item = header.parentElement;
    const body = item.querySelector('.acc-body');
    const isOpen = item.classList.contains('open');

    item.parentElement.querySelectorAll('.acc-item').forEach(el=>{
      el.classList.remove('open');
      el.querySelector('.acc-body').style.maxHeight = null;
    });

    if(!isOpen){
      item.classList.add('open');
      body.style.maxHeight = body.scrollHeight + 'px';
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const first = document.querySelector('.manual-usuario .acc-item');
    if(first) toggleAccU(first.querySelector('.acc-header'));
  });
</script>