<?php
	if (isset($_GET['id'])) {
		$id = (int)$_GET['id'];	
		$slide = Painel::select('tb_site.slides','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID');
		die();
	}

?>

<div class="box-content">
	<h2 class="editar-usuario"><i class="fa fa-pencil" aria-hidden="true"></i> Editar SLide</h2>
	<form method="post" enctype="multipart/form-data">
		<?php
			if (isset($_POST['acao'])) {

				$nome = $_POST['nome'];
				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem_atual'];
				if($imagem['name'] != ''){


				if(Painel::imagemValida($imagem)){
					Painel::deleteFile($imagem_atual);
					$imagem= Painel::uploadFlie($imagem);
					$arr = ['nome'=>$nome, 'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_site.slides'];
					Painel::update($arr);
					$slide = Painel::select('tb_site.slides','id = ?',array($id));
					Painel::alert('sucesso','O slide e a imagem foi editado com sucesso!');
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
				}
						

				}else{
					$imagem=$imagem_atual;
					$arr = ['nome'=>$nome, 'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_site.slides'];
					Painel::update($arr);
					$slide = Painel::select('tb_site.slides','id = ?',array($id));
					Painel::alert('sucesso','O slide foi editado com sucesso!');
					
				}
			}


			else if(!isset($_POST['acao'])){
				Painel::alert('vazio','Preencha o formulário para atualizar seu usuario');
			}


		?>
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="nome" value="<?php echo $slide['nome']; ?>"/ required>
		</div><!--Form Group-->
		<div class="form-group">
			<label>Slide</label>
			<input type="file" name="imagem"/	>
			<input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>">
		</div><!--Form Group-->
		<div class="form-group" id="botao">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--Form Group-->
	</form>

</div><!--box-content-->