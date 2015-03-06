<?php
/*
 * THIS SCRIPT IS USED TO CREATE A YELL TABLE FOR PROVINCIAS. 
 */
global $CONFIG;

$query = "CREATE TABLE IF NOT EXISTS `provincias` (
 `id` INT(11) NOT NULL AUTO_INCREMENT,
 `provincia` VARCHAR(50) NOT NULL,
 PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;
";

/**
 * Data to create
 */
$data_to_load = array(
	'1' => 'Buenos Aires',
	'2' => 'Catamarca',
	'3' => 'Córdoba',
	'4' => 'Ciudad de Bs As',
	'5' => 'Chaco',
	'6' => 'Chubut',
	'7' => 'Corrientes',
	'8' => 'Entre Ríos',
	'9' => 'Formosa',
	'10' => 'Jujuy',
	'11' => 'La Pampa',
	'12' => 'La Rioja',
	'13' => 'Misiones',
	'14' => 'Mendoza',
	'15' =>	'Neuquén',
	'16' =>	'Río Negro',
	'17' =>	'Salta',
	'18' => 'Santa Cruz',
	'19' => 'Santiago del Estero',
	'20' => 'Santa Fé',
	'21' => 'San Juan',
	'22' => 'San Luis',
	'23' => 'Tierra del Fuego',
	'24' => 'Tucumán',
);


$qs = array();

$qs[] = $query;

foreach($data_to_load as $id => $provincia) {
	$qs[] = "INSERT INTO `provincias` (`id`, `provincia`) VALUES ('{$id}', '{$provincia}'); ";
}

foreach ($qs as $q) {
	if (!update_data($q)) {
		throw new Exception('Couldn\'t execute the provincias database generation to: ' . $q);
	}
}