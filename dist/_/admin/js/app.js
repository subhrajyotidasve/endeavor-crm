$(function() {

	"use strict";

	// $("html").attr("class", "semi-dark"),

	$(".mobile-search-icon").on("click", function() {

		$(".search-bar").addClass("full-search-bar")

	}),



	$(".search-close").on("click", function() {

		$(".search-bar").removeClass("full-search-bar")

	}),



	$(".mobile-toggle-menu").on("click", function() {

		$(".wrapper").addClass("toggled")

	}),



	$(".toggle-icon").click(function() {

		$(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {

			$(".wrapper").addClass("sidebar-hovered")

		}, function() {

			$(".wrapper").removeClass("sidebar-hovered")

		}))

	}),



	$(document).ready(function() {

		$(window).on("scroll", function() {

			$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()

		}), $(".back-to-top").on("click", function() {

			return $("html, body").animate({

				scrollTop: 0

			}, 50), !1

		})

	}),



	$(function() {

		for (var e = window.location, o = $(".metismenu li a").filter(function() {

				return this.href == e

		}).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")

	}),

	$('#add_variation').on('click', function() {



		var product_id = $(this).data('product-id');

		console.log(product_id);

		$.post('/?action=adminAddProductVariation', {

			product_id: product_id

		}).done(function(data) {



		    $('#variations').prepend(data);

		});

	}),


	// $('#email_invoice').click(function(e) {
	//
	// 	console.log('sending invoice');
	// 	e.preventDefault();
	//
	// 	var order_id = $(this).data('id');
	// 	console.log('order_id: '+order_id);
	//
	// 	$.post('/?action=adminEmailInvoice', {
	//
	// 		order_id: order_id
	//
	// 	}).done(function(data) {
	//
	// 		console.log(data);
	// 		prompt('sent', 'Invoice sent.');
	//
	// 	});
	//
	// }),





		$('#email_invoice').submit(function(e) {

			e.preventDefault();

			var formData = new FormData(this);

			$.ajax({

				url: '/?action=adminEmailInvoice',

				data: formData,

				type: 'POST',

				contentType: false,

				processData: false,

			}).done(function(data) {

				console.log(JSON.stringify(data));

				prompt('sent', 'Invoice sent.');

			});

		}),


		$('#email_guarantee').submit(function(e) {

			e.preventDefault();

			var formData = new FormData(this);

			$.ajax({

				url: '/?action=adminEmailGuarantee',

				data: formData,

				type: 'POST',

				contentType: false,

				processData: false,

			}).done(function(data) {

				console.log(JSON.stringify(data));

				prompt('sent', 'Guarantee sent.');

			});

		}),






		// $('#email_invoice_guarantee').submit(function(e) {

		// 	e.preventDefault();

		// 	var formData = new FormData(this);

		// 	$.ajax({

		// 		url: '/?action=adminEmailInvoice',

		// 		data: formData,

		// 		type: 'POST',

		// 		contentType: false,

		// 		processData: false,

		// 	}).done(function(data) {

		// 		console.log(JSON.stringify(data));

		// 		// prompt('sent', 'Invoice sent.');

		// 	});

		// 	$.ajax({

		// 		url: '/?action=adminEmailGuarantee',

		// 		data: formData,

		// 		type: 'POST',

		// 		contentType: false,

		// 		processData: false,

		// 	}).done(function(data) {

		// 		console.log(JSON.stringify(data));

		// 		prompt('sent', 'Invoice & guarantee(s) sent.');

		// 	});

		// }),






		$('#email_invoice_guarantee').submit(function(e) {

			e.preventDefault();

			var formData = new FormData(this);

			$.ajax({

				url: '/?action=adminSendInvoiceAndGuarantee',

				data: formData,

				type: 'POST',

				contentType: false,

				processData: false,

			}).done(function(data) {

				console.log(JSON.stringify(data));

				prompt('sent', 'Invoice & guarantee(s) sent.');

			});

		}),








	$('#status_form').submit(function(e) {

	   e.preventDefault();

	   var formData = new FormData(this);

	   $.ajax({

	      url: '/?action=adminProductOrderStatus',

	      data: formData,

	      type: 'POST',

	      contentType: false,

	      processData: false,

	   }).done(function(data) {

			// console.log(JSON.stringify(data));

			prompt('updated', 'Order status has been updated.');

	   });

	}),



	$('#sap_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminProductSapUpdate',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			prompt('updated', 'SAP Invoice number has been updated.');

		});

	}),



	$('#tracking_form').submit(function(e) {

	   e.preventDefault();



	   var formData = new FormData(this);



	   $.ajax({

	      url: '/?action=adminProductOrderTracking',

	      data: formData,

	      type: 'POST',

	      contentType: false,

	      processData: false,

	   }).done(function(data) {



	     prompt('updated', 'Order status has been updated.');

	   });

	}),



	$("#product_form").validate({

		submitHandler: function(form) {	    	

	    	var formData = new FormData(form);

			$.ajax({

			  url: '/?action=adminProductUpdate',

			  data: formData,

			  type: 'POST',

			  contentType: false,

			  processData: false,

			}).done(function(data) {

				console.log(data);
			
				prompt('updated', 'Product has been updated.');

			});

	 	}

	}),



	$("#email_form").validate({

		submitHandler: function(form) {	    	

	    	var formData = new FormData(form);

			$.ajax({

			  url: '/?action=adminEmailUpdate',

			  data: formData,

			  type: 'POST',

			  contentType: false,

			  processData: false,

			}).done(function(data) {

			 prompt('updated', 'Email has been updated.');

			});

	 	}

	}),


	$('#add_faq').on('click', function(e) {

		if ($('#question').val().length === 0) {

			$('#question').addClass('alert-danger');

		} else {

			$.post('/?action=adminAddFaq', {

				question: $('#question').val()

			}).done(function(data) {

			    window.location = '/'+admin_folder+'/faqs/edit.php?id='+data;

			});

		}

	}),	
	
	
	$('#add_product').on('click', function(e) {

		if ($('#product_name').val().length === 0) {

			$('#product_name').addClass('alert-danger');

		} else {

			$.post('/?action=adminAddProduct', {

				product_name: $('#product_name').val(),

				product_category: $('#product_category').val()

			}).done(function(data) {

			    window.location = '/'+admin_folder+'/products/edit.php?id='+data;

			});

		}

	}),



	$('#add_customer').on('click', function(e) {

		if ($('#first_name').val().length === 0) {

			$('#first_name').addClass('alert-danger');

		} else {

			$.post('/?action=adminAddCustomer', {

				first_name: $('#first_name').val(),

				last_name: $('#last_name').val(),

				email: $('#email').val(),

				tel_mobile: $('#tel_mobile').val()

			}).done(function(data) {

				window.location = '/'+admin_folder+'/customers/edit.php?id='+data;

			});

		}

	}),



	$('#add_admin').on('click', function(e) {

		if ($('#first_name').val().length === 0) {

			$('#first_name').addClass('alert-danger');

		} else {

			$.post('/?action=adminAddAdmin', {

				first_name: $('#first_name').val(),

				last_name: $('#last_name').val(),

				email: $('#email').val(),

				tel_mobile: $('#tel_mobile').val()

			}).done(function(data) {

				if (data) {

					window.location = '/'+admin_folder+'/admins/edit.php?id='+data;

				} else {
				
					alert('Email is already in use');

				}

			});

		}

	}),




	$("#promo_form").validate({

		submitHandler: function(form) {	    	

	    	var formData = new FormData(form);

			var fd = JSON.stringify($('form').serializeArray());
			// alert(fd);
			console.log(fd);

			$.ajax({

			  url: '/?action=adminPromoUpdate',

			  data: formData,

			  type: 'POST',

			  contentType: false,

			  processData: false,

			}).done(function(data) {

				prompt('updated', 'Promo has been updated.');
				// prompt(data);

			});

	 	}

	}),




	$("#add_promo_form").validate({

		submitHandler: function(form) {	    	

	    	var formData = new FormData(form);

			var fd = JSON.stringify($('form').serializeArray());
			// alert(fd);
			console.log(fd);

			$.ajax({

			  url: '/?action=adminPromoAdd',

			  data: formData,

			  type: 'POST',

			  contentType: false,

			  processData: false,

			}).done(function(data) {

				prompt('updated', 'Promo has been added.');
				// prompt(data);

				window.location.href = '/admin/marketing/promos/';

			});

	 	}

	}),



	$("#customer_form").validate({

		submitHandler: function(form) {	    	

	    	var formData = new FormData(form);

			$.ajax({

				url: '/?action=adminCustomerUpdate',

				data: formData,

				type: 'POST',

				contentType: false,

				processData: false,

		   	}).done(function(data) {

		    	prompt('updated', 'Customer account has been updated.');

		   	});

	 	}

	}),



	$("#admin_form").validate({

		submitHandler: function(form) {	    	

	    	var formData = new FormData(form);

			$.ajax({

				url: '/?action=adminAdminUpdate',

				data: formData,

				type: 'POST',

				contentType: false,

				processData: false,

			}).done(function(data) {

				console.log(data);

	            var obj = JSON.parse(data);

				console.log(obj.status);

	            if (obj.status == true) {

	            	window.location.href = '/admin/admins/';
	            } else {
					
					prompt('error', 'Error: ' + obj.error);
				}
		    });
			
			
			
			
			// }).done(function(data) {

			// 	console.log(data);
				
			// 	if (data) {

			// 		var obj = JSON.parse(data);

			// 		// console.log(obj.status);
					
			// 		if (obj.error) {

			// 			prompt('error', 'Error: ' + obj.error);
			// 		} else {
					
			// 			prompt('updated', 'Admin account has been updated.');
			// 		}

			// 	}

		   	// });

	 	}

	}),



	$("#faq_form").validate({

		submitHandler: function(form) {

	    	

	    	var formData = new FormData(form);



			$.ajax({

			  url: '/?action=adminFaqUpdate',

			  data: formData,

			  type: 'POST',

			  contentType: false,

			  processData: false,

			}).done(function(data) {

			 prompt('updated', 'FAQ has been updated.');

			});

	 	}

	}),



	$('#delete_product').click(function(e) {

	   e.preventDefault();

	   var product_id = $(this).data('id');

	   $.post('/?action=adminDeleteProduct', {

	   	product_id: product_id

	   }).done(function(data) {

	     $('#deleteProduct').modal('hide');

	     prompt('deleted', 'Product has been deleted.');

	   });

	}),



	$(".delete_product").click(function(e) {

		e.preventDefault();

		var product_id = $(this).data('id');

		$('#delete_product').attr('data-id', product_id);

	    $('#deleteProduct').modal('show');

	}),



	$(".delete_product_variation").click(function(e) {

		e.preventDefault();

		var product_id = $(this).data('id');

		$('#delete_product_variation').attr('data-id', product_id);

	    $('#deleteProductVariation').modal('show');

	}),



	$('#delete_product_variation').click(function(e) {

	   e.preventDefault();

	   var product_id = $(this).data('id');

	   $.post('/?action=adminDeleteProductVariation', {

	   	product_id: product_id

	   }).done(function(data) {

	     $('#deleteProductVariation').modal('hide');

	     $('#product_variation_'+product_id).remove();

	     prompt('Product variation has been deleted.');

	   });

	}),



	$('#delete_faq').click(function(e) {

	   e.preventDefault();

	   var faq_id = $(this).data('id');

	   $.post('/?action=adminDeleteFaq', {

	   	faq_id: faq_id

	   }).done(function(data) {

	     $('#deleteFaq').modal('hide');

	     prompt('deleted', 'FAQ has been deleted.');

	   });

	}),



	$(".delete_faq").click(function(e) {

		e.preventDefault();

		var faq_id = $(this).data('id');

		$('#delete_faq').attr('data-id', faq_id);

	    $('#deleteFaq').modal('show');

	}),



	$('#delete_customer').click(function(e) {

	   e.preventDefault();

	   var customer_id = $(this).data('id');

	   $.post('/?action=adminDeleteCustomer', {

	   	customer_id: customer_id

	   }).done(function(data) {

	     $('#deleteCustomer').modal('hide');

	     prompt('deleted', 'Customer account has been deleted.');

	   });

	}),



	$(".delete_customer").click(function(e) {

		e.preventDefault();

		var customer_id = $(this).data('id');

		$('#delete_customer').attr('data-id', customer_id);

	    $('#deleteCustomer').modal('show');

	}),



	$('#delete_post').click(function(e) {

		e.preventDefault();

		var post_id = $(this).data('id');

	$.post('/?action=adminDeletePost', {

		post_id: post_id

	}).done(function(data) {

		$('#deletePost').modal('hide');

		prompt('deleted', 'Post has been deleted.');

	});

	}),



	$(".delete_post").click(function(e) {

		e.preventDefault();

		var post_id = $(this).data('id');

		$('#delete_post').attr('data-id', post_id);

		$('#deletePost').modal('show');

	}),



	$('#sat_delivery_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminSatDeliveryUpdate',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			console.log(JSON.stringify(data));

			prompt('updated', 'Saturday delivery rate updated.');

		});

	}),
	

	$('#saturday_cutoff_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminSaturdayCutoffUpdate',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			console.log(JSON.stringify(data));

			prompt('updated', 'Saturday delivery cutoff updated.');

		});

	}),
	
	
	
	$('#weekday_cutoff_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminWeekdayCutoffUpdate',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			console.log(JSON.stringify(data));

			prompt('updated', 'Weekday delivery cutoff updated.');

		});

	}),
	
	
	
	$('#public_holiday_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminPublicHolidayUpdate',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			console.log(JSON.stringify(data));

			prompt('updated', 'Public holidays updated.');

		});

	}),
	
	
	
	$('#post_add_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminPostAdd',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			console.log(JSON.stringify(data));

			prompt('updated', 'Post added.');

		});

	}),
	
	
	
	$('#post_update_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminPostUpdate',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			console.log(JSON.stringify(data));

			prompt('updated', 'Post updated.');

		});

	}),
	
	
	
	$('#delete_order').click(function(e) {

		e.preventDefault();

		var order_id = $(this).data('id');

		$.post('/?action=adminDeleteOrder', {

			order_id: order_id

		}).done(function(data) {

			console.log(data);
			$('#deleteOrder').modal('hide');

			prompt('deleted', 'Order has been deleted.');

		});

	}),



	$(".delete_order").click(function(e) {

		console.log('deleting order');
		e.preventDefault();

		var order_id = $(this).data('id');
		console.log(order_id);

		$('#delete_order').attr('data-id', order_id);

		$('#deleteOrder').modal('show');

	}),






	$('#delete_promo').click(function(e) {

		e.preventDefault();

		var promo_id = $(this).data('id');

		$.post('/?action=adminDeletePromo', {

			promo_id: promo_id

		}).done(function(data) {

			console.log(data);
			$('#deletePromo').modal('hide');

			prompt('deleted', 'Promo has been deleted.');

			window.location.href = '/admin/marketing/promos/';

		});

	}),



	$(".delete_promo").click(function(e) {

		console.log('deleting promo');
		e.preventDefault();

		var promo_id = $(this).data('id');
		console.log(promo_id);

		$('#delete_promo').attr('data-id', promo_id);

		$('#deletePromo').modal('show');

	}),








	$('#delete_admin').click(function(e) {

	   e.preventDefault();



	   var admin_id = $(this).data('id');



	   $.post('/?action=adminDeleteCustomer', {

	   	customer_id: admin_id

	   }).done(function(data) {



	     $('#deleteAdmin').modal('hide');

	     prompt('deleted', 'Admin account has been deleted.');

	   });

	}),



	$(".delete_admin").click(function(e) {

		e.preventDefault();



		var admin_id = $(this).data('id');



		$('#delete_admin').attr('data-id', admin_id);

	    $('#deleteAdmin').modal('show');

	}),



	$(document).on('change', '.change_color', function(e) {

		e.preventDefault();



		var product_id = $(this).find(':selected').data('id');

		var selected_value = $(this).find(':selected').data('code');

		var product_code = $('#product_code').val();



		$('#product_code_'+product_id).val(product_code+''+selected_value);



		console.log(product_code+''+selected_value);

	}),






	// CRM START


	$('#add_lead_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminLeadAdd',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			// console.log(JSON.stringify(data));

			// prompt('added', 'Lead added');

			window.location.href = "/admin/leads/new-requests/";

		});

	}),



	$('#update_lead_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminLeadUpdate',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			// console.log(JSON.stringify(data));
			// prompt('added', 'Lead updated');
			// window.location.href = "/admin/leads/new-requests/";

			location.reload();

		});

	}),



	$('#add_lead_notes_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminLeadNoteAdd',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			// console.log(JSON.stringify(data));
			// prompt('added', 'Lead notes updated');
			// window.location.href = "/admin/leads/new-requests/";

			location.reload();

		});

	}),



	$('#lead_status_update_form').submit(function(e) {

		e.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: '/?action=adminLeadStatusUpdate',

			data: formData,

			type: 'POST',

			contentType: false,

			processData: false,

		}).done(function(data) {

			// prompt('deleted', 'Lead status updated.');
			
			location.reload();

		});

	}),



	$('#delete_lead').click(function(e) {

		e.preventDefault();

		var lead_id = $(this).data('id');

		$.post('/?action=adminDeleteLead', {

			lead_id: lead_id

		}).done(function(data) {

			console.log(data);
			$('#deleteLead').modal('hide');

			// prompt('deleted', 'Lead has been deleted.');

			location.reload();

		});

	}),



	$(".delete_lead").click(function(e) {

		console.log('deleting lead');
		e.preventDefault();

		var lead_id = $(this).data('id');
		console.log(lead_id);

		$('#delete_lead').attr('data-id', lead_id);

		$('#deleteLead').modal('show');

	})













});



function prompt(type, message) {



	alert(message);



	location.reload(); 

}