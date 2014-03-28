<?php
/**
 * rewrite.php
 * 
 * $Id$
 */

if(preg_match(
	'/^\/(\d+)_(small|middle|big)\.(jpg|png|gif)/', 
	$_SERVER['REQUEST_URI'], 
	$match) == false) {
	exit;
}

list(,$uid, $size, $ext) = $match;
$uid = sprintf('%010d', $uid);
$uri = sprintf('/%s/%s/%s_%s.%s', 
	substr($uid, 0, 4), 
	substr($uid, 4, 4), 
	substr($uid, -2),
	$size, $ext);

if(file_exists(__DIR__ . $uri) == false) {
	exit;
}



/* End of file rewrite.php */