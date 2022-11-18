$(function(){

	var defer = $.Deferred();


	$('.carousel-main img').ready(function(){
		setTimeout(function(){
			defer.resolve();
		}, 1000);

	});

	defer.promise().then(function(){

		$('.carousel-main img').ready(function(){
			$('.carousel').css('visibility', 'visible');
			if($('.animated-loader').length){
				$('.animated-loader').remove();
			}
		});

	});

});
