<?php
/**
 * Newsletter
 * Author: Fernando Oliveira
 * Version: 2.0 
 * Open Source Contribution :- mailchimp.com, tinyMce, phpMailer, Aman Virk
 * 
**/
if(isset($_REQUEST['logout'])){
	unset($_SESSION['_newsletter_loggedin']);
	$newsletter->logout();
	header("Location: index.php");
	exit;
}

$login_status = (isset($_SESSION['_newsletter_loggedin']) && $_SESSION['_newsletter_loggedin']);

if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
	$login_status = $newsletter->login($db,$_REQUEST['username'],$_REQUEST['password']);
}

if($login_status){
	// support for multiple logins at one time.
	$_SESSION['_newsletter_loggedin'] = $login_status;
	$_SESSION['user_logged_in'] = $_REQUEST['username'];
}
else{
	$error = '<div class="newsletter_error"> Senha ou Usuário Inválido </div>';
}

if(!$login_status){
	?>
	<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="layout/css/styles.css" type="text/css" />
	</head>

	<body>
	<div id="wrapper" style="width: 900px; margin: auto;">
	<h1>Newsletter Dashboard</h1>
	<?php if(isset($error)) { echo $error; }?>
	<fieldset class="two_col left_col" style="width: 30%;">
		<legend> Newsletter Dashboard </legend>
		<form action="" method="post">
			<label>Usuário</label>
			<div class="form_field">
				<input type="text" name="username" value="<?php echo (_DEMO_MODE)?$newsletter->settings['username']:'';?>">
			</div>
			
			<label>Senha</label>
			<div class="form_field">
				<input type="password" name="password" value="<?php echo (_DEMO_MODE)?$newsletter->settings['password']:'';?>">
			</div>
			<br />
			<input type="submit" name="login_button" value="Login" class="submit green">
		</form>
	</fieldset><!-- end two_col -->
	
	<fieldset class="two_col right_col">
		<legend> Dicas </legend>
		<label class="next_label">O que posso fazer?</label>
		<div class="single_info grid_2">
			<label class="inline_label">Criar Newsletter</label>
			<p> Depois de terminar, você pode criar boletins ilimitados. </p>
		</div>
		<div class="single_info grid_3">
			<label class="inline_label">Design de Templates</label>
			<p>Não fique com um layout, faça modelos diferentes o máximo que puder</p>
		</div>

		<div class="single_info grid_2">
			<label class="inline_label">Criar Lista de Emails</label>
			<p>Crie uma lista de seus clientes</p>
		</div>

		<div class="single_info grid_3">
			<label class="inline_label">Gerenciar Campanhas</label>
			<p>Crie quantas campanhas quiser</a></p>
		</div>
	</fieldset>


	</div>
	</body>
	</html>
	<?php 
	exit;
}