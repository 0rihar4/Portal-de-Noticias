	<?php  
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_site.categorias',$idExcluir);
		$noticias = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticiais` WHERE categoria_id= ?");
		$noticias->execute(array($idExcluir));
		$noticias = $noticias->fetchAll();
		foreach ($noticias as $key => $value) {
			$imgDelete = $value['capa'];
			Painel::deleteFile($imgDelete);
		}
		$noticias = MySql::conectar()->prepare("DELETE FROM `tb_site.noticiais` WHERE categoria_id=?");
		$noticias->execute(array($idExcluir));
		Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-categorias');


	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site.categorias',$_GET['order'],$_GET['id']);
	}
	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina=10;
	$categorias = Painel::selectAll('tb_site.categorias', ($paginaAtual -1)*$porPagina , $porPagina*$paginaAtual); 

?>
<div class="box-content">
	<h2><i class="fa fa-book" aria-hidden="true"></i> Categorias Cadastradas</h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td><i class="fa fa-users" aria-hidden="true"></i> Nome</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php foreach ($categorias as $key => $value) { ?>

		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td><a class="btn editar" href="<?php INCLUDE_PATH_PAINEL ?>editar-categoria?id=<?php echo $value['id'];?>">Editar</a></td>
			<td><a actionBtn="delete" class="btn excluir" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-categorias?excluir=<?php echo $value['id'];?>">Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>	
		</tr>
		
		<?php } ?>
	</table>
	</div>
	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('tb_site.categorias'))/$porPagina);
			for($i=1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';

				else
					echo '<a class="" href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->

</div><!--Box Content-->