<?php
/**
 * Newsletter
 * Author: Fernando Oliveira
 * Version: 2.0 
 * Open Source Contribution :- mailchimp.com, tinyMce, phpMailer, Aman Virk
 * 
**/
?>

<h1>Newsletter Campanhas</h1>


<h2 style="float: left;"><span>Lista de Todas as Campanhas</span></h2>


<a href="?p=campaign_open&campaign_id=new" class="submit orange right_float">Criar um nova Campanha</a>


<div class="box">
	<table cellpadding="5" class="stats">
		<tr>
			<th>Nome da Campanha</th>
			<th>Número de Membros</th>
			<th>Número de Newsletters</th>
			<th>Ação</th>
		</tr>
		<?php
		$campaigns = $newsletter->get_campaigns($db);
		foreach($campaigns as $n){ 
			$n = $newsletter->get_campaign($db,$n['campaign_id']);
			?>
		<tr>
			<td>
				<?php echo $n['campaign_name'];?>
			</td>
			<td>
				<?php echo mysql_num_rows($n['members_rs']); ?>
			</td>
			<td>
				<?php echo mysql_num_rows($n['newsletter_rs']); ?>
			</td>
			<td>
				<a href="?p=campaign_open&campaign_id=<?php echo $n['campaign_id'];?>" class="submit gray">Open</a>
			</td>
		</tr>
		<?php } ?>
		
	</table>
</div>


