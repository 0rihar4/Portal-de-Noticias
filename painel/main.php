<!DOCTYPE html>
<?php
 if (isset($_GET['logout'])) {
 	Painel::logout();
 	Painel::redirect(INCLUDE_PATH);
 }
?>

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
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,600;0,800;1,800&display=swap">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>estilo/font-awesome.min.css">
	<link href="<?php echo INCLUDE_PATH_PAINEL;?>css/estilo.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="widht=device-widht, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH_PAINEL;?>favicon.ico">
</head>
<body>
<div class="menu-aside">
  <div class="menu-wraper">
	<div class="box-usuario">
		<?php
			if($_SESSION['img']==''){
		?>
		<div class="avatar-usuario">
			<i class="fa fa-user"></i>
		</div>	<!--avatar-usuario-->
		<?php }else{?>
		<div class="imagem-usuario">
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?php echo $_SESSION['img'];?>" />
		</div>	<!--avatar-usuario-->
			<?php }?>
		<div class="nome-usuario">
			<h3><?php echo $_SESSION['nome']; ?></h3>
			<p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
		</div>
	</div><!--Box avatar-usuario-->
	<div class="itens-menu">

		<h2>Cadastros</h2>
		<a <?php selecionadoMenu('cadastrar-depoimentos');?> href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-depoimentos"><i <?php iconeMenu('cadastrar-depoimentos');?> ></i> Cadastrar Depoimentos</a>
		<a <?php selecionadoMenu('cadastrar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-servicos"><i <?php iconeMenu('cadastrar-servicos');?> ></i>  Cadastrar Serviço</a>
		<a <?php selecionadoMenu('cadastrar-slides');?> href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-slides"><i <?php iconeMenu('cadastrar-slides');?> ></i>  Cadastrar Slides</a>
		<h2>Gestão</h2>
		<a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>listar-depoimentos"> <i<?php iconeMenu('listar-depoimentos');?> ></i> Listar Depoimentos</a>
		<a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>listar-servicos"><i <?php iconeMenu('listar-servicos');?> ></i> Listar Serviços</a>
		<a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>listar-slides"><i <?php iconeMenu('listar-slides');?> ></i> Listar Slides</a>
		<h2>Administração do Painel</h2>
		<a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>editar-usuario"><i <?php iconeMenu('editar-usuario');?> ></i> Editar Usuario</a>
		<a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificarPermissaoMenu(1) ?> href="<?php echo INCLUDE_PATH_PAINEL;?>adicionar-usuario"><i <?php iconeMenu('adicionar-usuario');?> ></i> Adicionar Usuarios</a>
		<h2>Configuração Geral</h2>
		<a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>editar-site"><i <?php iconeMenu('editar-site');?> ></i> Editar Site</a>
		<h2>Gestão de Noticias</h2>
			<a <?php selecionadoMenu('cadastrar-categorais'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-categorais"><i <?php iconeMenu('cadastrar-categorais');?> ></i> Cadastrar Categorias</a>
			<a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>gerenciar-categorias"><i <?php iconeMenu('gerenciar-categorias');?> ></i> Gerenciar Categorias</a>
			<a <?php selecionadoMenu('cadastrar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>cadastrar-noticias"><i <?php iconeMenu('cadastrar-noticias');?> ></i> Cadastrar Noticias</a>
			<a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL;?>gerenciar-noticias"><i <?php iconeMenu('gerenciar-noticias');?> ></i> Gerenciar Noticias</a>
	
	</div><!--Itens Menus-->
  </div><!--menu-wraper-->
</div><!--Menu Aside-->
	<header class="main">
		<div class="center">
		<div class="menu-btn">
			<i class="fa fa-bars"></i>
		</div><!--menu-btn-->
		<div class="logout">
			<a <?php if(@$_GET['url']==''){ ?> style="background: #191970; padding: 15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL;?>?"><i class="fa fa-home"></i><span> Pagina Inicial </span></a>
			<a href="<?php echo INCLUDE_PATH_PAINEL; ?>?logout"><i class="fa fa-window-close"></i><span> Loggout </span></a>
		</div><!--Logout-->
		</div>
		<div class="clear"></div>
	</header>
<div class="content">
	<?php 

	Painel::carregarPainel();

	?>
	<div class="clear"></div>
</div><!--Content-->

<script src="<?php echo INCLUDE_PATH;?>jquery/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL;?>js/main.js"></script>
 <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
 <script>
 tinymce.init({
 	selector:'.tinymce',
 	plugins: 'image',
 	height: 500
 	});
</script>
</body>
</html>