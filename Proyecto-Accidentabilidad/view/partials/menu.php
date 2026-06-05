<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20">
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

                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Mapa</p>
                        <span class="caret"></span>
                    </a>
                </li >

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Reportes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li><a href="<?php echo getUrl("Reportes","ReportesA","getCreate")?>"><span class="sub-item">Reporte accidente</span></a></li>
                            <li><a href="components/buttons.html"><span class="sub-item">Solicitud nueva señal</span></a></li>
                            <li><a href="components/gridsystem.html"><span class="sub-item">Solicitud señal en mal estado</span></a></li>
                            
                            <li><a href="<?php echo getUrl("Reportes", "SolicitudNR", "index")?>"><span class="sub-item">Solicitud nuevo reductor</span></a></li>
                            
                            <li><a href="components/notifications.html"><span class="sub-item">Solicitud reductor en mal estado</span></a></li>
                            <li><a href="components/sweetalert.html"><span class="sub-item">Solicitud via en mal estado</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Historial Reportes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li><a href="sidebar-style-2.html"><span class="sub-item">Mi historial</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Manual</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li><a href="forms/forms.html"><span class="sub-item">Manual usuario</span></a></li>
                            <li><a href="forms/forms.html"><span class="sub-item">Manual señalizacion</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Visualizar Reportes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li><a href="tables/tables.html"><span class="sub-item">Reportes ciudadano </span></a></li>
                            <li><a href="tables/datatables.html"><span class="sub-item">PQRSF</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Estadisticas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li><a href="charts/charts.html"><span class="sub-item">Zona mayor accidentabilidad</span></a></li>
                            <li><a href="charts/sparkline.html"><span class="sub-item">Trazabilidad</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#list">
                        <i class="fas fa-layer-group"></i>
                        <p>Gestion de Usuarios</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="list">
                        <ul class="nav nav-collapse">
                            <li><a href="components/avatars.html"><span class="sub-item">Visualizar usuario</span></a></li>
                            <li><a href="components/buttons.html"><span class="sub-item">Editar usuario</span></a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>