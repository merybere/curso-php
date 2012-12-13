<?php

$arrayData = array( 0=>array('value'=>'Gato', 'id'=>'cat'),
					1=>array('value'=>'Perro', 'id'=>'dog'),
					2=>array('value'=>'Tigre', 'id'=>'tiger'));
$arrayUser = array('Gato');



function selectHelper($arrayData, $arrayUser, $name, $multiple = FALSE)
{	
	$html = '';
	$html .= "<select ";
	if($multiple == TRUE)
		$html .= "multiple ";
	$html .= "name=\"" . $name;
	if($multiple == TRUE)
		$html .= "[]";
	$html .= "\">";	
	foreach($arrayData as $data)
	{
		$html .= "<option value=\"" . $data['id'] . "\"";
		if(in_array($data['value'], $arrayUser))
		$html .= " selected";
		$html .= ">" . $data['value'] . "</option>";
	}	
	$html .= "</select>";
	return $html;	
}

function checkHelper($arrayData, $arrayUser, $name, $checkbox=FALSE)
{	
    $html='';
    foreach($arrayData as $data)
    {
		$html .= $data['value']." ";
		$html .= "<input type=\"";
		if($checkbox == TRUE)
			$html .= "checkbox";
		else
			$html .= "radio";
		$html .= "\" name=\"" . $name;
		if($checkbox == TRUE)
			$html .= "[]";
		$html .= "\" value=\"" . $data['id'] . "\"";
		if(in_array($data['value'], $arrayUser))
			$html .= " checked";
		$html .= ">";
    }
    return $html;
}



