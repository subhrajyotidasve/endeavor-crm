<?php


class Dates {

	public static function deliveryDate() {

	    $weekday_cutoff_time = DB::run('SELECT * FROM settings WHERE setting_name = ?', ['weekday_cutoff_time'])->fetch();
		$weekday_cutoff_time = $weekday_cutoff_time['setting_value'];
		$saturday_cutoff_time = DB::run('SELECT * FROM settings WHERE setting_name = ?', ['saturday_cutoff_time'])->fetch();
		$saturday_cutoff_time = $saturday_cutoff_time['setting_value'];
		
		$time = date("H:i");
		// echo "<br><br>(Current time: ".$time." | ";

		// if(date('N') > 5) { 
		// 	echo "weekend - cutoff time: " . $saturday_cutoff_time . ")<br><br>";
		// } else {
		// 	echo "weekday - cutoff time: " . $weekday_cutoff_time . ")<br><br>";
		// }

		$today = strtotime("today");
        // $echo_today = date("l jS F", $today);
		// echo "<br><br>(Today is: ".$echo_today." | ";
		$today = date("l", $today);
        $today = strtolower($today);

		$extra_days = 1;

		if (date('H:i') > $weekday_cutoff_time) {
			$extra_days = 2;
			if ($today == "thursday" ) {
				$extra_days = 3;
			}
		}
		
		// echo "Extra days " . $extra_days . "<br><br>";
		
		// echo "Today is " . $today . "<br><br>";

		if ($today == "saturday" ) {
			// echo $today.' is the weekend'."\n";
			$delivery_day = ($today . "+ 2 days");
			// echo "Delivery day is " . $delivery_day . "\n";
		} else if ($today == "friday" ) {
			// echo $today.' is the weekend'."\n";
			$delivery_day = ($today . "+ 3 days");
			// echo "Delivery day is " . $delivery_day . "\n";
		} else {
			// $delivery_day = strtotime(($extra_days + 1)." days", strtotime($today));
			$delivery_day = ($today . "+ {$extra_days} days");
			// $delivery_day = ($today . "+ 1 day");
			// echo "Delivery day is " . date("l jS F", strtotime($delivery_day)) . "\n";
		}

		// return date("l jS F", strtotime($delivery_day));
		return $delivery_day;
	}
}
