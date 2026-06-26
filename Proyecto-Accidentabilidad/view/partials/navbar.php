<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

	<div class="container-fluid">

		<ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
			
			<!-- User Profile -->
			<ul class="navbar-nav">
				<li class="nav-item topbar-user dropdown hidden-caret">
					<a class="nav-link dropdown-toggle" href="#" role="button"
						data-bs-toggle="dropdown" aria-expanded="false">
						<?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>
					</a>

					

					<ul class="dropdown-menu">

						<li>
       					 <a class="dropdown-item"
          				  href="<?php echo getUrl("Usuario", "Usuario", "perfil"); ?>">
           				 <i class="usu"></i> Mi Perfil
        				</a>
    				</li>

						<li>
							<a class="dropdown-item"
								href="<?php echo getUrl("Acceso", "Acceso", "logout"); ?>">
								Cerrar sesi&oacute;n
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</ul>
	</div>
</nav>
<!-- End Navbar -->