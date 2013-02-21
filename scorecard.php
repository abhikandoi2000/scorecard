<?php
	$link = mysql_connect("localhost", "root", "");
	if(!$link) {
		echo "Connection failed";
	} else {
		mysql_select_db("iitr");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>First Year - Provisional Grades</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<div id="content">
			<div class="title">Score Card</div>
			<div class="container">
				<div class="main">
					<div class="search">
						<?php
							if(isset($_POST['enrno'])) {
								$enrno = $_POST['enrno'];
								if($result = mysql_query("SELECT * FROM score WHERE enrno = '{$enrno}'")) {
									if(mysql_num_rows($result) > 0) {
										echo '<span class="subtitle">';
										$userdata = mysql_query("SELECT name, branch FROM score WHERE enrno = '{$enrno}'");
										$namebranch = mysql_fetch_assoc($userdata);
										echo "{$enrno}&nbsp;&nbsp;-&nbsp;&nbsp;{$namebranch['name']}&nbsp;&nbsp;-&nbsp;&nbsp;{$namebranch['branch']}";
										echo '</span>';
										echo "<br/>";
										echo '<table id="score-card">';
										echo "<tr><th>Subject</th><th>Subject Name</th><th>Credit</th><th>Grade</th></tr>";
										$sgpa = 0;
										$credits = 0;
										while($row = mysql_fetch_assoc($result)) {
											$sgpa += $row['credit'] * $row['grade'];
											$credits += $row['credit'];
											echo "<tr>";
											echo "<td>{$row['subjectcode']}</td><td>{$row['subjectname']}</td><td>{$row['credit']}</td><td>{$row['grade']}</td>";
											echo "</tr>";
										}
										$sgpa /= $credits;
										echo "</table>";
										echo "Provisional SGPA: " . $sgpa;
										if($sgpa >= 8.00) {
											echo "&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CHAPOO!";
										}
									} else {
										echo "That ain't your enrollment no...try again.";
									}
								} else {
									echo mysql_error();
								}
							} else {
								echo "You didn't enter your enrollment number, did you?";
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="footer"><p>Coded by <a href="#">Abhishek Kandoi</a> at New Delhi</p></div>
	</body>
</html>
<?php
	mysql_close();
?>