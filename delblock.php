<?php

chdir(dirname(__FILE__));
require_once('config.php');
require_once('func.php');

dolog('starting to del a block');

//variables
// auth_area (master block) - required
// net_block (for ident) - required
$data = array(
	'user'			=>	'',
	'password'		=>	'',
	'auth_area'		=>	'',
	'net_block'		=>	'',
);
$data = array_merge($data,$config['defaults'],$_REQUEST);

//validate
try {
	//verify input
	if(empty($data['user'])) throw new Exception('user required');
	if(empty($data['password'])) throw new Exception('password required');
	if(empty($data['auth_area'])) throw new Exception('auth area required');
	if(empty($data['net_block'])) throw new Exception('net block required');
	//auth
	if(!isset($config['user'][$data['user']])) throw new Exception('user doesnt exist');
	if($data['password'] != $config['user'][$data['user']]) throw new Exception('password invalid');
} catch(Exception $e){
	dolog('ERROR: '.$e->getMessage());
	exit;
}

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
