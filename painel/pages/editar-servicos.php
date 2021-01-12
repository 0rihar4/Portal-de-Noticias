<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];	
		$servico = Painel::select('tb_site.servicos','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID');
		die();
	}

?>
<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Serviços</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if (isset($_POST['acao'])) {
				if(Painel::update($_POST)){
					Painel::alert('sucesso','Serviço foi editado com sucesso!');
					$servico = Painel::select('tb_site.servicos','id = ?',array($id));
				}else
					Painel::alert('erro','Campos vazios não são valídos!');

				}
		?>
		<div class="form-group">
			<label>Serviço</label>
			<textarea name="servico"  value="" ><?php echo $servico['servico'];?></textarea>
		</div><!--Form Group-->
		<div class="form-group">
			<label>Descrição do Serviços</label>
			<input type="text" name="descricao"  value="<?php echo $servico['descricao']; ?>" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Nível de Conhecimento</label>
			<input type="text" name="nivel"  value="<?php echo $servico['nivel']; ?>" />
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="nome_tabela" value="tb_site.servicos" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->


