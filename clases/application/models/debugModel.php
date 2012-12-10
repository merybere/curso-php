<?php
class Models_debugModel
{
	public static function _debug($data, $label=null)
	{
		echo "<pre>";
		if(isset($label))
			echo $label.": "."\n";
		print_r($data);
		echo "</pre>";
	}
}