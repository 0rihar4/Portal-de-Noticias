<?php
	$url = explode('/',$_GET['url']);


	$verificar_categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$verificar_categoria->execute(array($url[1]));
	if($verificar_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}
	$categoriaInfo=$verificar_categoria->fetch();

	$post = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticiais` WHERE slug =? AND categoria_id=?");
	$post->execute(array($url[2],$categoriaInfo['id']));
	if($post->rowCount()==0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}
		//MINHA NOTICIA EXISTE
		$post =  $post->fetch(); 
		$categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug=?");
		$categoria->execute(array(@$url[1]));
		$categoria = $categoria->fetch();

?>
<section class="noticia-single">
<div class="center">
<header>
	<h1><?php echo$post['data'];?>-<?php echo $post['titulo']; ?></h1>
	<h3><a href="<?php INCLUDE_PATH ?>noticias/nome-da-categoria"></a><?php echo $categoria['nome'];?></h3>
</header>
<article>
<?php echo $post['conteudo']; ?>
</article>
</div><!--center-->
</section><!--noticia-single-->