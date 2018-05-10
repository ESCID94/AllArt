<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/muestra.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/imagegrid.css') ?>" />
  <title>*Art</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">


		<!-- Image Grid from https://www.w3schools.com/howto/howto_js_image_grid.asp--> 

	<script src="javascript/imagegrid.js" type="text/javascript"></script> 
	 <h1>Image Grid</h1>
  	<p>Click on the buttons to change the grid view.</p>
 	 <button class="btn" onclick="one()">1</button>
 	 <button class="btn active" onclick="two()">2</button>
	 <button class="btn" onclick="four()">4</button>	

	
		<div class="row">
  <div class="column">
    <img src="img/pintura.jpg" onclick="openModal();currentSlide(1)" class="hover-shadow">
  </div>
  <div class="column">
    <img src="img/pintura2.jpg" onclick="openModal();currentSlide(1)" class="hover-shadow">
  </div>
  <div class="column">
    <img src="img/pintura3.jpg" onclick="openModal();currentSlide(1)" class="hover-shadow">
  </div>


   </div>

<!-- The Modal/Lightbox -->
<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="img/pintura.jpg" style="width:100%">
    </div>
    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="img/pintura2.jpg" style="width:100%">
    </div>
    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="img/pintura3.jpg" style="width:100%">
    </div>



    
    <!-- Next/previous controls -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <!-- Caption text -->
    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <!-- Thumbnail image controls -->
    <div class="column">
      <img class="demo" src="img/pintura.jpg" onclick="currentSlide(1)" alt="pintura">
    </div>
    <div class="column">
      <img class="demo" src="img/pintura2.jpg" onclick="currentSlide(1)" alt="pintura2">
    </div>
    <div class="column">
      <img class="demo" src="img/pintura3.jpg" onclick="currentSlide(1)" alt="pintura3">
    </div>





    
    
      </div>
</div>	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
