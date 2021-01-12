<?php
	verificarPermissaoPaguna(3);
?>
<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Cadastrar Categoria</h2>
	<form method="post" enctype="multipart/form-data">
		<?php

			if (isset($_POST['acao'])) {
				$nome = $_POST['nome'];
				if($nome=='')
					Painel::alert('erro','Campo nome não pode ficar vazio!');
			else{
				//Apenas cadastrar no banco de dados

				$verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ?");
				$verificar->execute(array($_POST['nome']));
				
				if($verificar->rowCount()==0){
				$slug = Painel::generateSlug($nome);
				$arr = ['nome'=>$nome, 'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'tb_site.categorias'];
				Painel::insert($arr);
				Painel::alert('sucesso','Cadastro da categoria foi feito com sucesso!');
				}else{
					Painel::alert('erro','Já existe uma categoria com esse nome');
				}	
			}
		}

		?>
		<div class="form-group">
			<label>Nome da Categoria: </label>
			<input type="text" name="nome" />
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="submit" name="acao" value="Cadastrando">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->