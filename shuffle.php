<?php

$lines = file("results.txt");
shuffle($lines);
file_put_contents("shuffled.txt", $lines);

?>
