<?php  $usuarioOnline = Painel::listarUsuariosOnline(); ?>
<?php  $totalDeVisitas = Site::pegarVisitaTotais(); ?>
<?php  $totalDeVisitaHoje = Site::pegarVisitaHoje(); ?>

<div class="box-content left w100">
		<h2><i class="fa fa-home"></i>Painel de Controle - <?php echo NOME_EMPRESA; ?></h2>
		
		<div class="box-metricas">
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Usuários Online</h2>
				<p><?php echo count($usuarioOnline); ?></p>
				</div><!--Box Metrica Wraper-->
			</div><!--Box Metrica Single-->
		
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Total de Acessos</h2>
					<p><?php echo  $totalDeVisitas; ?></p>
				</div><!--Box Metrica Wraper-->
			</div><!--Box Metrica Single-->
		
		
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Visitas Hoje</h2>
					<p><?php echo  $totalDeVisitaHoje; ?></p>
				</div><!--Box Metrica Wraper-->
			</div><!--Box Metrica Single-->
		
		<div class="clear"></div>
		</div><!--Box Metricas-->

	
</div>
<div class="box-content w100 left">
<h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuários Online no Site</h2>

	<div class="table-responsive">
		<div class="row">
			<div class="col">
				<span>IP</span>
			</div><!--col-->
			<div class="col">
				<span>Última Ação</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->


			<?php
			
			foreach ($usuarioOnline as $key => $value) {
				# code...
			
			?>
			<div class="row">
				<div class="col">
					<span><?php echo $value['ip']; ?></span>
				</div><!--COL-->
				<div class="col">
					<span><?php echo date('d/m/Y H:m:s',strtotime($value['ultima_acao'])); ?></span>
				</div><!--COL-->
				<div class="clear"></div>
			</div><!--ROW-->

			<?php } ?>
		</div><!--table-responsive-->
		<div class="clear"></div>
</div><!--Box Content-->

<div class="box-content w100 left">
<h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuários Online do Painel</h2>

	<div class="table-responsive">
		<div class="row">
			<div class="col">
				<span>Nome</span>
			</div><!--col-->
			<div class="col">
				<span>Cargo</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->


			<?php
			
			$usuariosPainel = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
			$usuariosPainel->execute();
			$usuariosPainel = $usuariosPainel->fetchAll();
			foreach ($usuariosPainel as $key => $value) {
				# code...
			
			?>
			<div class="row">
				<div class="col">
					<span><?php echo $value['nome']; ?></span>
				</div><!--COL-->
				<div class="col">
					<span><?php echo pegaCargo($value['cargo']); ?></span>
				</div><!--COL-->
				<div class="clear"></div>
			</div><!--ROW-->

			<?php } ?>
		</div><!--table-responsive-->
		<div class="clear"></div>
</div><!--Box Content-->