<?php
		include('../config.php');
		$data = array();
		$assunto = 'Nova Mensagem no Site!';
		$corpo = '';
		foreach ($_POST as $key => $value) {
			$corpo.=ucfirst($key).": ".$value;
			$corpo.="<hr>";
		}
		$info = array('assunto'=>$assunto,'corpo'=>$corpo);
		$mail = new Email('br480.hostgator.com.br' ,'projeto@trobcusbr.com' ,'joaovitor1234' ,'Suporte');
		$mail->addAdress('projeto@trobcusbr.com','Suporte');
		$mail->formatarEmail($info);
		if ($mail->enviarEmail()) {
			$data['sucesso'] = true;
		}else{
			$data['erro'] = true;
		}
		
		die(json_encode($data));
?>