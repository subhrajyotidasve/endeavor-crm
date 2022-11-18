	

	<!-- Overlay for dropdown navigation -->
	<div id="overlay" aria-hidden="true" style="display: none;"></div>

	<!-- Load Global JS -->
	<script src="/_/js/global.min.js?v=100"></script>
	<script src="https://cdn.getaddress.io/scripts/jquery.getAddress-4.0.0.min.js"></script>
	<script src="https://pi-test.sagepay.com/api/v1/js/sagepay.js"></script>
	<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51aee1dc1b323034"></script>

	<!-- Create date picker instance (for store details page) -->
	<?php
	$public_holidays = DB::run('SELECT * FROM settings WHERE setting_name LIKE ?', ['%public_holiday%'])->fetchAll();
	$lockDays = "[";
	foreach ($public_holidays as $holiday) {
		if (!empty($holiday['setting_value'])) {
			$lockDays .= "'" . $holiday['setting_value'] . "', ";
		}
	}
	$lockDays .= "'']";
	// echo $lockDays;
	?>
	<script>
		if (document.getElementById('date-picker')) { // prevents console errors on pages where not used

			var today = new Date();
			var tomorrow = new Date();
			tomorrow.setDate(tomorrow.getDate() + 1);
			var picker = new Litepicker({
				element: document.getElementById('date-picker'),
				format: 'DD-MM-YYYY',
				lockDaysFormat: 'DD-MM-YYYY',
				singleMode: true,
				lockDaysFilter: (day) => {
					const d = day.getDay();

					return [0].includes(d);
				},
				// lockDays: ['26-12-2022', '27-12-2022'],
				lockDays: <?= $lockDays ?>,
				minDate: today
			});

		}
	</script>

	<?php if (isset($isCaptcha)) { ?>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	<?php } ?>

	<script>
		<?php

		if (isset($javascript) && is_array($javascript)) {

			foreach ($javascript as $func) {

				echo 'functions["' . $func . '"]();';
			}
		}

		?>
		functions['default']();

		<?php if ($currentPage == 'home') { ?>
			functions['home_page']();
		<?php } ?>

		<?php if (isset($isFiltered)) { ?>
			functions['is_filtered']();
		<?php } ?>

		<?php if (isset($clientFilter)) { ?>
			functions['client_filtered']();
		<?php } ?>

		<?php if (isset($countryFilter)) { ?>
			functions['country_filtered']();
		<?php } ?>

		<?php if (isset($pageType) && $pageType == 'detail') { ?>
			functions['details']();
		<?php } ?>

		<?php if ((isset($pageType) && $pageType == 'detail') || $currentPage == 'faqs') { ?>
			functions['accordions']();
		<?php } ?>

		<?php if (isset($productRange) && $productRange == 'Childrens Mattresses') { ?>
			functions['bottles']();
		<?php } ?>

		<?php if ($currentPage == 'faqs') { ?>


			// Set up FAQ Filtering
			var faqList = new List('faq-list', {
				valueNames: ['questions__accord-question']
			});

		<?php } ?>

		<?php if ($currentPage == 'account') { ?>

			//  Prevent form resubmission (negates any unwanted duplicates)
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}

			$(".my-account-form__reveal-link").click(function() {
				$(".my-account-form__set--password").slideToggle();
			});


		<?php } ?>

		<?php if (isset($_SESSION['flash'])) { ?>
			prompt('<?php echo $_SESSION['flash']['type']; ?>', '<?php echo $_SESSION['flash']['title']; ?>', '<?php echo $_SESSION['flash']['message']; ?>');
		<?php } ?>
	</script>

	<?php if (($currentPage = 'cart') /* && ($pageType == 'details') */) { ?>
		<script>
			// var delivery_date = $('#date-picker').val();

			// $('#clear_delivery_date').on('click', function(e) {

			// 	e.preventDefault();

			// 	// $('#date-picker').val('');

			// 	$.post("/", {
			// 		"action": 'getOrderSummary',
			// 		"delivery_date": 'reset'
			// 	}).done(function(data) {

			// 		if (data) {
			// 			// console.log(data);
			// 			$('#date-picker').val('');
			// 			$('#order_summary').html(data);
			// 		}

			// 	});


			// 	// e.preventDefault();
			// 	// $('#date-picker').val('');



			// });





			$(document).on('click', function() {
				
				var delivery_date = $('#date-picker').val();
				
				if( $(event.target).hasClass('clear_delivery_date') ) {

					$('#date-picker').val('');
					var delivery_date = 'reset';
				}
				
				console.log('Selected date: ' + delivery_date);
				
				$('#delivery_date_copy').val($('#date-picker').val());

				$.post("/", {
					"action": 'getOrderSummary',
					"delivery_date": delivery_date
				}).done(function(data) {

					if (data) {
						
						// console.log(data);
						// $('#order_summary').html(data);
						
						var obj = JSON.parse(data);
						console.log('Returned date: ' + obj.delivery_date);
						$('#order_summary').html(obj.content);
						$('#date-picker').val(obj.delivery_date);
					}

				});

			});
		</script>
	<?php } ?>

	</body>

	</html>
	<?php Session::removeFlash(); ?>