<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar Serviço</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if (isset($_POST['acao'])) {
						if(Painel::insert($_POST)){
							Painel::alert('sucesso','Seu depoimento foi cadastrado com sucesso!');
						}else{
							Painel::alert('erro','Campos Vazios não são permitidos!');
						}
						
					}
		?>
		<div class="form-group">
			<label>Serviço</label>
			<input type="text" name="servico" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Descrição do Serviço</label>
			<textarea name="descricao"></textarea>
		</div><!--Form Group-->
		<div class="form-group">
			<label>Nivel de Conhecimento</label>
			<input type="text" type="text" name="nivel" />
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="hidden" name="order_id" value="0" />
			<input type="hidden" name="nome_tabela" value="tb_site.servicos" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->


