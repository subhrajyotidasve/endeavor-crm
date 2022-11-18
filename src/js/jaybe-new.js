$(function(){

	var link = $('.nav__link--has-children');
	// var subNav = $('.sub-nav');

    link.on('click', function(event){
        event.preventDefault();

		link.not(this).removeClass("nav__link--is-open").siblings('.sub-nav').fadeOut(600);
        $(this).toggleClass("nav__link--is-open").siblings('.sub-nav').fadeToggle(600);

        // This needs sorting
        $('html, body').toggleClass('no-scroll');
        $('#overlay').fadeToggle(600);

    });
        


});







