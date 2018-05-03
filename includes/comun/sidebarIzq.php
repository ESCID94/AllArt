<?php
use es\ucm\fdi\aw;

$app = aw\Aplicacion::getSingleton();
?>

<div id="sidebar-left">
	<h3>Ordenar por</h3>
	<ul>
		<input type="checkbox" name="ordena" value="mayoramenor"> Mayor a menor precio<br>
		<br/>
		<br/>
		<input type="checkbox" name="ordena" value="menor a mayor"> Menor a mayor precio<br>
		<br/>
		<br/>
		<input type="checkbox" name="ordena" value="valorados"> Más valorados<br>
		
		
	</ul>
</div>
