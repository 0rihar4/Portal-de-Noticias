<?php
	ob_start(); 
	class Site{

		/*METODO PARA ADICIONAR O USUARIO ONLINE*/
		public static function updateUsuarioOnline(){
			if (isset($_SESSION['online'])) {
				$token = $_SESSION['online'];
				$horarioAtual = date('Y-m-d H:i:s');
				$check = MySql::conectar()->prepare("SELECT 'id' FROM `tb_admin.online` WHERE token = ? ");
				$check->execute(array($_SESSION['online']));

				if ($check->rowCount() == 1) {
					$sql = MySql::conectar()->prepare("UPDATE  `tb_admin.online` SET ultima_acao = ? WHERE token = ?"); 
					$sql->execute(array($horarioAtual,$token));
				}else{
					$ip = $_SERVER['REMOTE_ADDR'];
					$token = $_SESSION['online'];
					$horarioAtual = date('Y-m-d H:i:s');
					$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)"); 
					$sql->execute(array($ip,$horarioAtual,$token));
				}

			}else{
				$_SESSION['online'] = uniqid();
				$ip = $_SERVER['REMOTE_ADDR'];
				$token = $_SESSION['online'];
				$horarioAtual = date('Y-m-d H:i:s');
				$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)"); 
				$sql->execute(array($ip,$horarioAtual,$token));
			}
		}

		/*METODO QUE VAI FAZER O COOKIE PARA LEMBRAR LOGIN*/
		public static function contador(){
			ob_start();
			if(!isset($_COOKIE['visita'])){
				setcookie('visita','true',time() + (60*60*24*7));
				$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.visitas` VALUES (null,?,?)");
				$sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
			}
			ob_end_flush();
		}
		/*METODO PARA AMARZENAR TOTAL DE VISITAS*/
		public static function pegarVisitaTotais(){
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
			$sql->execute();
			return $sql->rowCount();
		}
		/*METODO PARA PEGAR A VISITAS DO DIA*/
		public static function pegarVisitaHoje(){
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
			$sql->execute(array(date('Y-m-d')));
			return $sql->rowCount();
		}

		/*METODO PARA SELECIONAR DETERMINADA TABELA*/
		public static function selectAll($tabela, $star = null, $end = null){
			if($star == null && $end == null){
						$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela`");
					}else{
						$sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id desc LIMIT 4");
					}
			$sql->execute();
			return $sql->fetchALL();	
		}

		
	}

	ob_end_flush();
?>