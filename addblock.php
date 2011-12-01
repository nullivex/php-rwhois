<?php

chdir(dirname(__FILE__));
require_once('config.php');
require_once('func.php');

dolog('starting to add a block');

//variables
// auth_area (master block) - required
// net_block (for ident) - required
// org_name (should be the clients username) - required
// street - optional
// city - optional
// state - optiona
// zip - optional
// country - optional
// phone - optional
$data = array(
	'company'		=>	'',
	'auth_area'		=>	'',
	'net_block'		=>	'',
	'org_name'		=>	'',
	'city'			=>	'',
	'state'			=>	'',
	'zip'			=>	'',
	'country'		=>	'',
	'phone'			=>	'',
	'tech_contact'	=>	'',
	'admin_contact'	=>	'',
	'hostmaster'	=>	''
);
$data = array_merge($data,$config['defaults'],$_REQUEST);

//validate
try {
	if(empty($data['auth_area'])) throw new Exception('auth area required');
	if(empty($data['net_block'])) throw new Exception('net block required');
	if(empty($data['org_name'])) throw new Exception('org name required');
} catch(Exception $e){
	dolog('ERROR: '.$e->getMessage());
	exit;
}

//setup for templating
$company = $data['company'];
$auth_area = $data['auth_area'];
$auth_area_dashed = str_replace('/','-',$data['auth_area']);
$net_block = $data['net_block'];
$net_block_dashed = str_replace('/','-',$data['net_block']);
$org_name = $data['org_name'];
$street = $data['street'];
$city = $data['city'];
$state = $data['state'];
$zip = $data['zip'];
$country = $data['country'];
$phone = $data['phone'];
$time = time();
$tech_contact = $data['tech_contact'];
$admin_contact = $data['admin_contact'];
$hostmaster = $data['hostmaster'];

$org = <<<CODE
ID: org-$company-$net_block_dashed
Auth-Area: $auth_area
Org-Name: $org_name
Street-Address: $street
City: $city
State: $state
Postal-Code: $zip
Country-Code: $country
Phone: $phone
Created: $time
Updated: $time
Updated-By: $hostmaster
CODE;

$network = <<<CODE
ID: net-$net_block
Auth-Area: $auth_area
Network-Name: $company-$net_block
IP-Network: $net_block
Organization: $org_name
Tech-Contact: $tech_contact
Admin-Contact: $tech_contact
Created: $time
Updated: $time
Updated-By: $hostmaster
CODE;

//write the org file
$org_file = $config['root'].'/etc/rwhoisd/net-'.$auth_area_dashed.'/data/org/'.$net_block_dashed.'.txt';
dolog('adding new org file ('.$org_file.'): '."\n".$org);
unlink($org_file);
file_put_contents($org_file,$org);

//write the network file
$net_file = $config['root'].'/etc/rwhoisd/net-'.$auth_area_dashed.'/data/network/'.$net_block_dashed.'.txt';
dolog('adding new network file ('.$net_file.'): '."\n".$network);
unlink($net_file);
file_put_contents($net_file,$network);

//update server
updateServer($auth_area);



