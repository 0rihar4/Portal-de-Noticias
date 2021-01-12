$(function(){


	$('body').on('submit','form.ajax-form',function(){
		var form = $(this);
		$.ajax({
			beforeSend:function(){
				$('.overlay-loading').fadeIn();
			},
			url:include_path+'ajax/formularios.php',
			method:'post',
			dataType: 'json',
			data:form.serialize()
		}).done(function(data){
			if (data.sucesso) {
				$('.overlay-loading').fadeOut();
				$('.sucesso').fadeIn();
				setTimeOut(function(){
					$('.sucesso').fadeOut();
				},3000)
			}else{
			  	$('.overlay-loading').fadeOut();
			  	$('.erro').fadeIn();
				setTimeOut(function(){
					$('.erro').fadeOut();
				},3000)
				}
		});
		return false;
	})
})