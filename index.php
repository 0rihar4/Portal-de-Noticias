<?php ob_start(); ?>
<!DOCTYPE html>
<?php 
include('config.php');

/*CONFIGURAÇÕES DO SITE*/
$infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_sites.configs`");
$infoSite->execute();
$infoSite = $infoSite->fetch();
?>
<?php  Site::updateUsuarioOnline(); ?>
<?php  Site::contador(); ?>
<html>
<head>
	<!-- Gerenciador de tags do Google -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-utf8');
		</script>
	<!-- Fim do código do Gerenciador de tags do Google -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-2WF1WMF5QC"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-2WF1WMF5QC');
	</script>
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
	
	<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php 
	   $url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'depoimentos':
				echo '<target target="depoimentos" />';
				break;

			case 'servicos':
				echo '<target target="servicos" />';
				break;
		
	   }

	 ?><!--Target Para a rolagem do JS-->


	 <div class="sucesso">
	 	<p>Formulario enviado com sucesso!</p>	
	 </div>
	 <div class="erro">
	 	<p>houve um erro! tente novamente</p>	
	 </div>

	 <div class="overlay-loading">

	 	<img src="<?php echo INCLUDE_PATH; ?>/imagens/ajax-logo.gif">
	 	
	 </div><!--overlay-loading-->
	<header>
	  <div class="center">
			<div class="left logo">Space Marketing</div><!--Logo-->
				<nav class="desktop right">
					<ul>
						<li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
						<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
						<li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
						<li><a href="<?php echo INCLUDE_PATH;?>noticias">Noticias</a></li>
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
						<li><a href="<?php echo INCLUDE_PATH;?>noticias">Noticias</a></li>
						<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
					</ul>
				</nav><!--mobile-->
		  <div class="clear"></div>
		</div><!--center-->
	</header>
		<div class="container-principal">
		<?php
			if(file_exists('pages/'.$url.'.php')){
			include('pages/'.$url.'.php');
		}else{
			//Podemos fazer o que quiser, pois a página não existe.
			if($url != 'depoimentos' && $url != 'servicos'){
				$urlPar = explode('/',$url)[0];
				if($urlPar != 'noticias'){
				$pagina404 = true;
				include('pages/404.php');
				}else{
					include('pages/noticias.php');
				}
			}else{
				include('pages/home.php');
			}
		}
		?>
		</div><!--Container Principal-->	
		
	<footer class="rodape">
		<div class="center">
			<p>Direitos Reservados</p>
		</div><!--Center-->
	</footer>
<script src="<?php echo INCLUDE_PATH;?>jquery/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH;?>jquery/constants.js"></script>
<script src="<?php echo INCLUDE_PATH;?>jquery/scripts.js"></script>
<script src="<?php echo INCLUDE_PATH;?>jquery/fadein.js"></script>
<script src="<?php echo INCLUDE_PATH;?>jquery/formularios.js"></script>
<?php if ($url == 'home' || $url == ''){ ?>
<script src="<?php echo INCLUDE_PATH;?>jquery/slider.js"></script>
<?php } ?>
<?php
	if ($url == 'contato'){
?>
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4"></script>
 <script src="<?php echo INCLUDE_PATH;?>jquery/maps.js"></script>
 <script></script><?php } ?>
<?php
		if(is_array($url) && strstr($url[0],'noticias') !== false){
?>
<script>
	$(function(){
		$('select').change(function(){
			location.href=include_path+"noticias/"+$(this).val();
		})
	})

</script>
<?php } ?>

</body>
</html>
<?php ob_end_flush(); ?>