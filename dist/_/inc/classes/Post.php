<?php

class Post
{

	public static function init()
	{
	}


	public static function all($post_type)
	{

		return DB::run('SELECT * FROM posts WHERE post_type = ?', [$post_type]);
	}


	public static function get($id)
	{

		return DB::run('SELECT * FROM posts WHERE id = ?', [$id])->fetch();
	}



	public static function adminPostUpdate()
	{

		if (Customer::adminLoggedIn()) {

			$id = $_POST['id'];

			$post = DB::run('SELECT * FROM posts WHERE id = ?', [$id])->rowCount();
			if ($post == 1) {

				$post_title = $_POST['post_title'];
				$post_excerpt = $_POST['post_excerpt'];
				$post_content = $_POST['editor'];
				$post_date = $_POST['post_date'];

				DB::run('UPDATE posts SET post_title = ?, post_excerpt = ?, post_content = ?, post_date = ? WHERE id = ?', [
					$post_title,
					$post_excerpt,
					$post_content,
					$post_date,
					$id
				]);
			}
		}
	}



	public static function adminPostAdd()
	{

		if (Customer::adminLoggedIn()) {

			$post_title = $_POST['post_title'];
			$post_excerpt = $_POST['post_excerpt'];
			$post_content = $_POST['editor'];
			$post_date = $_POST['post_date'];


			$sql = "INSERT INTO posts SET post_title = ?, post_excerpt = ?, post_content = ?, post_date = ?, post_type = ?";
			$insert = DB::run($sql, [
				$post_title,
					$post_excerpt,
					$post_content,
					$post_date,
					'job',
			]);
		}
	}



	public static function adminDeletePost()
	{

		if (Customer::adminLoggedIn()) {

			$post_id = $_POST['post_id'];

			DB::run('DELETE FROM posts WHERE id = ?', [
				$post_id
			]);

			exit();
		}
	}
}
