<?php
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];	
		$noticias = Painel::select('tb_site.noticiais','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID');
		die();
	}

?>

<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Noticia</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if (isset($_POST['acao'])) {
				$categoria_id = $_POST['categoria_id'];
				$titulo = $_POST['titulo'];
				$conteudo = $_POST['conteudo'];
				$imagem = $_FILES['capa'];
				$imagem_atual = $_POST['imagem_atual'];

				$verifica= MySql::conectar()->prepare("SELECT * FROM `tb_site.noticiais` WHERE titulo=? AND 'categoria'=? AND id !=?");
				$verifica->execute(array($titulo,$_POST['categoria_id'],$id));
				
				if($verifica->rowCount()==0){
				if($imagem['name'] != ''){
				if(Painel::imagemValida($imagem)){
					Painel::deleteFile($imagem_atual);
					$imagem= Painel::uploadFlie($imagem);
					$slug = Painel::generateSlug($titulo);
					$arr = ["categoria_id"=>$categoria_id,"data"=>date('Y-m-d') ,'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug, 'id'=>$id,'nome_tabela'=>'tb_site.noticiais'];
					Painel::update($arr);
					$capa = Painel::select('tb_site.noticiais','id = ?',array($id));
					Painel::alert('sucesso','A noticia e a imagem foram editados com sucesso!');
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
				}
						

				}else{
					$imagem=$imagem_atual;
					$slug = Painel::generateSlug($titulo);
					$arr = ["categoria_id"=>$categoria_id,"data"=>date('Y-m-d') ,'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug, 'id'=>$id,'nome_tabela'=>'tb_site.noticiais'];
					Painel::update($arr);
					$capa = Painel::select('tb_site.noticiais','id = ?',array($id));
					Painel::alert('sucesso','A noiticia foi editada com sucesso!');
					
				}
			}else{
				Painel::alert('erro','Já Existe uma noticia com esse nome!');
			}
			}


		?>
		<div class="form-group">
			<label>Titulo</label>
			<input type="text" name="titulo" value="<?php echo $noticias['titulo']; ?>"/ required>
		</div><!--Form Group-->

		<div class="form-group">
			<label>Categoria</label>
		<select name="categoria_id">
			<?php
				$categorias = Painel::selectAll('tb_site.categorias');
				foreach ($categorias as $key => $value) {
			?>
			<option <?php if($value['id'] == $noticias['id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"> <?php echo $value['nome']; ?></option>
			<?php } ?>
		</select>
		</div><!--Form Group-->

		<div class="form-group">
			<div class="form-group">
			<label>Conteudo</label>
			<textarea class="tinymce" type="text" name="conteudo"><?php echo $noticias['conteudo']; ?></textarea> 
		</div><!--Form Group-->
		<div class="form-group">
			<label>Capa</label>
			<input type="file" name="capa"/	>
			<input type="hidden" name="imagem_atual" value="<?php echo $noticias['capa']; ?>">
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->