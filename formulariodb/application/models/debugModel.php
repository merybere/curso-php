<?php

/**
 * Print data on screen
 * @param unknown_type $data
 */
function _debug($data, $label = null)
{
	echo "<pre>";
	if (isset($label))
		echo $label . ':\n';
	print_r($data);
	echo "</pre>";
}