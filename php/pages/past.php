<?php
/**
 * Newsletter
 * Author: Fernando Oliveira
 * Version: 2.0 
 * Open Source Contribution :- mailchimp.com, tinyMce, phpMailer, Aman Virk
 * 
**/

?>

<h1>Newsletters Anteriores</h1>


<h2><span>Liste de todos os Newsletters</span></h2>


<div class="box">
	<table cellpadding="5" class="stats">
		<tr>
			<th>Assunto do Email</th>
			<th>Enviado de</th>
			<th>Enviado para</th>
			<th>Aberto por</th>
			<th>Desinscritos</th>
			<th>Pulados</th>
			<th>Ação</th>
		</tr>
		<?php
		$newsletters = $newsletter->get_newsletters($db);
		foreach($newsletters as $n){ 
			$n = $newsletter->get_newsletter($db,$n['newsletter_id']);
			$sends = $newsletter->get_newsletter_sends($db,$n['newsletter_id']);
			?>
		<tr>
			<td>
				<?php echo $n['subject'];?>
			</td>
			<td>
				&lt;<?php echo $n['from_name'];?>&gt; <?php echo $n['from_email'];?> 
			</td>
			<td>
				<?php
				foreach($sends as $send){ 
					$send = $newsletter->get_send($db,$send['send_id']);
					?>
					
					<?php echo count($send['sent_members']);?> membro(s) de <?php echo date("Y-m-d",$send['start_time']);?> <br>
					
				<?php } ?>
			</td>
			<td>
				<?php
				foreach($sends as $send){ 
					$send = $newsletter->get_send($db,$send['send_id']);
					?>
					
					<?php echo count($send['opened_members']);?> membro(s) <br>
					
				<?php } ?>
			</td>
			<td>
				<?php
				foreach($sends as $send){ 
					$send = $newsletter->get_send($db,$send['send_id']);
					?>
					
					<?php echo count($send['unsub_members']);?> membro(s) <br>
					
				<?php } ?>
			</td>
			<td>
				<?php
				foreach($sends as $send){ 
					$send = $newsletter->get_send($db,$send['send_id']);
					?>
					
					<?php echo count($send['bounce_members']);?> membro(s) <br>
					
				<?php } ?>
			</td>
			<td>
				<a href="?p=open&newsletter_id=<?php echo $n['newsletter_id'];?>" class="submit gray">Enviar</a>
				<a href="?p=create&newsletter_id=<?php echo $n['newsletter_id'];?>" class="submit orange">Editar</a>
			</td>
		</tr>
		<?php } ?>
		
	</table>
</div>


