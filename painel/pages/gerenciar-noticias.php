
<?php  
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		$selectImagem = MySql::conectar()->prepare("SELECT capa FROM `tb_site.noticiais` WHERE id =?");
		$selectImagem -> execute(array($_GET['excluir']));

		$imagem = $selectImagem->fetch()['capa'];
		Painel::deleteFile($imagem);
		Painel::deletar('tb_site.noticiais',$idExcluir);
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site.noticiais',$_GET['order'],$_GET['id']);
	}
	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina=10;
	$noticias = Painel::selectAll('tb_site.noticiais', ($paginaAtual -1)*$porPagina , $porPagina*$paginaAtual); 

?>
<div class="box-content">
	<h2><i class="fa fa-book" aria-hidden="true"></i> Noticias Cadastradas </h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td><i class="fa fa-users" aria-hidden="true"></i> Titulo</td>
			<td><i class="fa fa-table" aria-hidden="true"></i> Capa</td>
			<td><i class="fa fa-list-ul" aria-hidden="true"></i> Categoria</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php foreach ($noticias as $key => $value) { 
			$nomeCategoria = Painel::select('tb_site.categorias','id=?',array($value['categoria_id']))['nome'];
		?>
		<tr>
			<td><?php echo $value['titulo']; ?></td>
			<td><img style="width: 50px;height:50px;"src="<?php INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa']; ?>"></td>
			<td><?php echo $nomeCategoria; ?></td>
			<td><a class="btn editar" href="<?php INCLUDE_PATH_PAINEL ?>editar-noticia?id=<?php echo $value['id'];?>">Editar</a></td>
			<td><a actionBtn="delete" class="btn excluir" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-noticias?excluir=<?php echo $value['id'];?>">Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>	
		</tr>
		
		<?php } ?>
	</table>
	</div>
	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('tb_site.noticiais'))/$porPagina);
			for($i=1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';

				else
					echo '<a class="" href="'.INCLUDE_PATH_PAINEL.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->

</div><!--Box Content-->