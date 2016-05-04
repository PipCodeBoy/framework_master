<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
    <link rel="stylesheet"  type="text/css" href="<?= APP_W.'pub/css/m.css'; ?>">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript" src="<?= APP_W.'pub/js/gmaps.js'; ?>"></script>
    <script src="<?= APP_W.'pub/js/app.js'; ?>" type="text/javascript" charset="utf-8" async defer></script>




    <?php
		$menu = array(
			'Inicio' => APP_W.'home',
			'Registro' => APP_W.'register',
			'Dashboard' => APP_W.'user'
		);

		$menu2 = array(
			'Inicio' => APP_W.'home',
			'Registro' => APP_W.'register'
		);
		
	?>
	<nav class="menu">
		<?php
			if(isset($_SESSION['user']))
			{
				MMenu::create($menu);
			}
			else
			{
				MMenu::create($menu2);
			}
			include 'common.php';
		?>
	</nav>
</head>

