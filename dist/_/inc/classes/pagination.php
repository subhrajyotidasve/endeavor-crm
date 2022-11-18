<?php

class Pagination
{

	private static $totalpages;
	private static $range;
	private static $page;
	private static $rowsperpage;
	private static $args;

	public static function getResults($table, $rowsperpage = 100, $args = NULL, $range = 3)
	{

		self::$range = $range;
		self::$rowsperpage = $rowsperpage;
		self::$args = $args;

		$search_sql = '';

		switch ($table) {

			case 'products':

				if (isset($_REQUEST['search'])) {

					$search_sql = ' AND p.product_name LIKE \'%' . $_REQUEST['search'] . '%\' OR p.product_nickname LIKE \'%' . $_REQUEST['search'] . '%\' OR p.product_code = \'' . $_REQUEST['search'] . '\'';
				}

				$numrows = DB::run('SELECT * FROM products AS p WHERE p.parent_id = 0 AND p.deleted_at IS NULL' . $search_sql)->rowCount();

				$sql = 'SELECT *, p.id AS id, pc.id AS product_category_id FROM products AS p JOIN product_categories AS pc ON p.product_category = pc.id WHERE p.parent_id = 0 AND p.deleted_at IS NULL' . $search_sql . ' ORDER BY p.id DESC';

				break;

			case 'jobs':

				// if (isset($_REQUEST['search'])) {

				// 	$search_sql = ' AND p.product_name LIKE \'%'.$_REQUEST['search'].'%\' OR p.product_nickname LIKE \'%'.$_REQUEST['search'].'%\' OR p.product_code = \''.$_REQUEST['search'].'\'';
				// }

				$numrows = DB::run("SELECT * FROM posts WHERE post_type = 'job'" . $search_sql)->rowCount();

				$sql = "SELECT * FROM posts WHERE post_type = 'job' ORDER BY id DESC";

				break;

			case 'faqs':

				if (isset($_REQUEST['search'])) {

					$search_sql = ' AND question LIKE \'%' . $_REQUEST['search'] . '%\' OR answer LIKE \'%' . $_REQUEST['search'] . '%\'';
				}

				$numrows = DB::run('SELECT * FROM faqs WHERE deleted_at IS NULL' . $search_sql)->rowCount();

				$sql = 'SELECT * FROM faqs WHERE deleted_at IS NULL' . $search_sql . ' ORDER BY id DESC';

				break;

			case 'orders':

				if (isset($_REQUEST['search'])) {

					$search_sql .= ' AND customer_first_name LIKE \'%' . $_REQUEST['search'] . '%\' OR customer_last_name LIKE \'%' . $_REQUEST['search'] . '%\' OR customer_email LIKE \'%' . $_REQUEST['search'] . '%\' OR order_no LIKE \'%' . $_REQUEST['search'] . '%\' OR customer_postcode LIKE \'%' . $_REQUEST['search'] . '%\' OR created_at LIKE \'%' . $_REQUEST['search'] . '%\' OR sap_no LIKE \'%' . $_REQUEST['search'] . '%\'';
				}

				if (isset($_GET['status'])) {

					if ($_GET['status'] == 'follow-up') {

						$search_sql .= ' AND follow_up IS NOT NULL';
					} else {

						$search_sql .= ' AND order_status LIKE \'%' . $_GET['status'] . '%\'';
					}
				}

				$numrows = DB::run('SELECT * FROM leads WHERE lead_type = \'order\' AND deleted_at IS NULL' . $search_sql)->rowCount();

				$sql = 'SELECT * FROM leads WHERE lead_type = \'order\' AND deleted_at IS NULL' . $search_sql . ' ORDER BY id DESC';

				break;

			case 'leads':

				if (isset($_REQUEST['search'])) {

					$search_sql .= ' AND customer_first_name LIKE \'%' . $_REQUEST['search'] . '%\' OR customer_last_name LIKE \'%' . $_REQUEST['search'] . '%\' OR customer_email LIKE \'%' . $_REQUEST['search'] . '%\' OR order_no LIKE \'%' . $_REQUEST['search'] . '%\' OR customer_postcode LIKE \'%' . $_REQUEST['search'] . '%\' OR created_at LIKE \'%' . $_REQUEST['search'] . '%\' OR sap_no LIKE \'%' . $_REQUEST['search'] . '%\'';
				}

				if (isset($_GET['status'])) {

					if ($_GET['status'] == 'follow-up') {

						$search_sql .= ' AND follow_up IS NOT NULL';
					} else {

						$search_sql .= ' AND order_status LIKE \'%' . $_GET['status'] . '%\'';
					}
				} else {

					$search_sql .= ' AND follow_up IS NULL';
				}

				if (!empty($args)) {
					foreach ($args as $arg) {
						$search_sql .= ' AND ' . $arg[0] . ' = \'' . $arg[1] . '\'';
					}
				}

				$numrows = DB::run('SELECT * FROM leads WHERE lead_type = \'lead\' AND deleted_at IS NULL' . $search_sql)->rowCount();

				$sql = 'SELECT * FROM leads WHERE lead_type = \'lead\' AND deleted_at IS NULL' . $search_sql . ' ORDER BY id DESC';

				break;

			case 'countries':

				//                if (isset($_REQUEST['search'])) {
				//
				//                    $search_sql = ' AND country_name LIKE \'%'.$_REQUEST['search'].'%\' OR country_code LIKE \'%'.$_REQUEST['search'].'%\' OR currency_code LIKE \'%'.$_REQUEST['search'].'%\'';
				//                }

				$numrows = DB::run('SELECT * FROM countries' . $search_sql)->rowCount();

				$sql = 'SELECT * FROM countries' . $search_sql;

				break;

			case 'customers':

				if (isset($_REQUEST['search'])) {

					$search_sql = ' AND first_name LIKE \'%' . $_REQUEST['search'] . '%\' OR last_name LIKE \'%' . $_REQUEST['search'] . '%\' OR email LIKE \'%' . $_REQUEST['search'] . '%\'';
				}

				$numrows = DB::run('SELECT * FROM customers WHERE deleted_at IS NULL AND admin = 0' . $search_sql)->rowCount();

				$sql = 'SELECT * FROM customers WHERE deleted_at IS NULL AND admin = 0' . $search_sql . ' ORDER BY id DESC';

				break;

			case 'admins':

				if (isset($_REQUEST['search'])) {

					$search_sql = ' AND first_name LIKE \'%' . $_REQUEST['search'] . '%\' OR last_name LIKE \'%' . $_REQUEST['search'] . '%\' OR email LIKE \'%' . $_REQUEST['search'] . '%\'';
				}

				$numrows = DB::run('SELECT * FROM customers WHERE deleted_at IS NULL AND admin = 1' . $search_sql)->rowCount();

				$sql = 'SELECT * FROM customers WHERE deleted_at IS NULL AND admin = 1' . $search_sql . ' ORDER BY id DESC';

				break;
		}

		// find out total pages
		self::$totalpages = ceil($numrows / self::$rowsperpage);

		// get the current page or set a default
		if (isset($_GET['page']) && is_numeric($_GET['page'])) {

			self::$page = (int) $_GET['page'];
		} else {

			self::$page = 1;
		}

		// if current page is greater than total pages...
		if (self::$page > self::$totalpages) {

			self::$page = self::$totalpages;
		}

		// if current page is less than first page...
		if (self::$page < 1) {

			self::$page = 1;
		}

		// the offset of the list, based on current page 
		$offset = (self::$page - 1) * self::$rowsperpage;

		return DB::run($sql . ' LIMIT ' . $offset . ', ' . self::$rowsperpage)->fetchAll();
	}

	public static function pageLinks()
	{

		if (isset($_REQUEST['search'])) {

			$search = '&search=' . $_REQUEST['search'];
		} else {

			$search = '';
		}

		// Show pagination only if required (i.e. more than one page of results)
		if (self::$totalpages > 1) {

			echo '<div id="pagination" class="mt-5 mb-5">';

			// if not on page 1, don't show back links
			if (self::$page > 1) {
				// show << link to go back to page 1
				echo ' <a class="btn btn-secondary" href="' . $_SERVER['PHP_SELF'] . '?page=1' . $search . '"><<</a> ';
				// get previous page num
				$prevpage = self::$page - 1;
				// show < link to go back to 1 page
				echo ' <a class="btn btn-secondary" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prevpage . $search . '"><</a> ';
			} // end if

			// loop to show links to range of pages around current page
			for ($x = (self::$page - self::$range); $x < ((self::$page + self::$range) + 1); $x++) {
				// if it's a valid page number...
				if (($x > 0) && ($x <= self::$totalpages)) {
					// if we're on current page...
					if ($x == self::$page) {
						// 'highlight' it but don't make a link
						echo ' <a class="btn btn-primary" href=""><b>' . $x . '</b></a> ';
						// if not current page...
					} else {
						// make it a link
						echo ' <a class="btn btn-secondary" href="' . $_SERVER['PHP_SELF'] . '?page=' . $x . $search . '">' . $x . '</a> ';
					} // end else
				} // end if
			} // end for

			// if not on last page, show forward and last page links
			if (self::$page != self::$totalpages) {
				// get next page
				$nextpage = self::$page + 1;
				// echo forward link for next page
				echo ' <a class="btn btn-secondary" href="' . $_SERVER['PHP_SELF'] . '?page=' . $nextpage . $search . '">></a> ';
				// echo forward link for lastpage
				echo ' <a class="btn btn-secondary" href="' . $_SERVER['PHP_SELF'] . '?page=' . self::$totalpages . $search . '">>></a> ';
			} // end if

			echo '</div>';
		} // end if pagination required
	}
}
