var functions = {

	default: function() {

		// Lightbox for YouTube videos
	    // $('.popup-youtube').magnificPopup({
	    //     type:'iframe'
	    // });

	    // Validate forms
	    $("#contact-form, #request-form, #question-form, #application-form, #register-account, #profile-edit, #register-product").validate();

	},
	cart_details: function() {

		$('#billing_checkbox').change(function(){

			if (this.checked) {
				$('#billing_address').css('opacity', 1).slideUp('slow').animate(
					{ opacity: 1 },
					{ queue: false, duration: 'slow' }
				);
			} else {
				$('#billing_address').css('opacity', 0).slideDown('slow').animate(
					{ opacity: 1 },
					{ queue: false, duration: 'slow' }
				);
			}
		});

		var modal = document.getElementById("login_modal");
		var modal_close_top = document.getElementsByClassName("close")[0];
		var modal_close_button = document.getElementsByClassName("close")[1];
		var modal_close_button_2 = document.getElementsByClassName("close")[2];
		var modal_close_button_3 = document.getElementsByClassName("close")[3];
		var modal_login_button = document.getElementsByClassName("login")[0];
		var modal_password_button = document.getElementsByClassName("password-link")[0];

		$(document).click((event) => {
			if (!$(event.target).closest('.details_modal__wrap').length) {
				// alert('click outside!');
				modal.style.display = "none";
			}        
		  });
		
		// $(document).click(function(e) {
		// 	if (!$(e.target).closest('#login_modal').length) {
		// 		alert('click outside!');
		// 	}
		// });

		/* Login form */
		modal_login_button.onclick = function() {
		    $('#modal_default').hide();
		    $('#modal_login').show();
		}

		/* Password form */
		modal_password_button.onclick = function() {
		    $('#modal_default').hide();
		    $('#modal_login').hide();
		    $('#modal_password').show();
		}

		/* Close */
		modal_close_top.onclick = function() {
		    modal.style.display = "none";

		    $.get( "/", {
		        action: 'setGuestSession',
		    }).done();
		}		

		modal_close_button.onclick = function() {
		    modal.style.display = "none";

		    $.get( "/", {
		        action: 'setGuestSession',
		    }).done();
		}
		
		modal_close_button_2.onclick = function() {
		    modal.style.display = "none";

		    $.get( "/", {
		        action: 'setGuestSession',
		    }).done();
		}
		
		modal_close_button_3.onclick = function() {
		    modal.style.display = "none";

		    $.get( "/", {
		        action: 'setGuestSession',
		    }).done();
		}
	},
	cart_details_customer: function() {

		$('#billing_checkbox').change(function(){

		    if (this.checked) {
		        $('#billing_address').css('opacity', 1).slideUp('slow').animate(
		            { opacity: 1 },
		            { queue: false, duration: 'slow' }
		        );
		    } else {
		        $('#billing_address').css('opacity', 0).slideDown('slow').animate(
		            { opacity: 1 },
		            { queue: false, duration: 'slow' }
		        );
		    }
		});

		$('#delivery_addresses').on('change', function(e) {

			// Set blank address fields
			if ($(this).find(':selected').val() == 'new') {

				$('#address1').val('');
				$('#address2').val('');
				$('#city').val('');
				$('#postcode').val('');
			} else { // Hide address details
			
				$('#address1').val($(this).find(':selected').data('address1'));
				$('#address2').val($(this).find(':selected').data('address2'));
				$('#city').val($(this).find(':selected').data('city'));
				$('#postcode').val($(this).find(':selected').data('postcode'));
			}
		});

		$('#billing_addresses').on('change', function(e) {

			// Set blank address fields
			if ($(this).find(':selected').val() == 'new') {

				$('#billing-address1').val('');
				$('#billing-address2').val('');
				$('#billing-city').val('');
				$('#billing-postcode').val('');
			} else { // Hide address details
			
				$('#billing-address1').val($(this).find(':selected').data('address1'));
				$('#billing-address2').val($(this).find(':selected').data('address2'));
				$('#billing-city').val($(this).find(':selected').data('city'));
				$('#billing-postcode').val($(this).find(':selected').data('postcode'));
			}
		});
	},
	cart_details_global: function() {

		$('#details-form').submit(function(e) {
	        e.preventDefault();

	        $.post('/?action=checkoutDetails', 
	            $('#details-form').serialize()
	        ).done(function( data ) {
	            var obj = JSON.parse(data);

	            if (obj.status && !obj.errors) {

	                $('input').removeClass('my-account-form__input--error');

	                console.log(data);
					window.location.href = '/store/payment/';
	            } else {
	                $('input').removeClass('my-account-form__input--error');

	                var str = '';
	                $.each(obj.errors, function( index, value ) {
	                    $('input[name='+index+']').addClass('my-account-form__input--error');
	                    str += value+'<br/>';
	                });

	                prompt('error', 'Form error', str);
	                
	                $('html, body').animate({
	                    scrollTop: $("#errors").offset().top
	                }, 0);
	            }
	        });

	        return false;
	    });

		$('#shipping_lookup').getAddress({
	        api_key: postcode_api,
	        input_class: 'my-account-form__input my-account-form__input--postcode',
	        input_label: 'Enter your postcode',
	        dropdown_class: 'my-account-form__input my-account__button--margin-top',
	        button_class: 'my-account__button my-account__button--margin-top',
	        button_label: 'Find address',
	        output_fields: {
	            line_1: '#address1',
	            line_2: '#address2',
	            post_town: '#city',
	            postcode: '#postcode',
	        }
	    });

	    $('#billing_lookup').getAddress({
	        api_key: postcode_api,
	        input_class: 'my-account-form__input',
	        input_label: 'Enter your postcode',
	        dropdown_class: 'my-account-form__input my-account__button--margin-top',
	        button_class: 'my-account__button my-account__button--margin-top',
	        button_label: 'Find address',
	        output_fields: {
	            line_1: '#billing-address1',
	            line_2: '#billing-address2',
	            post_town: '#billing-city',
	            postcode: '#billing-postcode',
	        }
	    });
	},
	cart_page: function() {

	  	$(".decrease").click(function() {

		    var id = $(this).data('id');
		    var action = 'updateCart';
		    var quantity = $('#item-quantity-' + id).text();
		    var type = 'decrease';

		    update_cart(action, id, quantity, type);
		})

		$(".increase").click(function() {

		    var id = $(this).data('id');
		    var action = 'updateCart';
		    var quantity = $('#item-quantity-' + id).text();
		    var type = 'increase';

		    update_cart(action, id, quantity, type);
		})

		$( ".remove-item" ).click(function() {

		    var id = $(this).data('id');
		    var action = 'removeItem';

		    // alert('Removing item ID '+id);

			update_cart(action, id);
		})

		$( "#remove-all" ).click(function() {

		    var action = 'removeall';

		    update_cart(action);
		})
	},
	cart_payment: function() {

		String.prototype.toCardFormat = function () {

		    return this.replace(/[^0-9]/g, "").substr(0, 16).split("").reduce(cardFormat, "");
		    function cardFormat(str, l, i) {

		        return str + ((!i || (i % 4)) ? "" : " ") + l;
		    }
		};
	    
	    $("[name=card-number]").keyup(function () {

	        $(this).val($(this).val().toCardFormat());
	    });


		$('#payment-form-paypal').submit(function(e) {

			var isValid = true;
			var errorMsg = '';
			
			if ($('[name=terms-paypal]').prop('checked') == false) {
				e.preventDefault();
				isValid = false;
				errorMsg += 'Please agree to our terms & conditions<br>'
			}
			
			if (isValid === true) {
				// $(this).submit();
				$('#btn-submit-payment').addClass('my-account__button--processing'); // add spinner to button
				$('#btn-submit-paypal-payment').addClass('my-account__button--processing'); // add spinner to button

			} else {
				
				prompt('error', 'Error', errorMsg);
				$('html, body').animate({
					scrollTop: $("#errors").offset().top
				}, 0);

			}

		});
		
		
		$('#payment-form').submit(function(e) {
		    e.preventDefault();

			// $('.my-account-form__input').each(function() {
			// if ( $(this).val() === '' )
			// 	isValid = false;
			// 	$(this).addClass('my-account-form__input--error');
			// 	prompt('error', 'Error', 'Please complete all fields');
			// });

		    var isValid = true;
			var errorMsg = '';
			
			if ($('[name=terms-card]').prop('checked') == false) {
				isValid = false;
				errorMsg += 'Please agree to our terms & conditions<br>'
			}

			$('form').find('input.required').each(function(){
				if($(this).val().length==0){
					$(this).addClass('my-account-form__input--error');
					errorMsg += 'Please enter the ' + $(this).data("name") + '<br>';
					isValid = false;
				}
			});

			if (isValid === true) {

				$(':input').removeClass('my-account-form__input--error');
				$(':input[type="submit"]').prop('disabled', true); // prevents duplicate submissions
				//$(':input[type="submit"]').text('Processing...'); // change button text
				// $(':input[type="submit"]').addClass('my-account__button--processing'); // add spinner to button
				$('#btn-submit-payment').addClass('my-account__button--processing'); // add spinner to button
				$('#btn-submit-paypal-payment').addClass('my-account__button--processing'); // add spinner to button

		        $.get('/?action=paymentKey').done(function(key) {
		            var key_obj = JSON.parse(key); 

		            sagepayOwnForm({ 
		                merchantSessionKey: key_obj.key 
		            }).tokeniseCardDetails({ 
		                cardDetails: { 
		                    cardholderName: $('[name=card-name]').val(),
		                    cardNumber: $('[name=card-number]').val().replace(/\s/g, ''),
		                    expiryDate: $('[name=card-expiry-date-month]').val()+""+$('[name=card-expiry-date-year]').val(),
		                    securityCode: $('[name=card-ccv]').val()
		                },
		                onTokenised : function(result) { 

		                    if (result.success) {

								// console.log( 'Result: ' + JSON.stringify(result) );

		                        $.post('/', {
		                            action: 'processPayment',
		                            card_identifier: result.cardIdentifier,
		                        }).done(function( data ) {

									// console.log( 'Data: ' + JSON.stringify(data) );

									var obj = JSON.parse(data);

		                            if (obj.status) {

		                                window.location.href = '/store/complete/';

		                            } else {

		                                prompt('error', 'Payment failed', 'Your payment method has failed. Please try again!');
		                            }
			
		                        });
		                    } else { 

		                        $('input').removeClass('my-account-form__input--error');

		                        result.errors.forEach(function(e) {

		                            if (e['message'].includes('name')) {

		                                $('input[name=card-name]').addClass('my-account-form__input--error');
		                            }

		                            if (e['message'].includes('number')) {

		                                $('input[name=card-number]').addClass('my-account-form__input--error');
		                            }

		                            if (e['message'].includes('date')) {

		                                $('input[name=card-expiry-date-month]').addClass('my-account-form__input--error');
		                                $('input[name=card-expiry-date-year]').addClass('my-account-form__input--error');
		                            }

		                            prompt('error', 'Payment failed', e['message']);

									// Re-enable Submit Button
									$(':input[type="submit"]').prop('disabled', false);
									$(':input[type="submit"]').text('Place your order');
									$(':input[type="submit"]').removeClass('my-account__button--processing');

		                            // Scroll back to error field
									$('html, body').animate({
		                                scrollTop: $("#errors").offset().top
		                            }, 0);
		                        });
		                    } 
		                } 
		            }); 
		        });
		    } else {

				prompt('error', 'Error', errorMsg);
				$('html, body').animate({
					scrollTop: $("#errors").offset().top
				}, 0);

			}

		    return false;
		});
	},
	contact_page: function() {

		// Hide required span on page load
        $('.opt').hide();

        // Hide service fields on page load
        if($('#service-enq').is(':checked')) {

            $(".form__service-enquiry").show(); // Show service

            $('#tel-optional, #address-optional').addClass("form__label--required"); // Add required class conditional
            $('#tel, #address').addClass("required"); // Add required function
            $('#tel').attr("placeholder", "Enter your phone number"); // Change placeholder
            $('.opt').show(); // Show required formatting
            $('.opt2').hide(); // Hide required formatting
        }

        var category = $("[name=product_category]");
        var product = $("[name=product_type] option").detach();

        // Perform filter function for page load and category change
        function filterProducts() {
            var val = $(category).children(":selected").attr("id"); // Get the selected option's ID attribute
            $("[name=product_type] option").detach() // Clear types
            product.filter("." + val).clone().appendTo("[name=product_type]") // Append results
        }

        // Filter products on page load
        filterProducts();

        $('[name=enquiry_type]').change(function() {

            if (this.value == 'general') {

                $('#tel-optional, #address-optional').removeClass("form__label--required"); // Remove required class conditional
                $('.opt').hide(); // Hide required formatting
                $('#tel').removeClass("required").attr("placeholder", "Enter your number (optional)"); // Remove required function

            }

            else if (this.value == 'service') {

                $('#tel-optional, #address-optional').addClass("form__label--required"); // Add required class conditional
                $('#tel, #address').addClass("required"); // Add required function
                $('#tel').attr("placeholder", "Enter your phone number"); // Change placeholder
                $('.opt').show(); // Show required formatting
                $('.opt2').hide(); // Hide required formatting

            }

        });

        // When product category changes
        $(category).change(function() {
            filterProducts(); // Call filter function
        });

        // On general enquiry radio click
        $("#gen-enq").click(function(){
            $(".form__service-enquiry").slideUp(); // Hide service
            $('#tel').removeClass("required");
        });

        // On general enquiry radio click
        $("#service-enq").click(function(){
            $(".form__general-enquiry").slideUp(); // Hide general
            $(".form__service-enquiry").slideDown(); // Show service
            $('#tel').addClass("required"); // Add class required conditional
            $('.opt').show();
        });
	},
	cart_complete: function() {

		if (document.getElementById('create_account')) {
			$('#create_account').change(function() {

				if (this.checked) {
					$('#create_account_wrap').css('opacity', 0).slideDown('slow').animate(
						{ opacity: 1 },
						{ queue: false, duration: 'slow' }
					);
				} else {
					$('#create_account_wrap').css('opacity', 1).slideUp('slow').animate(
						{ opacity: 1 },
						{ queue: false, duration: 'slow' }
					);
				}
			});
		}

		// update_cart();
	},
	home_page: function() {

		// Home page hero slider
		$('.carousel-home-hero').flickity({
			cellAlign: 'left',
			contain: true,
			wrapAround: true,
			dragThreshold: 2,
			autoPlay: 7000,
			prevNextButtons: false
	    });
		
		// Home page production selection slider
		$('.prod-select__slider').flickity({
			cellAlign: 'left',
			contain: true,
			wrapAround: true,
			pageDots: false,
			dragThreshold: 2
	    });

	    // Home page latest news slider
		$('.latest-news__slider').flickity({
			cellAlign: 'left',
			wrapAround: true,
			pageDots: false,
			dragThreshold: 2
	    });

	},
	accordions: function() {

		// Frequently asked questions accordion
	    var accordions = document.getElementsByClassName('questions__accord-question');

	    for (var i = 0; i < accordions.length; i++) {
	        accordions[i].onclick = function () {
	            this.classList.toggle('questions__accord-question--is-open');
	            var content = this.nextElementSibling;

	            if (content.style.maxHeight) {
	                content.style.maxHeight = null;
	            } else {
	                content.style.maxHeight = content.scrollHeight + "px";
	            }
	        }
	    }
	},
	is_filtered: function() {

		// Selector Page Filtering
		var containerEl = document.querySelector('.results__flex-container, .list');
		var mixer = mixitup(containerEl, {
		    multifilter: {
		        enable: true
		    },
		    animation: {
		        effects: 'fade translateZ(-100px)',
		        easing: 'ease-in-out'
		    },
		    callbacks: {
		        onMixFail: function(state) {
		            alert('Sorry no products match your selections, click clear filters to view full range!');
		        }
		    }
		});
	},
	client_filtered: function() {

		// Client Login Filtering
		var containerEl = document.querySelector('.results__flex-container');
		var mixer = mixitup(containerEl, {
		    multifilter: {
		        enable: true
		    },
		    animation: {
		        effects: 'fade translateZ(-100px)',
		        easing: 'ease-in-out'
		    },
		    load: {
		        filter: '.beds'
		    },
		    callbacks: {
		        onMixFail: function(state) {
		            alert('Sorry no products match your selections, click clear filters to view full range!');
		        }
		    }
		});
	},
	country_filtered: function() {

    	// Carousel for where to buy
	    $('.carousel-country').flickity({
	        contain: true,
	        groupCells: true,
	        imagesLoaded: true,
	        pageDots: false,
	        wrapAround: true
	    });

		// Where to buy country filter
		var containerEl = document.querySelector('.retailers__flex-container');
		var mixer = mixitup(containerEl, {
		    multifilter: {
		        enable: false
		    },
		    animation: {
		        effects: 'fade translateZ(-100px)',
		        easing: 'ease-in-out'
		    },
		    load: {
		        filter: '.uk'
		    },
		    callbacks: {
		        onMixFail: function(state) {
		            alert('Sorry this country does not have any retailers yet');
		        }
		    }
		});
	},
	product_page: function() {

		$('#size').on('change', function(e) {

			var price = $('#size').find(':selected').attr('data-price').split(".");
			var was = $('#size').find(':selected').attr('data-was').split(".");

			
			$('#product_price_change').html('&pound;'+price[0]+'.<span class="viewer__info-box__price--pence">'+price[1]+'</span>');
			$('#product_was_price_change').html('&pound;'+was[0]+'.<span class="viewer__info-box__discount-price--pence">'+was[1]+'</span>');
		});
	},
	details: function() {
		// Main image gallery carousel
	    $('.carousel-main').flickity({
	        pageDots: false,
	        imagesLoaded: true,
	        lazyLoad: 1,
	        selectedAttraction: 0.01,
	        friction: 0.15,
	        wrapAround: true
	    });

	    // Navigation for main gallery
	    $('.carousel-main-nav').flickity({
	        asNavFor: '.carousel-main',
	        contain: true,
	        lazyLoad: 1,
	        groupCells: true,
	        imagesLoaded: true,
	        pageDots: false,
	        prevNextButtons: false
	    });

	    // Sofa Bed fabric option carousel
	    $('.carousel-sofa').flickity({
	        pageDots: false,
	        imagesLoaded: true,
	        lazyLoad: 1,
	        selectedAttraction: 0.01,
	        friction: 0.15,
	        wrapAround: true,
	        initialIndex: 15
	    });

	    // Navigation for Sofa Bed fabric option carousel
	    $('.carousel-sofa-nav').flickity({
	        asNavFor: '.carousel-sofa',
	        contain: false,
	        lazyLoad: 1,
	        groupCells: true,
	        imagesLoaded: true,
	        initialIndex: 15,
	        pageDots: false,
	        wrapAround: true
	    });

		// Quantity box
		var minus = document.querySelector(".subtract-quantity")
		var add = document.querySelector(".add-quantity");
		var currentValue = 1;

		minus.addEventListener("click", function(){
		    if (currentValue != 1) {
		        currentValue -= 1;
		    }

		    document.getElementById('quantity-amount').innerHTML = currentValue;
		    document.getElementById('product-quantity').value = currentValue;
		});

		add.addEventListener("click", function() {
		    currentValue += 1;
		    document.getElementById('quantity-amount').innerHTML = currentValue;
		    document.getElementById('product-quantity').value = currentValue;
		});
	},
	bottles: function() {

		// Bottle counter code
	    var startDate = new Date(2018, 0, 1);
	    var rate = 1 / 3 / 1000;
	    var baseValue = 50000000;

	    // Perform Round calculation
	    function bottleRound(num) {
	        return Math.abs(num) > 999999 ? Math.sign(num)*((Math.abs(num)/1000000).toFixed(0)) : Math.sign(num)*Math.abs(num)
	    }

	    function bottleCalc() {
	        var bottles = Math.floor((new Date() - startDate) * rate) + baseValue;
	        $("#odometer").html(bottles);
	    }

	    function bottleCalcRound() {
	        var bottles = Math.floor((new Date() - startDate) * rate) + baseValue;
	        $("#odometer-rounded").html(bottleRound(bottles));
	    }

	    bottleCalc();
	    bottleCalcRound();

	    setInterval(function () {
	        bottleCalc();
	        bottleCalcRound();
	    }, 3000);
	},
	product_guarantee_page: function() {

		$("[id*='guarantee-remove-item-']").click(function() {

		    var id = $(this).attr('id').split("-")[3];

		    $.get( "/", { 
		        action: 'removeGuarantee',
		        id: id,
		    }).done(function(data) {

	            var obj = JSON.parse(data);

		        if (obj.empty) {

		            location.reload();

		            return false;
		        }

		        $('#guarantee-item-' + id).remove();
		    });
		});
	},
	wishlist_page: function() {

		$("[id*='wishlist-remove-item-']").click(function() {

		    var product_id = $(this).attr('id').split("-")[3];

		    $.get( "/", { 
		        action: 'removeWishlist',
		        product_id: product_id,
		    }).done(function(data) {

	            var obj = JSON.parse(data);

		        if (obj.empty) {

		            location.reload();

		            return false;
		        }

		        $('#wishlist-item-' + product_id).remove();

		        updateWishlist();
		    });
		});

		$("[id*='add-to-cart-']").click(function() {

		    var product_id = $(this).attr('id').split("-")[3];
		    var quantity = $('#item-quantity-' + product_id).find(":selected").val()
		    $.post( "/", { 
		        id: product_id,
		        quantity: quantity,
		        action: 'addItem',
		        wishlist: true
		    }).done(function(data) {

		        window.location.href = '/store/cart/';
		    });
		})
	},
	newsletter_page: function() {

		$('#marketing-opt-in').change(function() {

		    if (this.checked) {

		        var newsletter = 'add';
		    } else {

		        var newsletter = 'remove';
		    }
		    
		    $.post( "/", {
		    	action: 'updateNewsletter',
		        newsletter: newsletter,
		    }).done();
		});
	},
	login_page: function() {

		$('#login_form').submit(function(e) {
	        e.preventDefault();

	        $.post('/', {
	            action: 'login',
	            email: $('#email').val(),
	            password: $('#password').val(),
	            remember: $('#remember').prop('checked')
	        }).done(function( data ) {
	        	console.log(data);
	            var obj = JSON.parse(data);

	            if (obj.status == true) {

	            	if (obj.redirect) {

	            		window.location.href = '/'+obj.redirect;
	            	} else {
	            		window.location.href = '/account/dashboard/';
	            	}
	            } else {

	            	prompt('error', 'Login error', 'Your email or password does not match our records.');
	            }
	        });
	    });
	},
	forgot_password_page: function() {

		$('#password_form').submit(function(e) {
	        e.preventDefault();

	        $.post('/', {
	            action: 'forgotPassword',
	            email: $('#forgot_email').val()
	        }).done(function( data ) {
	        	console.log(data);
	            var obj = JSON.parse(data);

	            if (obj.status == true) {

	            	prompt('success', 'Forgotten password', 'If your email address matches our records you will receive an email.');
	            } else {

	            	prompt('error', 'Login error', 'Your email or password does not match our records.');
	            }
	        });
	    });
	},
	cart_login_page: function() {

		$('#login_form').submit(function(e) {
	        e.preventDefault();

	        $.post('/', {
	            action: 'login',
	            email: $('#email').val(),
	            password: $('#password').val()
	        }).done(function( data ) {
	            var obj = JSON.parse(data);

	            if (obj.status == true) {

	            	window.location.href = '/store/details/';
	            } else {

	            	prompt('error', 'Login error', 'Your email or password does not match our records.');
	            }
	        });
	    });
	},
	address_page: function() {

		$('.remove-address').click(function(e) {
			e.preventDefault();

			$.post( "/", {
		    	action: 'removeAddress',
		        id: $(this).data('id'),
		    }).done(function(data) {
	            var obj = JSON.parse(data);

	            if (obj.empty == true) {

	            	window.location.href = '/account/address-books/';
	            }

		    	$(this).remove();
		    });
		});
	},
	create_order_account: function() {

		$('#createOrderAccount').submit(function(e) {

			// alert('createOrderAccount');

			e.preventDefault();

			if ($('#marketing-opt-in').is(':checked')) {

				var marketing = 1;

			} else {

				var marketing = 0;
			}

			// alert('sending JSON');

			$.post( "/", {
		    	action: 'createOrderAccount',
		    	password: $('#password').val(),
				confirm_password: $('#confirm_password').val(),
		    	marketing: marketing
		    }).done(function(data) {

				console.log(data);

	            var obj = JSON.parse(data);

				console.log(obj.status);

	            if (obj.status == true) {

	            	window.location.href = '/account/';
	            } else {
					prompt('error', 'Error:', obj.error);
				}
		    });
		});
	}
};

function makePrimary(id) {

    $.post( "/", {
    	action: 'addressPrimary',
        primary: 1,
		id: id,
    }).done(function(data) {
    	
		$('[id*=primary-]').prop('hidden', true);
		$('#primary-' + id).prop('hidden', false);
		$('#address-wrap-' + id).insertBefore('.my-account-address__wrap:first');
		$('[id*=address-footer-]').each(function() {

			var eId = $(this).attr('id').split("-")[2];
			$('#make-primary-' + eId).remove();

	    	if (eId != id) {

				$('#address-footer-' + eId).append('<a style="cursor:pointer" id="make-primary-' + eId + '" class="my-account-address__link" onclick="makePrimary(' + eId + ')">Make Primary</a>')
			}
		});
	});
}

function update_cart(action, item_id, quantity, type) {

	if (item_id === undefined) {
		
		item_id = null;
	}

	if (quantity === undefined) {
		
		quantity = null;
	}

	if (type === undefined) {
		
		type = null;
	}

	var formatter = new Intl.NumberFormat('en-GB', {
	    style: 'currency',
	    currency: 'GBP',
	});

    $.post('/', { 
        action: action,
        id: item_id,
        quantity: quantity,
        type: type
    }).done(function( data ) {

		var obj = JSON.parse(data);

		// console.log(obj);

        if (obj.type == 'updated') {

            if (obj.saving) {

                $("#discount-total").text('You saved ' + formatter.format(obj.saving));
            }

            $("#item-quantity-"+item_id).text(obj.quantity); 
            $("#item-total-"+item_id).text(formatter.format(obj.item_total)); 
            $("#total").text(formatter.format(obj.total_price)); 
            $("#subtotal").text(formatter.format(obj.sub_total)); 
            $("#vat-total").text('Includes VAT of ' + formatter.format(obj.vat));
            $('#subtotal_cart_count').text('Subtotal (' + obj.cart_count + ' items)');

            if (obj.cart_count > 0) {

            	$('#header-cart-count').text(obj.cart_count);
            } else {

            	$('#header-cart-count').hide();
            }
        } else if (obj.type == 'remove') {

			console.log(item_id);

            $("#item-card-"+item_id).remove(); 
            $("#total").text(formatter.format(obj.total_price)); 
            $("#subtotal").text(formatter.format(obj.sub_total)); 
            $("#vat-total").text('Includes VAT of ' + formatter.format(obj.vat)); 
            

            if (obj.cart_count > 0) {

            	$('#header-cart-count').text(obj.cart_count);
                $('#subtotal_cart_count').text('Subtotal (' + obj.cart_count + ' items)');
            } else {

            	$('#header-cart-count').hide();
                $("#cart_override" ).html('<header class="shopping-basket__header"><img class="shopping-basket__header__image" src="/_/img/ecomm/checkout/opayo.svg" alt="Opayo" /><h1 class="shopping-basket__header__h1">Shopping Basket</h1></header><br/><br/><p style="text-align:center">Your basket is empty</p>');
            }
        }
    });

	location.reload(); // temporary fix to force page refresh so that promos are removed if relating products are removed
}

function addItems() {

    if ($('#id_product_size').val()) {
        var id = $('#size').find(':selected').val()
    } else {
        var id = $('#product_id').val()
    }

    var product_size = $('#size').val();
	var size = $('#size').val();
	var color = $('#size').val();
	var model = $('#size').val();
    var quantity = $('#product-quantity').val();

    $.post('/', { 
        id: id,
        product_size: product_size,
		size: size,
		color: color,
		model: model,
        quantity: quantity,
        action: 'addItem'
    }).done(function(data) {

       window.location.href = '/store/cart/';
    });
}

function prompt(type, title, message) {

	$('#alert').fadeIn('slow');
	$('#alert-title').text(title);
	$('#alert-message').html(message);
	$('#alert').removeClass();
	$('#alert').addClass('slide-in');

	if (type == 'error') {

		$('.alert-container').addClass('alert-error');
	} else if (type == 'success') {

		$('.alert-container').addClass('alert-success');
	}

	setTimeout(function() {

		$('#alert').removeClass('slide-in');
		$('#alert').addClass('slide-out');
		$('#alert').fadeOut('slow');
	}, 5000);
}

function toggleWishList() {
    
    if ($('#id_product_size').val()) {

        var product_id = $('#size').find(":selected").val();
    } else {

        var product_id = $('#product_id').val();
    }

    var type = $( "#wished_for" ).prop("checked") ? 'removeWishlist' : 'addWishlist';
    $.get( "/", { 
        action: type,
        product_id: product_id,
    }).done(function(data) {

        $("#wished_for").prop("checked", !$("#wished_for").prop("checked"));

        if ($("#wishlist-icon").hasClass("wishlist-on")) {

            $("#wishlist-icon").removeClass("wishlist-on");
            $("#wishlist-icon").addClass("wishlist-link");

			prompt('success', 'Wishlist', 'Item removed from your wishlist. To view your wishlist click the love heart');
        } else {

            $("#wishlist-icon").removeClass("wishlist-link");
            $("#wishlist-icon").addClass("wishlist-on");

            prompt('success', 'Wishlist', 'Item added to your wishlist. To view your wishlist click the love heart');
        }

    	updateWishlist();
    });
};


function toggleWishListLoop(product_id) {
    
    var type = $( "#wished_for_"+product_id ).prop("checked") ? 'removeWishlist' : 'addWishlist';
    $.get( "/", { 
        action: type,
        product_id: product_id,
    }).done(function(data) {

        $("#wished_for_"+product_id).prop("checked", !$("#wished_for_"+product_id).prop("checked"));

        if ($("#wishlist-icon_"+product_id).hasClass("wishlist-on")) {

            $("#wishlist-icon_"+product_id).removeClass("wishlist-on");
            $("#wishlist-icon_"+product_id).addClass("wishlist-link");

			prompt('success', 'Wishlist', 'Item removed from your wishlist. To view your wishlist click the love heart');
        } else {

            $("#wishlist-icon_"+product_id).removeClass("wishlist-link");
            $("#wishlist-icon_"+product_id).addClass("wishlist-on");

            prompt('success', 'Wishlist', 'Item added to your wishlist. To view your wishlist click the love heart');
        }

    	updateWishlist();
    });
};


function updateWishlist() {

	$.get('/', {
        action: 'getTotalWishes'
    }).done(function( data ) {

        
		
		if (data > 0) {

	    	$('#total_wishes').show();
	        $('#total_wishes').html(data);
	    } else {

	    	$('#total_wishes').hide();
	    }
    });
}

$('#header-wishlist').on('click', function(e) {

	$.get('/', {
        action: 'getTotalWishes'
    }).done(function( data ) {

        if (data > 0) {

	    	window.location.href = '/store/wishlist';
	    } else {

	    	prompt('error', 'Your Wishlist', 'You need to some items first!');
	    }
    });
});

$('#header-cart').on('click', function(e) {

	$.get('/', {
        action: 'countCart'
    }).done(function( data ) {

        if (data > 0) {

	    	window.location.href = '/store/cart';
	    } else {

	    	prompt('error', 'Your Shopping Basket', 'You need to some items first!');
	    }
    });
});


$('#promo-applied').on('click', function(e) {

	// alert('Remove Promo?');

	$.get('/', {
		action: 'removePromo'
	}).done(function() {

		window.location.href = '/store/cart';

	});
});


$('input').focus(function() {
	$(this).removeClass('my-account-form__input--error');
});


// $('#date-picker').on('blur', function() {
// 	// on blur, if there is no value, set the defaultText
// 	alert($(this).val()); 
// });


// $('#clear_delivery_date').on('click', function(e) {

// 	e.preventDefault();

// 	let val = $('#date-picker').val();

// 	// alert(val);
// 	// alert('Clear delivery date');

// 	$('#date-picker').val('');

	
// 	location.reload();

// });

