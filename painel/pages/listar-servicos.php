
<?php  
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('tb_site.servicos',$idExcluir);
	}
	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	if(isset($_POST['acao'])){
		$porPagina = $_POST['numero'];
	}else{
		$porPagina = 10;
	}

		$dadosDepoimento = Painel::selectAll2('tb_site.servicos', ($paginaAtual -1)*$porPagina , $porPagina*$paginaAtual); 
		//Painel::redirect(INCLUDE_PATH_PAINEL.'listar-depoimentos');

?>
<form method="post">
	<input type="text" name="numero"/>

	<input type="submit" name="acao">
</form>
<div class="box-content">
	<h2><i class="fa fa-book" aria-hidden="true"></i> Depoimentos Cadastrados</h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td><i class="fa fa-signal" aria-hidden="true"></i> Serviço</td>
			<td><i class="fa fa-table" aria-hidden="true"></i> Nivel</td>
			<td></td>
			<td></td>
		</tr>
		<?php foreach ($dadosDepoimento as $key => $value) { ?>

		<tr>
			<td><?php echo $value['servico']; ?></td>
			<td><?php echo $value['nivel']; ?></td>
			<td><a class="btn editar" href="<?php INCLUDE_PATH_PAINEL ?>editar-servicos?id=<?php echo $value['id'];?>">Editar</a></td>
			<td><a actionBtn="delete" class="btn excluir" href="<?php INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id'];?>">Excluir</a></td>
		</tr>
		
		<?php } ?>
	</table>
	</div>
	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll2('tb_site.servicos'))/$porPagina);
			for($i=1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a class="" href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->

</div><!--Box Content-->