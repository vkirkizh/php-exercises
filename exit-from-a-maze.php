<?php

// 1 - wall
// 0 - space
$maze = [
	[1, 0, 1, 1, 1, 1, 1, 1],
	[1, 0, 0, 0, 0, 0, 1, 1],
	[1, 1, 1, 1, 1, 0, 1, 1],
	[1, 0, 1, 0, 0, 0, 1, 1],
	[1, 0, 1, 0, 1, 0, 1, 1],
	[1, 0, 0, 0, 0, 0, 1, 1],
	[1, 0, 1, 1, 1, 0, 0, 1],
	[1, 1, 1, 1, 1, 1, 1, 1],
];
$h = count($maze);
$w = count($maze[0]);

// start position
$y = 5;
$x = 1;

$path = [];

print_maze();
$path = find_exit($y, $x);
print_maze();

function find_exit($y, $x, $path = []) {
	global $maze, $h, $w;
	if ($y < 0 || $y >= $h) return false;
	if ($x < 0 || $x >= $w) return false;
	if ($maze[$y][$x]) return false;
	if (in_array([$y, $x], $path)) return false;
	$path[] = [$y, $x];
	if ($x == 0 || $y == 0) return $path;
	if ($res = find_exit($y - 1, $x, $path)) return $res;
	if ($res = find_exit($y, $x - 1, $path)) return $res;
	if ($res = find_exit($y + 1, $x, $path)) return $res;
	if ($res = find_exit($y, $x + 1, $path)) return $res;
	return false;
}

// # - wall
// @ - start position
// . - the path from the maze
function print_maze() {
	global $maze, $y, $x, $path;
	echo '  ';
	for ($k = 0; $k < count($maze[0]); $k++) {
		echo $k . ' ';
	}
	echo "\n";
	foreach ($maze as $i => $line) {
		echo $i . ' ';
		foreach ($line as $j => $cell) {
			if ($i == $y && $j == $x) {
				echo '@';
			} elseif ($path && in_array([$i, $j], $path)) {
				echo '.';
			} else {
				echo ($cell ? '#' : ' ');
			}
			echo ' ';
		}
		echo "\n";
	}
	echo "\n";
}
