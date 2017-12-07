<?php
/**
 * Newsletter
 * Author: Fernando Oliveira
 * Version: 2.0 
 * Open Source Contribution :- mailchimp.com, tinyMce, phpMailer, Aman Virk
 * 
**/

$settings = $newsletter->get_settings($db);
if($_REQUEST['save']){
	if(_DEMO_MODE){
		ob_end_clean();
		echo "Adjusting settings disabled in demo mode sorry";
		exit;
	}

	foreach($_REQUEST['settings'] as $key => $value)
	{
		$sql = mysql_query("UPDATE settings SET val = '".mysql_real_escape_string($value)."' WHERE `key` = '$key'") or die(mysql_error());
	}
	ob_end_clean();
	header("Location: index.php?p=settings");
	exit;
}
?>

<h1>&nbsp;</h1>

<form action="?p=settings&save=true" method="post" id="create_form">


<fieldset class="two_col left_col" style="width: 30%;">
<legend> Configurações </legend>
		<?php
		foreach($settings as $key => $setting){
                    switch ($key){
                        case 'bounce_email':
                            $key = 'Enviar Email';
                            break;
                        case 'default_template':
                            $key = 'Template Padrão';
                            break;
                        case 'from_email':
                            $key = 'Email de Envio';
                            break;
                        case 'from_name':
                            $key = 'Nome de Envio';
                            break;
                        case 'password':
                            $key = 'Senha de Acesso';
                            break;
                        case 'username':
                            $key = 'Nome de Acesso';
                            break;
                    }
			?>
			<label><?php echo $key; ?></label>
			<div class="form_field"><input type="text" name="settings[<?php echo $key; ?>]" class="input" value="<?php echo $setting;?>"></div>
		<?php } ?>
		<br />
		<input type="submit" name="save" value="Salvar" class="submit green">
</fieldset>
</form>

<fieldset class="two_col right_col">
	<legend> Ajuda </legend>
		<label class="next_label">O que é isso?</label>
		<div class="single_info grid_2">
			<label class="inline_label">Enviar Email</label>
			<p> Onde os e-mails de devolução serão enviados. crie uma nova conta de e-mail para isso, se possível.</p>
		</div>
		<div class="single_info grid_3">
			<label class="inline_label">Template Padrão</label>
			<p>Nome da pasta do modelo padrão para usar.</p>
		</div>

		<div class="single_info grid_2">
			<label class="inline_label">Email de Envio </label>
			<p>Email de envio de newsletters.</p>
		</div>

		<div class="single_info grid_3">
			<label class="inline_label">Nome de Envio </label>
			<p>Nome padrão de envio de newsletters.</p>
		</div>

		<div class="single_info grid_2">
			<label class="inline_label">Nome de Acesso</label>
			<p> Usuário requerido para login no sistema </p>
		</div>


		<div class="single_info grid_3">
			<label class="inline_label">Senha de Acesso</label>
			<p>Senha de acesso ao sistema</p>
		</div>


</fieldset>	

<div class="clear"></div>
<?php
$groups = $newsletter->get_groups($db);
$campaigns = $newsletter->get_campaigns($db);
$form = $newsletter->get_form($db);
?>

<h2><span>Formulario de Incrição</span></h2>

<div class="box">
<p>Copie e cole esse codigo HTML em seu site para obter o formulario de incrição de Newsletter.</p>
<table cellpadding="5">

<tr>
	<td> <div class="embed_buttons"> <a href="ext.php?t=signup_form" target="_blank" class="submit orange">Formulario de Incrição</a></div></td>
	<td> <div class="embed_buttons"> <a href="ext.php?t=update_form" target="_blank" class="submit orange">Formulario de Atualização</a> </div></td>
	<td> <div class="embed_buttons"> <a href="ext.php?t=unsub_form" target="_blank" class="submit orange">Formulario de Desinscrever</a> </div></td>
</tr>
<tr>
<td valign="top">
<textarea cols="60" class="input" rows="20" spellcheck="false">
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Incrição</title>
<style type="text/css">
body,html{
height: 100%;
margin: 0;
padding: 0;
}
</style>
</head>
<body>
<?php //echo htmlspecialchars('<form action="http://'.$newsletter->base_href.'/ext.php?t=signup" method="post">'.$form.'</form>'); ?>
<?php echo htmlspecialchars('<iframe src="http://'.$newsletter->base_href.'/ext.php?t=signup_form" width="100%" height="100%" style="border: none; height: 100%;"></iframe>'); ?>
</body>
</html>
</textarea>
</td>
<td valign="top">
<textarea cols="60" class="input" rows="20" spellcheck="false">
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Incrição</title>
<style type="text/css">
body,html{
height: 100%;
margin: 0;
padding: 0;
}
</style>
</head>
<body>
<?php //echo htmlspecialchars('<form action="http://'.$newsletter->base_href.'/ext.php?t=signup" method="post">'.$form.'</form>'); ?>
<?php echo htmlspecialchars('<iframe src="http://'.$newsletter->base_href.'/ext.php?t=update_form" width="100%" height="100%" style="border: none; height: 100%;"></iframe>'); ?>
</body>
</html>
</textarea>
</td>


<td valign="top">
<textarea cols="60" class="input" rows="20" spellcheck="false">
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Incrição</title>
<style type="text/css">
body,html{
height: 100%;
margin: 0;
padding: 0;
}
</style>
</head>
<body>
<?php //echo htmlspecialchars('<form action="http://'.$newsletter->base_href.'/ext.php?t=signup" method="post">'.$form.'</form>'); ?>
<?php echo htmlspecialchars('<iframe src="http://'.$newsletter->base_href.'/ext.php?t=unsub_form" width="100%" height="100%" style="border: none; height: 100%;"></iframe>'); ?>
</body>
</html>
</textarea>
</td>


</tr>
</table>
</div>
<!--<h2><span>Sending CRON Job (beta)</span></h2>
<div class="box">
	<p>The CRON job will process scheduled newsletter sends and any campaigns that are setup.</p>
	<p>
		You can run the cron job manually yourself by <a href="cron.php" target="_blank">clicking here</a> (this may take a while to load - it will show a blank screen when done)
	</p>
	<p>
		For cron setup instructions please <a href="cron.php?t" target="_blank">click here</a>.
	</p>
</div>
<h2><span>Bounce Checking CRON Job (beta)</span></h2>
<div class="box">
	<p>The CRON job will process bounced emails for statistics.</p>
	<p>
		You can run the cron job manually yourself by <a href="cron_bounce.php" target="_blank">clicking here</a> (this may take a while to load - it will show a blank screen when done)
	</p>
	<p>
		For cron setup instructions please <a href="cron_bounce.php?t" target="_blank">click here</a>.
	</p>
</div> -->