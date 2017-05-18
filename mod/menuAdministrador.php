<!-- Cuando se suba al sevidor se debe cambiar de $URL[4] a $URL[3] -->
<?php $URL =  $_SERVER["REQUEST_URI"]; $URL = explode('/', $URL); $URL = explode('.', $URL[4]); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand">Bienvenido <?php echo $_SESSION['nombre']; ?></a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul id="active" class="nav navbar-nav side-nav">
            <li><a href="home.php" <?php if($URL[0]=='home'){echo 'class="selected"';} ?>><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;Resumen</a></li>
            <li><a href="nosotros.php" <?php if($URL[0]=='nosotros'){echo 'class="selected"';} ?>><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Edición de Información</a></li>
            <li><a href="miembros.php" <?php if($URL[0]=='miembros'){echo 'class="selected"';} ?>><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Administrar Equipo</a></li>
            <?php if($_SESSION['tipo']== 0){ ?><li><a href="usuarios.php" <?php if($URL[0]=='usuarios'){echo 'class="selected"';} ?>><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Administrar Usuarios</a></li> <?php } ?>
            <li><a href="categorias.php" <?php if($URL[0]=='categorias'){echo 'class="selected"';} ?>><i class="fa fa-archive" aria-hidden="true"></i>&nbsp;&nbsp;Administrar Categorías</a></li>
            <li><a href="proyectos.php" <?php if($URL[0]=='proyectos' || $URL[0]=='editProyecto'){echo 'class="selected"';} ?>><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;&nbsp;Administrar Proyectos</a></li>
            <li><a href="redessociales.php" <?php if($URL[0]=='redessociales'){echo 'class="selected"';} ?>><i class="fa fa-facebook" aria-hidden="true"></i>&nbsp;&nbsp;Redes Sociales</a></li>
        </ul>
        <!-- Opciones menu derecho -->
        <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Editar <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="password.php">Modificar contraseña</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="user.php">Modificar nombre de usuario</a></li>
              </ul>
            </li>

            <li><a href="../../model/logout.php">Salir</a></li>
        </ul>
    </div>
</nav>
