$(function(){
	var open = true;
	var windowSize = $(window)[0].innerWidth;

	var targetSizeMenu = (windowSize <= 400) ? 200 : 300;	

	if(windowSize <= 768){
		open = false;
	}

	$('.menu-btn').click(function(){
		if(open){
			//O menu está aberto e precisamos adaptar o conteudo do nosso site
			$('.menu-aside').animate({'width':'0','padding':'0'}, function(){
				open=false;
			});
			$('.content,header').css({'width':'100%'});
			$('.content,header').animate({'left':'0'}, function(){
				open=false;
			});
		}else{
			$('.menu-aside').css('display','block');
			$('.menu-aside').animate({'width': targetSizeMenu+'px','padding':'10px'}, function(){
				open=true;
			});
			//$('.content,header').css({'width':'calc(100% - 300px)'});
			$('.content,header').animate({'left': targetSizeMenu+'px'}, function(){
				open=true;
			});

		}
	})

	$(window).resize(function(){
		windowSize = $(window)[0].innerWidth;
		if (windowSize <= 768){
			$('.menu-aside').css('width','0').css('padding','0');
			$('content , header').css('width','100%').css('left','0');
			open = false;
		}else{
			open = true;
			$('.content , header').css('width','calc(100% - 250px)').css('left','250px');
			$('.menu-aside').css('width','250px').css('padding','10px 0');

		}
	})
	$('[formato=data]').mask('99/99/9999');
	$('[actionBtn=delete').click(function(){
		var txt;
		var r = confirm("Deseja Excluir esse Registro?Se este registro tiver dados remanescentes(categoria->Noticia), todos os dados serão apagados.");
		if (r == true) {
		  return true;
		} else {
		  return false;
		}
	})
})