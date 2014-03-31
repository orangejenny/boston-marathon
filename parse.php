<?php

$files = array();
//array_push($files, "m1");
for ($i = 1; $i <= 19; $i++) {
	array_push($files, "f" . $i);
}
for ($i = 1; $i <= 28; $i++) {
	array_push($files, "m" . $i);
}

$fh = fopen("results.txt", "w");

foreach ($files as $file) {
	$filename = "boston_results/" . $file . ".html";
	echo "parsing $filename\n";
	$content = file_get_contents($filename);
	$rows = explode("</tr>", $content);
	foreach ($rows as $index => $row) {
		$cells = explode("</td>", $row);
		if (count($cells) == 10) {
			$ranks = parseCell($cells[1]);
			$rank_parts = explode("/", $ranks);
			$rank = trim($rank_parts[2]);
			$name = parseCell($cells[2]);
			$gender = parseCell($cells[3]);
			$age = parseCell($cells[4]);
			$time = parseCell($cells[6]);
			//echo "$rank\t$gender\t$age\t$time\t$name\n";
			fprintf($fh, "%s\t%s\t%s\t%s\t%s\n", $rank, $time, $gender, $age, $name);
		}
	}
}

fclose($fh);

function parseCell($cell) {
	return preg_replace("/<[^>]+>/", "", $cell);
}

?>