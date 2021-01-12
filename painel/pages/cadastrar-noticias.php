<?php
	verificarPermissaoPaguna(2);
?>
<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Cadastrar Noticias</h2>
	<form method="post" enctype="multipart/form-data">
		<?php

			if (isset($_POST['acao'])) {
				$categoria_id = $_POST['categoria_id'];
				$titulo = $_POST['titulo'];
				$conteudo = $_POST['conteudo'];
				$capa = $_FILES['capa'];

				if($titulo == '' || $conteudo == ''){
					Painel::alert('erro','Campos vazios não são permitidos');
					}else if($capa['tmp_name']== ''){
					Painel::alert('erro','Selecione uma imagem de capa!');	
					}else{
						if(Painel::imagemValida($capa)){
							$verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticiais` WHERE titulo=? AND categoria_id=?");
							$verifica->execute(array($titulo,$categoria_id));
							if($verifica->rowCount() == 0){
							$imagem = Painel::uploadFlie($capa);
							$slug = Painel::generateSlug($titulo);
							$arr = ["categoria_id"=>$categoria_id,"data"=>date('Y-m-d') ,"titulo"=>$titulo,"conteudo"=>$conteudo,"capa"=>$imagem,"slug"=>$slug,
									"order_id"=>'0',
									"nome_tabela"=>'tb_site.noticiais'
									];
									if(Painel::insert($arr)){
										Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-noticias');
									}
							}else{
								Painel::alert('erro','Já tem uma noticia cadastrada com esse nome!');
							}
						}else{
							Painel::alert('erro','Selecione uma imagem valida!');
						}
					}
			}/*IF DO POST AÇÃO FAZENDO A VALIDAÇÃO DOS CAMPOS DO FORMULARIOS PARA CADASTRO NO BANCO DE DADOS*/
			if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
				Painel::alert('sucesso','O cadastro da Noticia foi feito com sucesso!');
			}


		?>
		<div class="form-group">
			<label>Categoria</label>
		<select name="categoria_id">
			<option disabled selected>Selecione uma categoria</option>
			<?php
				$categorias = Painel::selectAll('tb_site.categorias');
				foreach ($categorias as $key => $value) {
			?>
			<option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"> <?php echo $value['nome']; ?></option>
			<?php } ?>
		</select>
		</div><!--Form Group-->
		<div class="form-group">
			<label>Titulo da Notícia</label>
			<input type="text" name="titulo" value="<?php recoverPost('titulo'); ?>" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Capa da Notícia</label>
			<input type="file" name="capa" />
		</div><!--Form Group-->
		<div class="form-group">
			<label>Conteúdo</label>
			<textarea class="tinymce" name="conteudo" value=""><?php recoverPost('conteudo'); ?> </textarea>
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="hidden" name="order_id" value="0" />
			<input type="hidden" name="nome_tabela" value="tb_site.noticiais" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->