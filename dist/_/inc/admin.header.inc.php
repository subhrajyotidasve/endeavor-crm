<?php

include('core.php');
include('admin.php');
if (!empty($_GET['lead_id'])) {
	$_SESSION['lead']['lead_id'] = $_GET['lead_id'];
	$current_lead = DB::run('SELECT * FROM leads WHERE id =?', [$_GET['lead_id']])->fetch();
}
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--plugins-->

	<!-- Favicons -->
	<link rel="icon" href="/_/admin/images/favicons/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" href="/_/admin/images/favicons/favicon-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="/_/admin/images/favicons/favicon-180x180.png" />
	<!-- <link rel="icon" href="/_/admin/images/favicons/favicon.ico"> -->

	<link href="/_/admin/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet">
	<link href="/_/admin/plugins/simplebar/css/simplebar.css" rel="stylesheet">
	<link href="/_/admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
	<link href="/_/admin/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
	<!-- Bootstrap CSS -->
	<link href="/_/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="/_/admin/css/bootstrap-extended.css" rel="stylesheet">
	<link href="/_/admin/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="/_/admin/css/app.css" rel="stylesheet">
	<link href="/_/admin/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="/_/admin/css/dark-theme.css">
	<link rel="stylesheet" href="/_/admin/css/semi-dark.css">
	<link rel="stylesheet" href="/_/admin/css/header-colors.css">
	<title>EndeavorCRM | <?php echo $pageTitle; ?></title>


	<!-- Bootstrap JS -->
	<script src="/_/admin/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="/_/admin/js/jquery.min.js"></script>
	<script src="/_/admin/js/jquery.validate.min.js"></script>
	<script src="/_/admin/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/_/admin/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/_/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="/_/admin/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="/_/admin/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<!--app JS-->
	<script src="/_/admin/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
	<!-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> -->


	<!-- <script>
		var admin_folder = '<?php echo ADMIN_FOLDER; ?>';
	</script> -->
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="false">
			<div class="sidebar-header">
				<a href="/admin" title="Return to dashboard">
					<img src="/_/img/theme/logo.png" width="160" alt="">
				</a>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="metismenu">

				<!-- dashboard menu -->
				<li <?php echo ($menuItem1 == 'dashboard') ? "class='mm-active'" : '' ?>>
					<a href="/<?= ADMIN_FOLDER ?>">
						<div class="parent-icon"><i class='bx bx-bar-chart-alt-2'></i></div>
						<div class="menu-title">DASHBOARD</div>
					</a>
				</li>

				<!-- leads menu -->
				<li <?php echo ($menuItem1 == 'leads') ? "class='mm-active'" : '' ?>>
					<a href="javascript:;" class="has-arrow" aria-expanded="false">
						<div class="parent-icon"><i class='bx bx-list-ul'></i></div>
						<div class="menu-title">LEADS</div>
					</a>
					<ul>
						<li <?php echo ($menuItem2 == 'new-requests') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/leads/new-requests">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>New Requests</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'follow-up') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/leads/follow-up/?status=follow-up">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Future Follow-Up</span>
							</a>
						</li>
					</ul>
				</li>

				<!-- orders menu -->
				<li <?php echo ($menuItem1 == 'orders') ? "class='mm-active'" : '' ?>>
					<a href="javascript:;" class="has-arrow" aria-expanded="false">
						<div class="parent-icon"><i class='bx bx-dollar'></i></div>
						<div class="menu-title">ORDERS</div>
					</a>
					<ul>
						<li <?php echo ($menuItem2 == 'waiting-approval') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/waiting-approval">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Waiting Approval</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'waiting-processing') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/waiting-processing">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Waiting Processing</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'waiting-legal-forms') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/waiting-legal-forms">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Waiting for Legal Forms</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'kits-to-send') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/kits-to-send">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Kits to Send Out</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'waiting-office-confirmation') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/waiting-office-confirmation">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Waiting for Office Conf</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'waiting-samples') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/waiting-samples">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Waiting for Samples</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'samples-received') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/samples-received">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Samples Received</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'waiting-results') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/waiting-results">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Waiting for Results</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'results') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/results">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Results</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'expired') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/orders/expired">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Expired</span>
							</a>
						</li>
					</ul>
				</li>

				<!-- agents menu -->
				<li <?php echo ($menuItem1 == 'agents') ? "class='mm-active'" : '' ?>>
					<a href="javascript:;" class="has-arrow" aria-expanded="false">
						<div class="parent-icon"><i class='bx bx-id-card'></i></div>
						<div class="menu-title">AGENTS</div>
					</a>
					<ul>
						<li <?php echo ($menuItem2 == 'list') ? "class='mm-active'" : '' ?>>
							<a href="/<?php echo ADMIN_FOLDER; ?>/agents/"><i class="bx bx-right-arrow-alt"></i>List</a>
						</li>
					</ul>
				</li>

				<!-- manage menu -->
				<li <?php echo ($menuItem1 == 'manage') ? "class='mm-active'" : '' ?>>
					<a href="javascript:;" class="has-arrow" aria-expanded="false">
						<div class="parent-icon"><i class='bx bx-cog'></i></div>
						<div class="menu-title">MANAGE</div>
					</a>
					<ul>
						<li <?php echo ($menuItem2 == 'test-details') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/manage/test-details/">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Test Details</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'email-templates') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/manage/email-templates/">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Email Templates</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'address-book') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/manage/address-book/">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Address Book</span>
							</a>
						</li>
						<li <?php echo ($menuItem2 == 'waiting-results') ? "class='mm-active'" : '' ?>>
							<a href="/<?= ADMIN_FOLDER ?>/manage/email-snippets/">
								<span class="title"><i class="bx bx-right-arrow-alt"></i>Email Custom Text</span>
							</a>
						</li>
					</ul>
				</li>

				<!-- sales figures menu -->
				<li <?php echo ($menuItem1 == 'sales') ? "class='mm-active'" : '' ?>>
					<a href="javascript:;" class="has-arrow" aria-expanded="false">
						<div class="parent-icon"><i class='bx bx-bar-chart'></i></div>
						<div class="menu-title">SALES</div>
					</a>
					<ul>
						<li <?php echo ($menuItem2 == 'sales-figures') ? "class='mm-active'" : '' ?>>
							<a href="/<?php echo ADMIN_FOLDER; ?>/sales/sales-figures/"><i class="bx bx-right-arrow-alt"></i>Sales Figures</a>
						</li>
					</ul>
				</li>

				<!-- testing (dev) menu -->
				<li <?php echo ($menuItem1 == 'testing') ? "class='mm-active'" : '' ?>>
					<a href="javascript:;" class="has-arrow" aria-expanded="false">
						<div class="parent-icon"><i class='bx bx-network-chart'></i></div>
						<div class="menu-title">TESTING</div>
					</a>
					<ul>
						<li <?php echo ($menuItem2 == 'debug') ? "class='mm-active'" : '' ?>>
							<a href="/<?php echo ADMIN_FOLDER; ?>/testing/"><i class="bx bx-right-arrow-alt"></i>Debug</a>
						</li>
					</ul>
				</li>

				<!-- current client -->
				<?php if (!empty($current_lead)) { ?>
					<div id="menu_current_lead">

						<!-- <div class="parent-icon"><i class='bx bx-id-card'></i></div> -->
						<p class="menu-title">CURRENT CLIENT</p>

						<p>
							<?= $current_lead['customer_first_name'] . ' ' . $current_lead['customer_last_name'] ?><br>
							<small><?= $current_lead['case_reference'] ?></small>
						</p>

					</div>
				<?php } ?>

			</ul>
			<!--end navigation-->

		</div>
		<!--end sidebar wrapper -->


		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class="bx bx-search"></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class="bx bx-x"></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#"> <i class='bx bx-search'></i>
								</a>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="<?php echo $_SESSION['customer']['user_avatar']; ?>" class="user-img" alt="<?php echo $_SESSION['customer']['first_name'] . ' ' . $_SESSION['customer']['last_name']; ?>">
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $_SESSION['customer']['first_name'] . ' ' . $_SESSION['customer']['last_name']; ?></p>
								<p class="designattion mb-0">Admin</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="/admin/admins/edit.php?id=<?= $_SESSION['customer']['id'] ?>"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>

							<li>
								<div class="dropdown-divider m-0"></div>
							</li>

							<li>
								<a class="dropdown-item" href="/"><i class="bx bx-globe"></i><span>Website home</span></a>
							</li>


							<li>
								<div class="dropdown-divider m-0"></div>
							</li>

							<li>
								<a class="dropdown-item" href="/account/dashboard"><i class="bx bx-globe"></i><span>Customer admin</span></a>
							</li>


							<li>
								<div class="dropdown-divider m-0"></div>
							</li>

							<li><a class="dropdown-item" href="/account/logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">