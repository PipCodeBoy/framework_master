<body>
	<header>
		<h1> View -<?= $title; ?></h1>
		<?php

		if(!isset($_SESSION['user']))
		{
			echo "<form class='ajax' value='1' name='formu' action='";
			echo APP_W."home/login'";
			echo " method='post'>
				Name:<input name='name' type='text' />
				Pass:<input name='pass' type='password' />
				<input type='submit' value='LogIn' />
				</form>";
		}
		else
		{
			echo "<a href='";
			echo APP_W."home/logout'";
			echo ">LogOut</a>";
		}
		?>
	</header>

	