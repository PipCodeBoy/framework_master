<div id="createaddbox">
	<input id="openbutton" type="button" name="" value="Crear Anuncio">
	<div id="box">
		<form action="<?php echo APP_W.'user/createadd';?>" method="post" accept-charset="utf-8">
			Name: <input onchange="pos()" type="text" name="name" value="" placeholder="">
			Description: <input type="text" name="description" value="" placeholder="">
			Price: <input type="text" name="price" value="" placeholder="">
			Photo: <input type="text" name="photo" value="" placeholder="">
			<input type="text" id="lat" name="lat" value="" hidden placeholder="">
			<input type="text" id="lon" name="lon" value="" hidden placeholder="">
			<button></button>
			<input type="submit"  value="Crear Articulo" placeholder="">
		</form>
	</div>
</div>