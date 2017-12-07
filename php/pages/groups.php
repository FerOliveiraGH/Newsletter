<?php
/**
 * Newsletter
 * Author: Fernando Oliveira
 * Version: 2.0 
 * Open Source Contribution :- mailchimp.com, tinyMce, phpMailer, Aman Virk
 * 
**/


if($_REQUEST['save'] && $_REQUEST['group_name']){
	
	$group_id = $newsletter->save_group($db,$_REQUEST['group_id'],$_REQUEST['group_name'],$_REQUEST['public']);
	if($group_id){
		ob_end_clean();
		header("Location: index.php?p=groups");
		exit;
	}
	
}
if((int)$_REQUEST['delete']){
	
	$newsletter->delete_group($db,(int)$_REQUEST['delete']);
	ob_end_clean();
	header("Location: index.php?p=groups");
	exit;

	
}

?>

<h1>Grupos</h1>

<p>
Gerencie seus grupos e sua visibilidade com seus clientes e usuários.
</p>
<form action="?p=groups&save=true" method="post" id="create_form">
<?php
if($_REQUEST['edit_group_id']){ 
	$group_id = (int)$_REQUEST['edit_group_id'];
	$group = $newsletter->get_group($db,$group_id);
	?>

	<input type="hidden" name="group_id" value="<?php echo $group_id;?>">
	
	<h2><span>Editar Grupo</span></h2>
	
	<div class="box">
		<table cellpadding="5">
			<tr>
				<td>
					<label>Nome do Grupo</label>
				</td>
				<td>
					<div class="form_field"><input type="text" name="group_name" value="<?php echo $group['group_name'];?>"></div>
				</td>
			</tr>
			<tr>
				<td>
					<label>Público</label>
				</td>
				<td>
					<input type="checkbox" name="public" value="1" <?php echo ($group['public']) ? ' checked':'';?>>Usuários publicos podem entrar nesse grupo.
				</td>
			</tr>
			<tr>
				<td>
					
				</td>
				<td>
					 <input type="submit" name="save" value="Salvar" class="submit green">
				</td>
			</tr>
		</table>
	</div>
	
	
	<div class="box">
		<input type="button" name="del" value="Deletar esse grupo" onclick="if(confirm('Deseja mesmo remover esse grupo?')){ window.location.href='?p=groups&delete=<?php echo $group_id;?>'; }" class="submit orange">
	</div>

<?php
}else{ 
	
?>
<h2><span>Lista de Grupos</span></h2>

<input type="hidden" name="group_id" value="new">

<div class="box">
	<table cellpadding="5" width="100%">
		<tr>
			<td>Nome</td>
			<td>Público</td>
			<td>Membros</td>
			<td></td>
		</tr>
		<?php
		$groups = $newsletter->get_groups($db);
		foreach($groups as $group){ 
			$members = $newsletter->get_members($db,$group['group_id']);
			?>
		<tr>
			<td>
				<?php echo $group['group_name'];?>
			</td>
			<td>
				<?php echo ($group['public']) ? 'Sim' : 'Não';?>
			</td>
			<td>
				<?php echo mysql_num_rows($members);?>
			</td>
			<td>
				<a href="?p=groups&edit_group_id=<?php echo $group['group_id'];?>" class="submit gray">Editar Grupo</a>
			</td>
		</tr>
		<?php } ?>
		
	</table>
</div>


<h2><span>Adicionar Grupo</span></h2>

<div class="box">
	<table cellpadding="5">
		<tr>
			<td>
				<label>Nome</label>
			</td>
			<td>
				<div class="form_field"><input type="text" name="group_name" id="group_name" value=""></div>
			</td>
		</tr>
		<tr>
			<td>
				<label>Público</label>
			</td>
			<td>
				<input type="checkbox" name="public" id="public" value="1"> Usuários publicos podem ser cadastrar nesse grupo
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				 <input type="submit" name="save" value="Adicionar" class="submit green">
			</td>
		</tr>
	</table>
	
</div>

<?php } ?>




</form>