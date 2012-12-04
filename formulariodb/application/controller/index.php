<?php

// Switch para tratar las posibles acciones. La acción select y default las agrupamos
switch ($_GET['action'])
{
	case 'index':
		$content = renderView('index/index', $config, array());
		break;

	default:
		break;
}

include '../application/layouts/layout_admin1.php';
