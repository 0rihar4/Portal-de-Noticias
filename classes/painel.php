<?php
ob_start(); 
	class Painel{

		public static  $cargos= [
 			'0'=> 'normal',
 			'1'=> 'Editor',
 			'2'=> 'Sub-Administrado',
 			'3'=> 'Administrador'
 		];

 		/*METODO PARA GERAR SLUG DA URL*/
 		public static function generateSlug($str){
			$str = mb_strtolower($str);
			$str = preg_replace('/(â|á|ã|à)/', 'a', $str);
			$str = preg_replace('/(ê|é)/', 'e', $str);
			$str = preg_replace('/(í|Í)/', 'i', $str);
			$str = preg_replace('/(ú)/', 'u', $str);
			$str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
			$str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
			$str = preg_replace('/( )/', '-',$str);
			$str = preg_replace('/ç/','c',$str);
			$str = preg_replace('/(-[-]{1,})/','-',$str);
			$str = preg_replace('/(,)/','-',$str);
			$str=strtolower($str);
			return $str;
		}

 		/*METODO PARA EXIBIR VALIDAR USUARIO LOGADO */
		public static function Logado(){
			return isset($_SESSION['login']) ? true : false;
		}
		/*METODO PARA DESLOGAR*/
		public static function logout(){
			setcookie('lembrar',true,time()-1,'/');
			session_destroy();
			Painel::redirect('location'.INCLUDE_PATH_PAINEL);
		}
		/*METODO PARA CARREGAR A PAGINA PRINCIPAL DO PAINEL*/
		public static function carregarPainel(){
			if (isset($_GET['url'])) {
				$url = explode('/', $_GET['url']);
				if (file_exists('pages/'.$url[0].'.php')) {
					include('pages/'.$url[0].'.php');
				}else{
					//Quando a Pagina nn existir!
					Painel::redirect('location'.INCLUDE_PATH_PAINEL);
				}
			}else{
				include("pages/home.php");
			}
		}
		/*METODO PARA LISTAR OS USUARIOS QUE JA ACESSARAM O SITE EM UM TOTAL*/
		public static function listarUsuariosOnline(){
			self::limparUsuariosOnline();
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.online`");
			$sql->execute();
			return $sql->fetchAll();
		}
		/*METODO PARA LIMPAR O ID DO USUARIO QUE FICOU INATIVO NO SITE POR MAIS DE UM MINUTO*/
		public static function limparUsuariosOnline(){
			$date = date('Y-m-d H:i:s');
			$sql = MySql::conectar()->exec("DELETE FROM `tb_admin.online` WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE ");
		}
		/*METODO PARA ALERTAR ALGUMA MENSAGEM NO SITE*/
		public static function alert($tipo,$mensagem){
			if ($tipo =='sucesso') {
				echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> '.$mensagem.'</div>';
			}else if($tipo=='erro'){
				echo '<div class=" box-alert erro"><i class="fa fa-times"></i> '.$mensagem.'</div>';
			}else if($tipo=='vazio'){
				echo '<div class=" box-alert vazio"  id="centro"><i class="fa fa-map-pin"></i> '.$mensagem.'</div>';
			}

		}
		/*METODO PARA VALIDAR A EXTENSÃO DE UMA IMAGEM*/
		public static function imagemValida($imagem){
			if($imagem['type'] == 'image/jpeg' ||
				$imagem['type'] == 'imagem/jpg' ||
				$imagem['type'] == 'imagem/png'){

				$tamanho = intval($imagem['size']/1024);
				if($tamanho >= 900000)
					return true;
				else
					return false;
			}else{
				return false;
			}
		}
		/*METODO PARA SUBIR UM ARQUIVO PARA O BANDO DE DADOS*/
		public static function uploadFlie($file){
			$formatoArquivo = explode('.',$file['name']);
			$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo)-1];
			if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$imagemNome))
				return $imagemNome;
			else{
				return false;
			}
		}
		/*METODO PARA DELETAR UM ARQUIVO DO BANCO DE DADOS*/
		public static function deleteFile($file){
			@unlink('uploads/'.$file);

		}
		
		/* METODO PARA INSERIR ALGO NO BANCO DE DADOS*/
		public static function insert($arr){
			$certo = true;
			$nome_tabela = $arr['nome_tabela'];
			$query = "INSERT INTO `$nome_tabela` VALUES (null";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				$query.=",?";
				$parametros[] = $value;
			}

			$query.=")";
			if($certo == true){
				$sql = MySql::conectar()->prepare($query);
				$sql->execute($parametros);
				$lastId = MySql::conectar()->lastInsertId();
				$sql = MySql::conectar()->prepare("UPDATE `$nome_tabela` SET order_id=? WHERE id = $lastId");
				$sql->execute(array($lastId));
			}
			return $certo;
		}
		/*METODO PARA ATUALIZAR DADOS DE UMA TABELA*/
		public static function update($arr,$single = false){
			$certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];

			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				
				if($first == false){
					$first = true;
					$query.="$nome=?";
				}
				else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}

			if($certo == true){
				if($single == false){
					$parametros[] = $arr['id'];
					$sql = MySql::conectar()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);
				}else{
					$sql = MySql::conectar()->prepare($query);
					$sql->execute($parametros);
				}
			}
			return $certo;
		}



		/*METODO PARA SELECIONAR UMA TABELA*/
		public static function selectAll($tabela, $star = null, $end = null){
			if($star == null && $end == null){
						$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC");
					}else{
						$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC LIMIT $star,$end");
					}
			$sql->execute();
			return $sql->fetchALL();	
		}

		/*METODO PARA SELECIONAR UMA TABELA 2 (Sem order id)*/
		public static function selectAll2($tabela, $star = null, $end = null){
			if($star == null && $end == null){
						$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY id ASC");
					}else{
						$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY id ASC LIMIT $star,$end");
					}
			$sql->execute();
			return $sql->fetchALL();	
		}
		/*METODO PARA APAGAR UM DADO DE UMA TABELA*/
		public static function deletar($tabela, $id=false){
			if ($id==false) {
				$sql = MySql::conectar()->prepare("DELETE FROM `$tabela`");
			}else{
				$sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE id = $id ");
			}
			$sql->execute();
		} 
		/*METODO PARA REDIRECIONAR UMA PAGINA (ESTÁ ZICADO)*/
		public static function redirect($url){
			echo '<script>location.href="'.$url.'"</script>';
			die();
		}
		/* METODO ESPECIFICO PARA SELECIONAR APENAS UM REGISTRO */
		public static function select($table,$query = '',$arr = ''){
			if($query != false){
				$sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
				$sql->execute($arr);
			}else{
				$sql = MySql::conectar()->prepare("SELECT * FROM `$table`");
				$sql->execute();
			}
			return $sql->fetch();
		}

		/*METODO PARA ORDERNAR ITENS NO PAINEL*/
		public static function orderItem($tabela,$orderType,$idItem){
				if($orderType == 'up'){
				$infoItemAtual = Painel::select($tabela,'id=?',array($idItem));
				$order_id = $infoItemAtual['order_id'];
				$itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
				$itemBefore->execute();
				if($itemBefore->rowCount() == 0)
					return;
				$itemBefore = $itemBefore->fetch();
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
				}else if ($orderType == 'down') {
				$infoItemAtual = Painel::select($tabela,'id=?',array($idItem));
				$order_id = $infoItemAtual['order_id'];
				$itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY id ASC LIMIT 1");
				$itemBefore->execute();
				if($itemBefore->rowCount() == 0)
					return;
				$itemBefore = $itemBefore->fetch();
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
				}

		}
	}/*FINAL DA CLASSE PAINEL*/
ob_flush();
?>