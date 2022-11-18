$(function(){

    // Set up variables for links with sub navigation and the main navigation its self
    var hamburger = $('.nav-upper__link--menu'), link = $('.nav-main__link--has-children'), subMenu = $('.nav-main__sub-menu'), mainNav = $('.nav-main'), prodFilter = $('.lower-banner__filter-link'), fieldsetWrap = $('.lower-banner__set-wrap');

    // Hamburger click event
    hamburger.on('click', function(event){
        event.preventDefault();
        $(this).toggleClass('open');
        mainNav.toggleClass('nav-main--is-open');

        // If opening mobile menu turn off scroll bars, if closing return the scroll bars
        if(mainNav.hasClass('nav-main--is-open')) {
        	$('html, body').addClass('no-scroll');

        } else {
        	$('html, body').removeClass('no-scroll');
        }

        // Ensures that the sub menu(s) are left hidden and the products link has no open class, the open class is used for down state effects on the desktop nav
        subMenu.css("display", "none");
        $('#overlay').css("display", "none");
        link.removeClass('nav-main__link--has-children--is-open');
    });

	 var gmapCheck = 0;
	 jQuery('.wtb__ctas__high_street').click(function(){
		 if (gmapCheck == 0) {
		 	jQuery('#triggerGmap').click();
		}
		 jQuery('#app').addClass('show');
		 jQuery('.high_street_wrapper').removeClass('show');
		 gmapCheck++;
	 });
	 jQuery('.wtb__ctas__online').click(function(){
		 jQuery('#app').removeClass('show');
		 jQuery('.high_street_wrapper').addClass('show');
	 });
	 jQuery('.wtb__ctas div').click(function() {
		 jQuery('.wtb__ctas div').addClass('grey');
		 jQuery(this).removeClass('grey');
		 if (jQuery(window).width() <= 800) {
			 jQuery("html, body").animate({
				 scrollTop: jQuery('#main-content').position().top - 85
			 }, 300);
		 }
	 });

    // Window Re-size or orientation change event, used to reset main nav incase mobile navigation is left open by the user
    $(window).on('orientationchange resize', function(){

        // Only fire this function if mobile nav is open
        if (mainNav.hasClass('nav-main--is-open')) {
        	mainNav.removeClass('nav-main--is-open');
            $('html, body').removeClass('no-scroll');
            hamburger.removeClass('open');
        }

    });

    // Sub navigation click event
    $('.nav-main__link--has-children').on('click', function(event){
        event.preventDefault();

        // Here we find the sub menu associated with the click event, the global var subMenu just selects all sub menus if more than one exists
        var li = $(this).closest('li.nav-main__item--has-children'), subNavMenu = li.find('div.nav-main__sub-menu'), link = $(this);
        link.toggleClass('nav-main__link--has-children--is-open');

        if(mainNav.hasClass('nav-main--is-open')) {
            subNavMenu.slideToggle();

        } else {
            $('html, body').toggleClass('no-scroll');
            $('#overlay').fadeToggle(600);
            subNavMenu.fadeToggle(600);
        }
    });

    // Folding Bed Selector Filter Click event
    prodFilter.on('click', function(event) {
        event.preventDefault();

        $(this).toggleClass('lower-banner__filter-link--is-open');
        fieldsetWrap.toggleClass('lower-banner__set-wrap--is-open');
    });

    // Scroll animations
    $('a.answers__link, a.viewer__list-item-link, a.scroll-me, a.question__scroll-link').on('click', function(event) {

        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top
        }, 500);

        return false;
    });

    // Style file upload buttons on contact page
    $('#myFirstFile').change(function(event) {
        var $value = $(this).val().replace(/C:\\fakepath\\/i, '');
        $('.form__file-name--first').html($value);
    });

    $('#mySecondFile').change(function(event) {
        var $value = $(this).val().replace(/C:\\fakepath\\/i, '');
        $('.form__file-name--second').html($value);
    });

    // Ajax for Client Login
    $('#login').on('click', function() {

		var action=$("#login-form").attr('action');
		var form_data={username:$("#username").val(),password:$("#password").val(),is_ajax:1};

		$.ajax({type:"POST",url:action,data:form_data,success:function(response){

		if(response=='login-jaybe')window.location.href="/private/client-login/logged-in";
            else if(response=='login-jaybecommercial')window.location.href="/private/commercial-login/logged-in";
			else $("#message").html("<p class='form__error-message'>Sorry, please check your username and/or password and try again.</p>")}});
			return false})

});
