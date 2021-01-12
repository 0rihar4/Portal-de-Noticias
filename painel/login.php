<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Painel de Controle</title>
			<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,600;0,800;1,800&display=swap">
		<link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>estilo/font-awesome.min.css">
		<link href="<?php echo INCLUDE_PATH_PAINEL;?>css/estilo.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="widht=device-widht, initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH_PAINEL;?>favicon.ico">
</head>
<body>
<?php
	
	if (isset($_COOKIE['lembrar'])) {
		$user = $_COOKIE['user'];
		$password = $_COOKIE['password'];
		$sql = MySql::conectar()-> prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
		$sql->execute(array($user,$password));
		if($sql->rowCount()==1){
			$info = $sql->fetch();
			$_SESSION['login']=true;
			$_SESSION['user']= $user;
			$_SESSION['password']=$password;
			$_SESSION['cargo']=$info['cargo'];
			$_SESSION['nome']=$info['nome'];
			$_SESSION['img']=$info['img'];	
			Painel::redirect(INCLUDE_PATH_PAINEL);
		}
	}

?>

		<div class="box-login">
			<?php 
				if (isset($_POST['acao'])) {
					//Susseco ao logar
					$user = $_POST['user'];
					$password = $_POST['password'];
					$sql = MySql::conectar()-> prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
					$sql->execute(array($user,$password));
					if ($sql->rowCount()==1) {
						$info = $sql->fetch();
						$_SESSION['login']=true;
						$_SESSION['user']= $user;
						$_SESSION['password']=$password;
						$_SESSION['cargo']=$info['cargo'];
						$_SESSION['nome']=$info['nome'];
						$_SESSION['img']=$info['img'];
						if(isset($_POST['lembrar'])){
							setcookie('lembrar',true,time()+(60*60*24),'/');
							setcookie('user',$user,time()+(60*60*24),'/');
							setcookie('password',$password,time()+(60*60*24),'/');
						}
						Painel::redirect(INCLUDE_PATH_PAINEL);
					}else{
						//erro ao logar
						echo "<div class='box-erro'><i class='fa fa-times'></i> Usuario ou senha estão incorretos!</div>";

					}
				}
			?>
		<div class="center">
			<fieldset>
				<legend>Efetue seu Login</legend>
				<form method="post">
					<input type="text" name="user" placeholder="Login" required>
					<input type="password" name="password" placeholder="Senha" required>
					<div class="form-group-login w50 left">
						<input type="submit" name="acao" value="Logar!">
					</div>
					<div class="form-group-login w50 right">
						<label>Lembrar-me</label>
						<input type="checkbox" name="lembrar"/>
					</div>
					<div class="clear"></div>
				</form>
			</fieldset>
		</div>
		</div>
		
</body>
</html>
<?php ob_end_flush(); ?>