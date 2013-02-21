<?php
	$link = mysql_connect("localhost", "root", "");
	if($link) {
		mysql_select_db("iitr");
		//open the file in reading mode
		$file = fopen('EC102.csv', 'r');

		//reading each line of code and storing in database
		$entries = 0;
		while($line = fgets($file)) {
			//extract essential info
			$raw = explode(",", $line);
			$enrno = $raw[0];
			$name = trim($raw[1]);
			$subjectcode = "EC-102";
			$subjectname = "FUNDAMENTALS OF ELECTRONICS";
			$credit = 4;
			$branch = $raw[2];
			if(trim($raw[4]) == "A+") {
				$grade = 10;
			} elseif(trim($raw[4]) == "A") {
				$grade = 9;
			} elseif(trim($raw[4]) == "B+") {
				$grade = 8;
			} elseif(trim($raw[4]) == "B") {
				$grade = 7;
			} elseif(trim($raw[4]) == "C+") {
				$grade = 6;
			} elseif(trim($raw[4]) == "C") {
				$grade = 5;
			} elseif(trim($raw[4]) == "D") {
				$grade = 4;
			} elseif(trim($raw[4]) == "F") {
				$grade = 0;
			}

			//store in database
			$query = "INSERT INTO score VALUES ({$enrno}, '{$name}', '{$subjectcode}', '{$subjectname}', {$credit}, {$grade}, '{$branch}')";
			$result = mysql_query($query, $link);
			if(!$result) {
				echo mysql_error();
			}

			//increment no. of entries
			$entries++;
			//echo $line . "<br/>";
		}
		echo "A total of " . $entries . " entries computed and stored in database.";
	} else {
		echo "Connection failed";
	}
?>