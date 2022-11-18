<?php

class Files {

	public static function upload_file($file, $upload_path = false) {

		if (!$upload_path) {

			$upload_path = $_ENV['UPLOAD_PATH'];
		}

		$name = basename(time().$file['name']);

		move_uploaded_file($file['tmp_name'], $upload_path.$name);

		return [
			'path' => $upload_path.$name,
			'name' => $name,
			'local_name' => $_ENV['UPLOAD_LOCAL_PATH'].$name
		];
	}
}