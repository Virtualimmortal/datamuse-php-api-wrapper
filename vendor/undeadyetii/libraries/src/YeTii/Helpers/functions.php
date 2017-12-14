<?php

if (!function_exists('dd')) {
	function dd() {
		$debug = debug_backtrace();

		$file = $debug[0]['file'];
		$line = $debug[0]['line'];
		$vars = func_get_args();
		$i = 0;
		foreach ($vars as $var) {
			print '<pre>'.htmlspecialchars(print_r($var, true)).'</pre>';
			$i++;
			print "<br><div style=\"font-size:10px;\">{$file}:{$line}</div><div style=\"height:1px;background:".($i==count($vars)?'#666':'#ccc').";width:100%;\"><br>";
		}
	}
}