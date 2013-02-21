<?php
	$link = mysql_connect("localhost", "root", "");
	if($link) {
		mysql_select_db("iitr");
		//open the file in reading mode
		$file = fopen('rawdata.txt', 'r');

		//reading each line of code and storing in database
		$entries = 0;
		while($line = fgets($file)) {
			$name="";
			$subjectname="";
			//extract essential info
			$raw = explode(" ", $line);
			$enrno = $raw[0];
			$point = 1;
			//strstr($raw[$point], "-")  return false if needle is not found in the haystack
			//strpos($raw[$point], "-")  return false if needle is not found in the haystack, can also return 0 as position starts from zero
			while(strpos($raw[$point], '-') === false) {
				$name = $name . $raw[$point];
				if(strpos($raw[$point + 1], '-') === false) {
					$name .= " ";
				}
				$point++;
			}

			$subjectcode = $raw[$point];
			$point++;
			//now extracting the subject name
			while(!is_numeric($raw[$point])) {
				$subjectname .= $raw[$point];
				if(!is_numeric($raw[$point + 1])) {
					$subjectname .= " ";
				}
				$point++;
			}
			$credit = $raw[$point];
			$point++;
			if($raw[$point] == "A+") {
				$grade = 10;
			} elseif($raw[$point] == "A") {
				$grade = 9;
			} elseif($raw[$point] == "B+") {
				$grade = 8;
			} elseif($raw[$point] == "B") {
				$grade = 7;
			} elseif($raw[$point] == "C+") {
				$grade = 6;
			} elseif($raw[$point] == "C") {
				$grade = 5;
			} elseif($raw[$point] == "D") {
				$grade = 4;
			}
			$point++;
			$branch = $raw[$point];

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