<!-- Cuando se suba al sevidor se debe cambiar de $URL[3] a $URL[2] -->
<?php $URL =  $_SERVER["REQUEST_URI"]; $URL = explode('/', $URL); $URL = explode('.', $URL[3]); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:black;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <!--  <a class="navbar-brand" href="#">Brand</a> -->
      <a href="home.php" id="largeClick"><img height="90px" width="140px" src="../img/brand.png" style="padding-top:5px;"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-1">
      <ul class="nav navbar-nav navbar-right" style="font-size:20px; padding:1%;">
        <li><a href="home.php" <?php if($URL[0]=='home'){echo 'class="selected"';} ?>>Inicio</a></li>
        <li><a href="nosotros.php" <?php if($URL[0]=='nosotros'){echo 'class="selected"';} ?>>Nosotros</a></li>
        <li><a href="arquitectura.php" <?php if($URL[0]=='arquitectura'){echo 'class="selected"';} ?>>Arquitectura</a></li>
        <li><a href="enlaciudad.php" <?php if($URL[0]=='enlaciudad'){echo 'class="selected"';} ?>>En la ciudad</a></li>
        <li><a href="contacto.php" <?php if($URL[0]=='contacto'){echo 'class="selected"';} ?>>Contácto</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

