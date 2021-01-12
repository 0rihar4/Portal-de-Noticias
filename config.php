<?php	
	ob_start(); 
	session_start();

	date_default_timezone_set('America/Sao_Paulo');
	$autoload = function($class){
		if ($class == 'Email') {
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);


 	define('INCLUDE_PATH', 'http://portal.trobcusbr.com/');
 	define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');


 	define('BASE_DIR_PAINEL',__DIR__.'/painel');


 	//Conectar no Banco de dados
 	define('HOST', 'localhost');
 	define('USER', 'root');
 	define('PASSWORD', '');
 	define('DATABASE', '');

 	//Nome da Empresa
 	define('NOME_EMPRESA', 'Space Marketing');

 	//Cargos da Empresa
 		/*
 		$cargos= [
 			'0'=> 'normal',
 			'1'=> 'CEO/Administrador',
 			'2'=> 'Administrador',
 			'3'=> 'Editor'
 		];
 		*/

 	//Funções do Painel
 	function pegaCargo($indice){
 		return Painel::$cargos[$indice];

 	}
 	function selecionadoMenu($par){
 		//<i class="fas fa-angle-right"></i>
 		$url = explode('/',@$_GET['url'])[0];
 		if($url == $par){
 			echo 'class="menu-active "';
 		}

 	}
 	function iconeMenu($par){
 		$url = explode('/',@$_GET['url'])[0];
 		if($url == $par){
 			echo 'class="fa fa-home"';
 		}
	}

	function verificarPermissaoMenu($permissao){
		if ($_SESSION['cargo'] >= $permissao) {
			return ;
		}else{
			echo 'style= "display:none;"';
		}
	}

	function verificarPermissaoPaguna($permissao){
		if ($_SESSION['cargo'] = $permissao){
			return;
		}else{
			include('pages/permissao_negada.php');
			die();
		}
	}

	function recoverPost($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}

	}
 
?>