
<div class="container">
	

	<h1>Hola <?php echo $_SESSION['user'] ?></h1>

	<?php
		if($_SESSION['rol'] == 1)
		{
			include 'admindash.php';
		}
		elseif($_SESSION['rol'] == 2)
		{
			include 'noobdash.php';
		}
		else
		{
			echo "s";
			die(2222);
			header("Location: ".APP_W.'home');
		}
	 ?>

	 <div class="showerrors">
	 	
	 </div>
</div>