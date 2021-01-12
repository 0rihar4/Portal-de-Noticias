<?php ob_start(); ?>
<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Usuario</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if (isset($_POST['acao'])) {


				$nome = $_POST['nome'];
				$senha = $_POST['password'];
				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem_atual'];
				$usuario = new usuario();
				if($imagem['name'] != ''){


				if(Painel::imagemValida($imagem)){
					Painel::deleteFile($imagem_atual);
					$imagem= Painel::uploadFlie($imagem);
					if($usuario->atualizarUsuario($nome,$senha,$imagem)){
					$_SESSION['img'] = $imagem;
						Painel::alert('sucesso','Atualizado com sucesso junto com a imagem!');
					}else{
						Painel::alert('erro','Ocorreu um erro ao atualizar junto com a imagem');
					}
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
				}
						

				}else{
					$imagem=$imagem_atual;
					$usuario = New Usuario();
					if($usuario->atualizarUsuario($nome,$senha,$imagem)){

						Painel::alert('sucesso','Atualizado com Sucesso!');

					}else{

						Painel::alert('erro','Aconteceu algum erro!');

					}
				}
			}


			else if(!isset($_POST['acao'])){
				Painel::alert('vazio','Preencha o formulário para atualizar seu usuario');
			}


		?>
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>"/ required>
		</div><!--Form Group-->
		<div class="form-group">
			<label>Senha</label>
			<input type="password" name="password"  value="<?php echo $_SESSION['password']; ?>"/ required>
		</div><!--Form Group-->
		<div class="form-group">
			<label>Foto de Perfil</label>
			<input type="file" name="imagem"/	>
			<input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->