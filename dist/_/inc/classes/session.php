<?php

class Session {

	public static function set($key, $value, $group = null, $end = null) {

		if (isset($key) && isset($value)) {

			if (isset($group)) {

				if (empty($_SESSION[$group])) {

					$_SESSION[$group] = [];
				}

				if (isset($end)) {


					$_SESSION[$group][$key][$end] = $value;
				} else {

					$_SESSION[$group][$key] = $value;
				}
			} else {
			
				$_SESSION[$key] = $value;
			}
		}
	}

	public static function get($key, $group = null) {

		if (isset($group)) {

			if (isset($_SESSION[$group][$key])) {

				return $_SESSION[$group][$key];
			} else {

				return false;
			}
		} else {

			if (isset($_SESSION[$key])) {

				return $_SESSION[$key];
			} else {

				return false;
			}
		}
	}

	public static function delete($key, $group = '') {

		if (isset($group)) {

			if (isset($_SESSION[$group][$key]) && !empty($_SESSION[$group][$key])) {

				unset($_SESSION[$group][$key]);
			}
		} else {

			if (isset($_SESSION[$key]) && !empty($_SESSION[$key])) {

				unset($_SESSION[$key]);
			}
		}
	}

	public static function setFlash($type, $title, $message, $array = []) {

		$_SESSION['flash'] = [
			'type' => $type,
			'title' => $title,
			'message' => $message
		];

		if (!empty($array)) {

			foreach ($array as $item) {

				$_SESSION['flash'][$item] = true;
			}
		}
	}

	public static function getFlash($key) {

		if (isset($_SESSION['flash'][$key])) {

			return $_SESSION['flash'][$key];
		} else {

			return null;
		}
	}

	public static function removeFlash() {

		unset($_SESSION['flash']);
	}
}