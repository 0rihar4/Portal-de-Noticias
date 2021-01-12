<?php
	verificarPermissaoPaguna(3);
?>
<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Cadastrar Slides</h2>
	<form method="post" enctype="multipart/form-data">
		<?php

			if (isset($_POST['acao'])) {
				$nome = $_POST['nome'];
				$imagem = $_FILES['slide'];

				if($nome==''){
					Painel::alert('erro','Campo nome não pode ficar vazio!');
				}else{
					//podemos cadastrar
					if(Painel::imagemValida($imagem) == false){
						Painel::alert('erro','Selecione uma extensão de imagem valida!');
					}else{
						//Apenas cadastrar no banco de dados
						include("../classes/lib/WideImage.php");
						$imagem = Painel::uploadFlie($imagem);
						WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
						$arr = ['nome'=>$nome, 'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'tb_site.slides'];
						Painel::insert($arr);
						Painel::alert('sucesso','Cadastro do Slide foi feito com sucesso!');
					}
				}

			}


			else if(!isset($_POST['acao'])){
				Painel::alert('vazio','Preencha o formulário para atualizar seu usuario');
			}


		?>
		<div class="form-group">
			<label>Nome do Slide</label>
			<input type="text" name="nome" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Imagem do Slide</label>
			<input type="file" name="slide" />
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->