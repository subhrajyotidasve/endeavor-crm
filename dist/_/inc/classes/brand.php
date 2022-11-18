<?php

class Brand {
	
	public static function init() {

	}

    public static function get($id) {

        $sql = "SELECT * FROM brands WHERE id = ?";
        $result = DB::run($sql, [$id])->fetch();

        if ($result) {

            return $result;
        } else {

            return false;
        }
    }

}

Country::init();
