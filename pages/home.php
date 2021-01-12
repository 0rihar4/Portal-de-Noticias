<?php  
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 4;
$dadosDepoimento = Site::selectAll('tb_site.depoimentos', ($paginaAtual -1)*$porPagina , $porPagina*$paginaAtual); 
$dadosServicos = Site::selectAll('tb_site.servicos', ($paginaAtual -1)*$porPagina , $porPagina*$paginaAtual);



 ?>
<section class="banner-container">
	<div style="background-image: url('<?php echo INCLUDE_PATH;?>/imagens/banner.jpg')" class="banner-single"></div><!--Banner Single-->
	<div style="background-image: url('<?php echo INCLUDE_PATH;?>/imagens/banner2.jpeg')" class="banner-single"></div><!--Banner Single-->
	<div style="background-image: url('<?php echo INCLUDE_PATH;?>/imagens/banner3.jpg')" class="banner-single"></div><!--Banner Single-->
		<div class="overlay"></div>
		<form class="ajax-form" method="post">
			<div class="center">
			<h2>Qual o seu melhor e-mail?</h2>
			<input type="text" name="email" required/>
			<input type="hidden" name="identificador" value="form_home" />
			<input type="submit" name="acao" value="Cadastrar!">
			</div><!--Center-->
		</form>

	</section><!--Banner Principal-->
	<section class="descricao-autor">
		<div class="center">
		<div class="w50 left">
			<h2><?php echo $infoSite['nome_autor']; ?></h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu nunc lorem. Phasellus ut laoreet nisi. Morbi euismod vehicula urna, ac rhoncus ante fringilla sit amet. Curabitur elementum porta pulvinar. Vivamus efficitur volutpat elit vitae ullamcorper. Mauris tincidunt urna vitae diam elementum, ut blandit massa vestibulum. Pellentesque pellentesque eros eu bibendum tempus. In quis facilisis nisl. Donec et tortor lacus. Maecenas aliquam convallis ultrices. Praesent orci lectus, pretium vel lorem sit amet, blandit porta ligula. Cras et tempor risus. Aliquam ac urna vehicula, elementum metus in, ultrices libero. Fusce vulputate ipsum id consectetur consequat. Nunc sapien nisl, rutrum sed lacinia at, fermentum in leo. Suspendisse interdum luctus mauris et bibendum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu nunc lorem. Phasellus ut laoreet nisi. Morbi euismod vehicula urna, ac rhoncus ante fringilla sit amet. Curabitur elementum porta pulvinar. Vivamus efficitur volutpat elit vitae ullamcorper. Mauris tincidunt urna vitae diam elementum, ut blandit massa vestibulum. Pellentesque pellentesque eros eu bibendum tempus. In quis facilisis nisl. Donec et tortor lacus. Maecenas aliquam convallis ultrices. Praesent orci lectus, pretium vel lorem sit amet, blandit porta ligula. Cras et tempor risus. Aliquam ac urna vehicula, elementum metus in, ultrices libero. Fusce vulputate ipsum id consectetur consequat. Nunc sapien nisl, rutrum sed lacinia at, fermentum in leo. Suspendisse interdum luctus mauris et bibendum.</p>
	    </div> <!--Descrição-->
	    <div class="w50 left">
	    	<img class="right" src="<?php echo INCLUDE_PATH;?>imagens/foto.jpg">
	    </div> <!--Foto-->
		<div class="clear"></div>
		</div><!--Center-->
	</section><!--Autor-->
	<section class="especialidades">
		<div class="center">
		<h2 class="title">Especialidades</h2>
			<div class="w33 left box-especialidades">
				<h3><i class="<?php echo $infoSite['icone1']; ?>" aria-hidden="true"></i></h3>
				<h4>CSS 3</h4>
				<p><?php echo $infoSite['descricao1']; ?></p>
			</div><!--Box Especialidades-->
			<div class="w33 left box-especialidades">
				<h3><i class="<?php echo $infoSite['icone2']; ?>" aria-hidden="true"></i></h3>
				<h4>HTML 5</h4>
				<p><?php echo $infoSite['descricao2']; ?></p>
			</div><!--Box Especialidades-->
			<div class="w33 left box-especialidades">
				<h3><i class="<?php echo $infoSite['icone3']; ?>" aria-hidden="true"></i></h3>
				<h4>JavaScript</h4>
				<p><?php echo $infoSite['descricao3']; ?></p>
			</div><!--Box Especialidades-->
			<div class="clear"></div>
		</div><!--Center-->
	 </section><!--Section Especialidades-->

	 <section class="extras">
		<div class="center">
		<div id="depoimentos" class="w50 left depoimentos-conteiner">
				<h2 title="title" class="title">Depoimentos</h2>
				
				<?php foreach ($dadosDepoimento as $key => $value) {
					
				 ?>
				<div class="depoimento-single">
					<p class="depoimento-descricao"><?php echo $value['depoimento']; ?></p>
					<p class="nome-autor"><?php echo $value['nome']; ?></p>	
				</div><!--Depoimento Single-->
				<?php } ?>

			</div>

			<div class="w50 left servicos-conteiner">
				<h2 class="title">Serviço</h2>
				<div id="servicos" class="servicos">
					<ul>
						<?php foreach ($dadosServicos as $key => $value) { ?> 
						<li> 
							<p class="nome-autor"><?php echo$value['servico'].' Nivel: '.$value['nivel'];  ?></p>
							<p class="depoimento-descricao"><?php echo $value['descricao']; ?></p>	

						</li>
						<?php } ?>
					
					</ul>
				</div><!--Serviços-->
			</div><!--W50-->
		</div><!--Center-->
			<div class="clear"></div>
	</section><!--Extra-->