
<?php  
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_site.depoimentos',$idExcluir);
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site.depoimentos',$_GET['order'],$_GET['id']);
	}
	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina=10;
	$dadosDepoimento = Painel::selectAll('tb_site.depoimentos', ($paginaAtual -1)*$porPagina , $porPagina*$paginaAtual); 

?>
<div class="box-content">
	<h2><i class="fa fa-book" aria-hidden="true"></i> Depoimentos Cadastrados</h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td><i class="fa fa-users" aria-hidden="true"></i> Nome</td>
			<td><i class="fa fa-table" aria-hidden="true"></i> Data</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php foreach ($dadosDepoimento as $key => $value) { ?>

		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td><?php echo $value['data']; ?></td>
			<td><a class="btn editar" href="<?php INCLUDE_PATH_PAINEL ?>editar-depoimentos?id=<?php echo $value['id'];?>">Editar</a></td>
			<td><a actionBtn="delete" class="btn excluir" href="<?php INCLUDE_PATH_PAINEL ?>listar-depoimentos?excluir=<?php echo $value['id'];?>">Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>	
		</tr>
		
		<?php } ?>
	</table>
	</div>
	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('tb_site.depoimentos'))/$porPagina);
			for($i=1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';

				else
					echo '<a class="" href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->

</div><!--Box Content-->