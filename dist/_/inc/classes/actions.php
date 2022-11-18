<?php

class Actions {

	public static function init() {

		if (isset($_REQUEST['action'])) {

			$action = $_REQUEST['action'];
			if (method_exists(__CLASS__, $action)) {

				self::$action();

				if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				  exit();
				}
			}
		} else {

			self::redirects();
		}
	}

	private static function updateProfile() {

		Customer::updateProfile();
	}

	private static function addressPrimary() {

		Customer::addressPrimary();
	}

	private static function addAddress() {

		Customer::addAddress();
	}

	private static function forgotPassword() {

		Customer::forgotPassword();
	}

	private static function registerAccount() {

		Customer::registerAccount();
	}

	private static function updateAddress() {


		Customer::updateAddress();
	}

	private static function updateCart() {

        Cart::updateCart();
	}

	private static function addItem() {

		Cart::addItem();
	}

	private static function removeItem() {

		Cart::removeItem();
	}

	private static function emptyCart() {

		Cart::emptyCart();
	}

	public static function removeWishlist() {

		Cart::removeWishlist();
	}

	public static function addWishlist() {

		Cart::addWishlist();
	}

    public static function removePromo() {

        Cart::removePromo();
    }

    public static function removeGuarantee() {

		Products::removeGuarantee();
	}

	public static function processPayment() {

		Payment::processPayment();
	}

	public static function paymentKey() {

		Payment::paymentKey();
	}

	public static function checkoutDetails() {

		Order::checkoutDetails();
	}


	public static function login() {

		Customer::login();
	}

	public static function updateNewsletter() {

		Customer::updateNewsletter();
	}

	public static function removeAddress() {

		Customer::removeAddress();
	}

	private static function registerProduct() {

		Products::registerProductAdd();
	}

	private static function getTotalWishes() {

		Cart::getTotalWishes();
	}

	private static function countCart() {

		Cart::countCart();
	}

	private static function setGuestSession() {

		Cart::setGuestSession();
	}
	
	private static function getOrderSummary() {

		Cart::getOrderSummary();
	}

	// Admin

    private static function adminSatDeliveryUpdate() {

		Order::adminSatDeliveryUpdate();    
	}
	
    private static function adminSaturdayCutoffUpdate() {

		Order::adminSaturdayCutoffUpdate();    
	}
	
    private static function adminWeekdayCutoffUpdate() {

		Order::adminWeekdayCutoffUpdate();    
	}
	
    private static function adminPublicHolidayUpdate() {

		Order::adminPublicHolidayUpdate();    
	}
	
	private static function adminEmailInvoice() {

        Order::adminEmailInvoice();
    }

    private static function adminEmailGuarantee() {

        Order::adminEmailGuarantee();
    }

	private static function adminSendInvoiceAndGuarantee() {

        Order::adminSendInvoiceAndGuarantee();
    }

    private static function adminProductUpdate() {

		Products::adminProductUpdate();
	}

	private static function adminAddProductVariation() {

		Products::adminAddProductVariation();
	}

	private static function createOrderAccount() {

		Customer::createOrderAccount();
	}

	private static function adminAddProduct() {

		Products::adminAddProduct();
	}

	private static function adminDeleteProduct() {

		Products::adminDeleteProduct();
	}

	private static function adminDeleteProductVariation() {

		Products::adminDeleteProductVariation();
	}

	private static function adminOrdersExport() {

		Order::adminOrdersExport();
	}	
	
	private static function adminCustomerUpdate() {

		Customer::adminCustomerUpdate();
	}

	private static function adminAdminUpdate() {

		Customer::adminAdminUpdate();
	}

    private static function adminAddCustomer() {

        Customer::adminAddCustomer();
    }

	private static function adminAddAdmin() {

        Customer::adminAddAdmin();
    }

	private static function adminDeleteCustomer() {

		Customer::adminDeleteCustomer();
	}

	private static function adminEmailUpdate() {

		Customer::adminEmailUpdate();
	}

	private static function adminPromoUpdate() {

		Promo::adminPromoUpdate();
	}

	private static function adminPromoAdd() {

		Promo::adminPromoAdd();
	}

	private static function adminAddFaq() {

		Faqs::adminAddFaq();
	}
	
	private static function adminFaqUpdate() {

		Faqs::adminFaqUpdate();
	}

	private static function adminDeleteFaq() {

		Faqs::adminDeleteFaq();
	}

	private static function adminProductOrderTracking() {

		Order::adminProductOrderTracking();
	}

	private static function adminProductOrderStatus() {

		Order::adminProductOrderStatus();
	}

    private static function adminProductSapUpdate() {

        Order::adminProductSapUpdate();
    }

    private static function adminDeleteOrder() {

        Order::adminDeleteOrder();
    }

	private static function adminDeletePromo() {

        Promo::adminDeletePromo();
    }

	private static function adminPostAdd() {

        Post::adminPostAdd();
    }
	
	private static function adminPostUpdate() {

        Post::adminPostUpdate();
    }

	private static function adminDeletePost() {

        Post::adminDeletePost();
    }




	


	// CRM START

	private static function adminLeadAdd() {

		Lead::adminLeadAdd();
	}

	private static function adminLeadUpdate() {

		Lead::adminLeadUpdate();
	}

	private static function adminDeleteLead() {

        Lead::adminDeleteLead();
    }

	private static function adminLeadNoteAdd() {

        Lead::adminLeadNoteAdd();
    }
	
	private static function adminLeadStatusUpdate() {

        Lead::adminLeadStatusUpdate();
    }




	private static function redirects() {
		global $currentPage, $accountSection;

		if ($currentPage == 'account') {

			switch ($accountSection) {

				default:

					if (!Customer::loggedIn()) {

						// header('Location: /account');
					}

				break;

				case 'login':

					if (Customer::loggedIn()) {

					    header('Location: /admin/leads/new-requests/');
					}

				break;

				case 'reset':
				case 'logout':
				case 'register':

				break;

			}
		} else if ($currentPage == 'guest') {

			switch($accountSection) {

				case 'wishlist':

					if (Customer::loggedIn()) {

						header('Location: /account/wishlist');
					}

				break;

			}
		}
	}
}

Actions::init();
