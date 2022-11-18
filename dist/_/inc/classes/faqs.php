<?php

class Faqs {

	public static function all() {

		return DB::run('SELECT * FROM faqs WHERE deleted_at IS NULL');
	}

	public static function get($id) {

		return DB::run('SELECT * FROM faqs WHERE id = ?', [$id])->fetch();
	}

	
	public static function adminAddFaq() {

		if (Customer::adminLoggedIn()) {

			$question = $_POST['question'];
			
			$faq = DB::run('INSERT INTO faqs SET question = ?', [
				$question
			]);

			echo DB::lastInsertId();
		}
	}
	
	
	public static function adminFaqUpdate() {

		if (Customer::adminLoggedIn()) {

			$id = $_POST['id'];

			$faq = DB::run('SELECT * FROM faqs WHERE id = ?', [$id])->rowCount();
			if ($faq == 1) {

				$question = $_POST['question'];
				$answer = $_POST['answer'];
				
				$categories = [];

				if (isset($_POST['category'])) {

					foreach ($_POST['category'] as $value) {

						$categories[] = $value;
					}
				}

				DB::run('UPDATE faqs SET question = ?, answer = ?, categories = ?, updated_at = ? WHERE id = ?', [
					$question,
					$answer,
					serialize($categories),
					date('Y-m-d h:i:s'),
					$id
				]);
			}
		}
	}

	public static function getFaqs($category) {

		$return = [];

		$faqs = DB::run('SELECT * FROM faqs WHERE deleted_at IS NULL')->fetchAll();
		foreach ($faqs as $faq) {

			$unserialize = unserialize($faq['categories']);
			if (!empty($unserialize) && in_array($category, $unserialize)) {

				$return[] = [
					'question' => $faq['question'],
					'answer' => $faq['answer']
				];
			}
		}

		return $return;
	}

	public static function adminDeleteFaq() {

		if (Customer::adminLoggedIn()) {

			$faq_id = $_POST['faq_id'];

			DB::run('UPDATE faqs SET deleted_at = ? WHERE id = ?', [
				date('Y-m-d H:i:s'), 
				$faq_id
			]);

			exit();
		}
	}
}
