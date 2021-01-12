$(function(){
	var atual = -1;
	var maximo = $('.box-especialidades').length - 1;
	var timer;
	var animacaoDelay = 3;

	executarAnimacao();
	function executarAnimacao(){
		$('.box-especialidades').hide();
		timer = setInterval(logicaAnimacao, animacaoDelay*300);
		function logicaAnimacao(){
			atual ++;
			if (atual>maximo) {
				clearInterval(timer);
				return false;
			}
			$('.box-especialidades').eq(atual).fadeIn();
		}
	}
})