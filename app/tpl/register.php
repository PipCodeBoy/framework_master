
<div class="container">
	<h1>Formulario de registro!</h1>

	<form class="registerform" action="<?php echo APP_W.'register/register';?>" method="post">
		Name:<input name="name" type="text" /><br><br>
		Pass:<input name="pass" type="password" /><br><br>
		Email:<input name="email" type="email" /><br><br>
		Phone:<input name="phone" type="text" /><br><br>
		<input type="submit" value="Register" />
	</form>
</div>