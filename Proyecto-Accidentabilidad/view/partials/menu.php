
<?php include_once '../lib/Permisos.php'; ?>
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="assets/img/giav.png" alt="navbar brand" class="navbar-brand" height="90" width="150">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <?php if (Permisos::hasModule(1)): ?>
                <li class="nav-item active">
                    <a href="<?php echo getUrl("Mapa","mapa","getList") ?>" class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>Mapa</p>
                        <span class="caret"></span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (Permisos::hasModule(2)): ?>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#reportesMenu">
                        <i class="fas fa-layer-group"></i>
                        <p>Reportes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="reportesMenu">
                        <ul class="nav nav-collapse">
                            <li><a href="<?php echo getUrl('Reportes','ReportesA','getCreate'); ?>"><span class="sub-item">Reporte accidente</span></a></li>
                            <li><a href="<?php echo getUrl('Reportes','ReportesNS','getCreate'); ?>"><span class="sub-item">Solicitud nueva se&ntilde;al</span></a></li>
                            <li><a href="<?php echo getUrl('Reportes','ReportesSME','getCreate'); ?>"><span class="sub-item">Solicitud se&ntilde;al en mal estado</span></a></li>
                            <li><a href="<?php echo getUrl('Reportes','ReportesSolicitudNR','getCreate'); ?>"><span class="sub-item">Solicitud nuevo reductor</span></a></li>
                            <li><a href="<?php echo getUrl('Reportes','ReportesRME','getCreate'); ?>"><span class="sub-item">Solicitud reductor en mal estado</span></a></li>
                            <li><a href="<?php echo getUrl('Reportes','SolicitudVME','getCreate'); ?>"><span class="sub-item">Solicitud v&iacute;a en mal estado</span></a></li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>


                <?php if (Permisos::hasModule(3)): ?>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#historialMenu">
                        <i class="fas fa-th-list"></i>
                        <p>Historial Reportes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="historialMenu">
                        <ul class="nav nav-collapse">
                            <li><a href="<?php echo getUrl('Historial','MiHistorial','getList'); ?>"><span class="sub-item">Mi historial</span></a></li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Permisos::hasModule(4)): ?>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#manualMenu">
                        <i class="fas fa-pen-square"></i>
                        <p>Manual</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="manualMenu">
                        <ul class="nav nav-collapse">
                            <li><a href="<?php echo getUrl('Manual','ManualU','getCreate'); ?>"><span class="sub-item">Manual usuario</span></a></li>
                            <li><a href="<?php echo getUrl('Manual','ManualS','getCreate'); ?>"><span class="sub-item">Manual se&ntilde;alizaci&oacute;n</span></a></li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Permisos::hasModule(5)): ?>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pqrsfMenu">
                        <i class="fas fa-table"></i>
                        <p>PQRSF</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="pqrsfMenu">
                        <ul class="nav nav-collapse">
                            <li><a href="<?php echo getUrl("PQRSF", "PqrsfC", "getCreate")?>"><span class="sub-item">Registrar PQRSF</span></a></li>
                            <li><a href="<?php echo getUrl("PQRSF", "Pqrsfc", "getList")?>"><span class="sub-item">Visualizar PQRSF</span></a></li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Permisos::hasModule(6)): ?>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#estadisticasMenu">
                        <i class="far fa-chart-bar"></i>
                        <p>Estad&iacute;sticas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="estadisticasMenu">
                        <ul class="nav nav-collapse">
                            <li><a href="<?php echo getUrl('Estadisticas','ZonaMayAccidentabilidad','getList'); ?>"><span class="sub-item">Zona mayor accidentabilidad</span></a></li>
                            
                        </ul>
                    </div>
                </li>
                <?php endif; ?>

                <?php if (Permisos::hasModule(7)): ?>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#usuariosMenu">
                        <i class="fas fa-layer-group"></i>
                        <p>Gesti&oacute;n de Usuarios</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="usuariosMenu">
                        <ul class="nav nav-collapse">
                            <?php if (Permisos::hasPermission(7, 1)): ?>
                            <li><a href="<?php echo getUrl('Usuario','GestionUsuario','getList'); ?>"><span class="sub-item">Visualizar usuarios</span></a></li>
                            <?php endif; ?>
                            <?php if (Permisos::hasPermission(7, 3)): ?>
                            <li><a href="<?php echo getUrl('Usuario','GestionRoles','getList'); ?>"><span class="sub-item">Gesti&oacute;n de roles</span></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#acercaMenu">
                        <i class="fas fa-layer-group"></i>
                        <p>Acerca de</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="acercaMenu">
                        <ul class="nav nav-collapse">
                            <li><a href="<?php echo getUrl("Usuario","GestionUsuario","getList"); ?>"><span class="sub-item">Acerca de GIAV</span></a></li>
                            
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>

