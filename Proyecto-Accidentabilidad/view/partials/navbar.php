<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

	<div class="container-fluid">

		<ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
			
			<!-- User Profile -->
			<div class="d-flex align-items-center gap-4">

            	<span class="fw-semibold text-dark">
                	<i class="fas fa-user-circle me-2"></i>
                	<?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>
            	</span>

            	<a class="nav-link text-dark" href="<?php echo getUrl("Usuario", "Usuario", "perfil"); ?>">
                	<i class="fas fa-user me-1"></i> Mi Perfil
            	</a>

            	<a class="nav-link text-danger" href="<?php echo getUrl("Acceso", "Acceso", "logout"); ?>">
                	<i class="fas fa-sign-out-alt me-1"></i> Cerrar sesión
            	</a>

        	</div>

		</ul>
	</div>
</nav>
<!-- End Navbar -->