<?php

chdir(dirname(__FILE__));
require_once('config.php');
require_once('func.php');

//variables
// auth_area (master block) - required
// net_block (for ident) - required
$data = array(
	'auth_area'		=>	'',
	'net_block'		=>	'',
);
$data = array_merge($data,$config['defaults'],$_REQUEST);

$auth_area = $data['auth_area'];
$auth_area_dashed = str_replace('/','-',$data['auth_area']);
$net_block = $data['net_block'];
$net_block_dashed = str_replace('/','-',$data['net_block']);

//del the org file
$org_file = $config['root'].'/etc/rwhoisd/net-'.$auth_area_dashed.'/data/org/'.$net_block_dashed.'.txt';
unlink($org_file);

//del the network file
$net_file = $config['root'].'/etc/rwhoisd/net-'.$auth_area_dashed.'/data/network/'.$net_block_dashed.'.txt';
unlink($net_file);

//update server
updateServer($auth_area);
