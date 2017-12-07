<?php
/**
 * Newsletter
 * Author: Fernando Oliveira
 * Version: 2.0 
 * Open Source Contribution :- mailchimp.com, tinyMce, phpMailer, Aman Virk
 * 
**/

if($sync_id!='new' && $sync_id){
	$sync = $newsletter->get_sync($db,$sync_id);
}else{
	$sync = array();
}
$groups = $newsletter->get_groups($db);
?>

<h2>Configurações:</h2>
<form action="?p=members_sync&save=true" method="post" id="create_form" enctype="multipart/form-data">
<input type="hidden" name="sync_id" value="<?php echo $sync_id;?>">

<div class="box">
    <h4>Nome da sincronização (obs: Carrinho de Membros)</h4>
	<table cellpadding="4">
		<tr>
			<td>Nome:</td>
			<td><input type="text" name="sync_name" id="sync_name" value="<?php echo $sync['sync_name'];?>"></td>
		</tr>
	</table>
	
	
	<h4>Digite os detalhes da conexão do MySQL para o banco de dados com o qual você deseja sincronizar:</h4>
	<table cellpadding="4">
		<tr>
			<td>Nome da Base de Dados:</td>
			<td><input type="text" name="db_name" id="db_name" value="<?php echo $sync['db_name'];?>"></td>
		</tr>
		<tr>
			<td>Usuario da Base de Dados:</td>
			<td><input type="text" name="db_username" id="db_username" value="<?php echo $sync['db_username'];?>"></td>
		</tr>
		<tr>
			<td>Senha da Base de Dados:</td>
			<td><input type="text" name="db_password" id="db_password" value="<?php echo $sync['db_password'];?>"></td>
		</tr>
		<tr>
			<td>Host da Base de Dados:</td>
			<td><input type="text" name="db_host" id="db_host" value="<?php echo $sync['db_host'];?>"></td>
		</tr>
	</table>
	
	<h4>Digite as informações da tabela de banco de dados com a qual deseja sincronizar:</h4>
	<table cellpadding="4">
		<tr>
			<td>Nome da Tabela:</td>
			<td><input type="text" name="db_table" id="db_table" value="<?php echo $sync['db_table'];?>"></td>
		</tr>
		<tr>
			<td>Primary Key:</td>
			<td><input type="text" name="db_table_key" id="db_table_key" value="<?php echo $sync['db_table_key'];?>"></td>
		</tr>
		<tr>
			<td>Email Key:</td>
			<td><input type="text" name="db_table_email_key" id="db_table_email_key" value="<?php echo $sync['db_table_email_key'];?>"></td>
		</tr>
		<tr>
			<td>First Name Key:</td>
			<td><input type="text" name="db_table_fname_key" id="db_table_fname_key" value="<?php echo $sync['db_table_fname_key'];?>"></td>
		</tr>
		<tr>
			<td>Last Name Key:</td>
			<td><input type="text" name="db_table_lname_key" id="db_table_lname_key" value="<?php echo $sync['db_table_lname_key'];?>"></td>
		</tr>
	</table>
	
        <h4>Todos os membros dessa sincronização devem ser adicionados a esses grupos locais:</h4>
	<table cellpadding="4">
		<tr>
			<td>Grupos:</td>
			<td>
				<?php
				foreach($groups as $group){ ?>
				<input type="checkbox" name="group_id[]" value="<?php echo $group['group_id'];?>" <?php echo ($sync['groups'][$group['group_id']])?'checked':'';?>> <?php echo $group['group_name'];?> <br>
				<?php } ?>
			</td>
		</tr>
	</table>
	
	<h4>Avançado</h4>
	<table cellpadding="4">
		<tr>
			<td>Redirecione para esse URL ao tentar editar os detalhes desses membros. {USER_ID} Campo Dinamico:</td>
			<td><input type="text" name="edit_url" id="edit_url" value="<?php echo $sync['edit_url'];?>"></td>
		</tr>
	</table>
        <h4>Importar</h4>
	<p>Uma vez que você esteja feliz com esses detalhes, clique em salvar abaixo e vamos testar a conexão.</p>
	<table cellpadding="4">
		<tr>
                    <td><input type="submit" name="save" class="submit green" value="Salvar &amp; Importar Membros"></td>
		</tr>
	</table>
	
</div>
</form>