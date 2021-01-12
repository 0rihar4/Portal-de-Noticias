<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];	
		$depoimento = Painel::select('tb_site.depoimentos','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID');
		die();
	}

?>
<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Depoimentos</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if (isset($_POST['acao'])) {
				if(Painel::update($_POST)){
					Painel::alert('sucesso','Depoimento foi editado com sucesso!');
					$depoimento = Painel::select('tb_site.depoimentos','id = ?',array($id));
				}else
					Painel::alert('erro','Campos vazios não são valídos!');

				}
		?>
		<div class="form-group">
			<label>Nome</label>
			<input type="text" name="nome"  value="<?php echo $depoimento['nome']; ?>" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Depoimento</label>
			<textarea name="depoimento"  value="" ><?php echo $depoimento['depoimento'];?></textarea>
		</div><!--Form Group-->
		<div class="form-group">
			<label>Data</label>
			<input formato="data" type="data" name="data"  value="<?php echo $depoimento['data']; ?>" />
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="nome_tabela" value="tb_site.depoimentos" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->


