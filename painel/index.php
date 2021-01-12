<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $infoSite['titulo']; ?></title>
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>estilo/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,600;0,800;1,800&display=swap">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>estilo/estilo.css">
	<meta charset="utf-8">
	<meta name="author" content="Orihara">
	<meta name="viewport" content="widht=device-widht, initial-scale=1.0">
	<meta name="description" content="Este é um site desenvolvido por 0rihar4">
	<meta name="Keywords" content="palavra chave 1, palavra chave 2, palavra chave 3">
	<link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH;?>favicon.ico">
</head>
<body>
<?php
$page=include('../config.php');
 if($page!="include('../main.php');"){
 	if (painel::logado()==false) {
 		include('login.php');
 		?>
 		<header>
	  <div class="center">
			<div class="left logo">Space Marketing</div><!--Logo-->
				<nav class="desktop right">
					<ul>
						<li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
						<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
						<li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
						<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
					</ul>
				</nav><!--Menu Desktop-->

				<nav class="mobile right ">
					<div class="botao-menu-mobile">
						<i class="fa fa-bars" aria-hidden="true"></i>
					</div>
					<ul>
						<li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
						<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
						<li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
						<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
					</ul>
				</nav><!--mobile-->
		  <div class="clear"></div>
		</div><!--center-->
	</header>
 <?php
 	}else{
 		include('main.php');
 	}
 }else{

 }
?>

</body>
</html>
<?php ob_end_flush(); ?>
