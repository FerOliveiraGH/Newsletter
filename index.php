<?php
/**
 * Newsletter
 * Author: Fernando Oliveira
 * Version: 2.0 
 * Open Source Contribution :- mailchimp.com, tinyMce, phpMailer, Aman Virk
 * 
**/

if(version_compare(PHP_VERSION, '5.0.0', '<')){
	echo "I'm sorry, PHP version 5 is needed to run this website. <br>";
	echo "The current PHP version is: ". phpversion() . "<br>";
	echo "Ask your hosting provider to upgrade it for you.";
	exit;
}
define("_NEWSLETTER_VERSION",1.8);

session_start();

header('Content-Type: text/html; charset=UTF-8');

ob_start();// so we can header:redirect later on

if(is_file("config.php")){
	require_once("config.php");
}
require_once("php/functions.php");
require_once("php/class.newsletter.php");
$newsletter = new newsletter();

if(defined("_DB_NAME")){
	
	require_once("php/database.php");
	
	$db = db_connect();
	
	if($_REQUEST['p']!='setup'){
		$newsletter->init();
		require_once("php/auth.php");
	}

}

$show_menu = (isset($_REQUEST['hide_menu'])) ? false : true;

ob_start();
if(defined("_DB_NAME") && $show_menu){ ?>
<?php } ?>
	<?php if(defined("_DB_NAME")){ ?>
		<?php if($show_menu){ ?>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
				<ul class="nav">
                                    <span class="site_icon"><img src="images/logo.png" alt="logo" width="100%" /></span>
					<span class="spacer">&nbsp;</span>
					<li><a href="?p=home"> Dashboard </a></li>
						<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Newsletter <b class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li><a href="?p=create"> Criar Newsletter </a></li>
							<li><a href="?p=past"> Ver Newsletter </a></li>
						</ul>
					</li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="?p=campaign" class="dropdown-toggle" data-toggle="dropdown"> Campanhas </a>
					</li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Membros <b class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li><a href="?p=members_add"> Adicionar Membros </a></li>
							<li><a href="?p=members">Ver Membros </a></li>
						</ul>
					</li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="?p=groups" class="dropdown-toggle" data-toggle="dropdown"> Grupos </a>
					</li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="?p=settings" class="dropdown-toggle" data-toggle="dropdown"> Configurações </a>
					</li>


				</ul>
				<ul class="nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Bem-Vindo <?php echo $_SESSION['user_logged_in']; ?> <b class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li> <a href="?logout"> Logout </a></li>
						</ul>
					</li>
				<ul>

				</div><!-- end container -->
			</div><!-- end navbar-inner -->
		</div><!-- end navbar -->

	<div class="innerContent">
		<?php
		}
		$page=false;
		if(isset($_REQUEST['p'])){
			$page = basename($_REQUEST['p']);
		}
		if(!$page || !is_file("php/pages/".$page.".php")){
			$page = "home";
		}
		include("php/pages/".$page.".php");
	
	}else{
		
		include("php/pages/setup.php");
	}
	?>
	</div>
<?php
$inner_content = ob_get_clean();
include("layout/system_header.php");
echo $inner_content;
include("layout/system_footer.php");
?>
