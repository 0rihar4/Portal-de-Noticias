<?php ob_start(); ?>
<?php
	verificarPermissaoPaguna(3);
?>
<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar Usuario</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if (isset($_POST['acao'])) {
				$login = $_POST['login'];
				$nome = $_POST['nome'];
				$senha = $_POST['password'];
				$imagem = $_FILES['imagem'];
				$cargo = $_POST['cargo'];
				$cadastro = new usuario();

				if($login==''){
					Painel::alert('erro','Campo login está vazio!');
				}else if($nome==''){
					Painel::alert('erro','Campo nome está vazio!');
				}else if($senha==''){
					Painel::alert('erro','Campo senha está vazio!');
				}else if($imagem==''){
					Painel::alert('erro','Campo imagem está vazio!');
			
				}else if($imagem['name'] == ''){
					Painel::alert('erro','A imagem precise está selecionada');
				}else if($cargo == ''){
					Painel::alert('erro','Selecione o seu cargo!');
				}else{
					//podemos cadastrar
					if ($cargo >= $_SESSION['cargo']) {
						Painel::alert('erro','Você não tem permissão hierarquicaca suficiente para selecionar esse cargo!');
					}else if(Painel::imagemValida($imagem)){
						Painel::alert('erro','Selecione uma extensão de imagem valida!');
					}else if(usuario::userExists($login)){
						Painel::alert('erro','Login ja em uso, selecione outro por favor!');
					}
					else{
						//Apenas cadastrar no banco de dados
						$cadastro = new usuario();
						$imagem = Painel::uploadFlie($imagem);
						$cadastro->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
						Painel::alert('sucesso','Cadastro do Usuario '.$login.' foi feito com suceso!');
					}
				}

			}


			else if(!isset($_POST['acao'])){
				Painel::alert('vazio','Preencha o formulário para atualizar seu usuario');
			}


		?>
		<div class="form-group">
			<label>Login</label>
			<input type="text" name="login" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="nome" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Senha</label>
			<input type="password" name="password" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Cargo</label>
			<select name="cargo">
				<?php 
					foreach (Painel::$cargos as $key => $value) {
						if($key < $_SESSION['cargo'])echo '<option value="'.$key.'">'.$value.'</option>';
					}
				?>
			</select>
		</div><!--Form Group-->
		<div class="form-group">
			<label>Foto de Perfil</label>
			<input type="file" name="imagem" />
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->