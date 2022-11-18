<?php

class Lead
{

	public static function getLeadStatus($lead_status_id)
	{
		$lead_status =  DB::run('SELECT * FROM lead_statuses WHERE id = ?', [$lead_status_id])->fetch();
		return $lead_status['name'];
	}	
	
	
	public static function getLeadStatuses()
	{
		return DB::run('SELECT * FROM lead_statuses')->fetchAll();
	}
	
	
	public static function getLeadNotes($lead_id)
	{
		return DB::run('SELECT * FROM lead_notes WHERE lead_id = ? ORDER BY id DESC', [$lead_id])->fetchAll();
	}


	public static function getLeadNoteAuthor($note_id)
	{
		return DB::run('SELECT * FROM customers WHERE id = ?', [$note_id])->fetch();
	}

	
	public static function getLeadActions()
	{
		return DB::run('SELECT * FROM lead_note_actions')->fetchAll();
	}


	public static function getLeadCategories()
	{
		return DB::run('SELECT * FROM lead_note_categories')->fetchAll();
	}


	public static function adminLeadAdd()
	{

		// if (Customer::adminLoggedIn()) {

		$customer_title = $_POST['customer_title'];
		$customer_first_name = $_POST['customer_first_name'];
		$customer_last_name = $_POST['customer_last_name'];
		$brand = $_POST['brand'];
		$customer_tel_mobile = $_POST['customer_tel_mobile'];
		$customer_email = $_POST['customer_email'];
		$contact_method = $_POST['contact_method'];

		$customer_address1 = $_POST['customer_address1'];
		$customer_address2 = $_POST['customer_address2'];
		$customer_city = $_POST['customer_city'];
		$customer_county = $_POST['customer_county'];
		$customer_postcode = $_POST['customer_postcode'];
		$customer_country = $_POST['customer_country'];

		$notes = $_POST['notes'];


		$sql = "INSERT INTO leads SET customer_title = ?, customer_first_name = ?, customer_last_name = ?, brand = ?, customer_tel_mobile = ?, customer_email = ?, contact_method = ?, customer_address1 = ?, customer_address2 = ?, customer_city = ?, customer_county = ?, customer_postcode = ?, customer_country = ?, notes = ?";
		DB::run($sql, [
			$customer_title,
			$customer_first_name,
			$customer_last_name,
			$brand,
			$customer_tel_mobile,
			$customer_email,
			$contact_method,
			$customer_address1,
			$customer_address2,
			$customer_city,
			$customer_county,
			$customer_postcode,
			$customer_country,
			$notes
		]);

		// }

	}

	public static function adminLeadNoteAdd()
	{

		$lead_id = $_POST['lead_id'];
		$user_id = $_POST['user_id'];
		$action_id = $_POST['action_id'];
		$category_id = $_POST['category_id'];
		$gdpr_check = (is_array($_POST['gdpr_check'])) ? $_POST['gdpr_check'] : array();
		$gdpr_check = implode(',', $gdpr_check);
		$content = $_POST['content'];

		$sql = "INSERT INTO lead_notes SET lead_id = ?, user_id = ?, action_id = ?, category_id = ?, gdpr_check = ?, content = ?";
		DB::run($sql, [
			$lead_id,
			$user_id,
			$action_id,
			$category_id,
			$gdpr_check,
			$content
		]);

	}


	public static function adminLeadStatusUpdate()
	{

		$lead_id = $_POST['lead_id'];
		$lead_status_id = $_POST['lead_status_id'];

		$sql = "UPDATE leads SET lead_status_id = ? WHERE id = ?";
		DB::run($sql, [
			$lead_status_id,
			$lead_id
		]);

	}


	public static function adminLeadUpdate()
	{

		// if (Customer::adminLoggedIn()) {

		$lead_id = $_POST['lead_id'];

		$customer_title = $_POST['customer_title'];
		$customer_first_name = $_POST['customer_first_name'];
		$customer_last_name = $_POST['customer_last_name'];
		$brand = $_POST['brand'];
		$customer_tel_mobile = $_POST['customer_tel_mobile'];
		$customer_email = $_POST['customer_email'];
		$contact_method = $_POST['contact_method'];

		$customer_address1 = $_POST['customer_address1'];
		$customer_address2 = $_POST['customer_address2'];
		$customer_city = $_POST['customer_city'];
		$customer_county = $_POST['customer_county'];
		$customer_postcode = $_POST['customer_postcode'];
		$customer_country = $_POST['customer_country'];

		$notes = $_POST['notes'];


		$sql = "UPDATE leads SET customer_title = ?, customer_first_name = ?, customer_last_name = ?, brand = ?, customer_tel_mobile = ?, customer_email = ?, contact_method = ?, customer_address1 = ?, customer_address2 = ?, customer_city = ?, customer_county = ?, customer_postcode = ?, customer_country = ?, notes = ? WHERE id = ?";
		DB::run($sql, [
			$customer_title,
			$customer_first_name,
			$customer_last_name,
			$brand,
			$customer_tel_mobile,
			$customer_email,
			$contact_method,
			$customer_address1,
			$customer_address2,
			$customer_city,
			$customer_county,
			$customer_postcode,
			$customer_country,
			$notes,
			$lead_id
		]);

		// }

	}



	public static function adminDeleteLead()
	{

		if (Customer::adminLoggedIn()) {

			$lead_id = $_POST['lead_id'];

			DB::run('DELETE FROM leads WHERE id = ?', [$lead_id]);

			exit();
		}
	}
}
