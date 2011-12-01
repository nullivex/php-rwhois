<?php

function updateServer($auth_area,&$return){
	$cmd = 'sudo /usr/local/rwhoisd/bin/rwhois_indexer -v -A '.$auth_area.' -C network -s txt -c /usr/local/rwhoisd/etc/rwhoisd/rwhoisd.conf';
	dolog('about to run: '.$cmd);
	exec($cmd,$output);
	$output = implode("\n",$output);
	dolog('updated server with output: '.$output);
	return $output;
}

function dolog($msg){
	global $config;
	$fh = fopen($config['log'],'a+');
	fwrite($fh,date('m/d/Y g:i:s A').' - '.$msg."\n");
	fclose($fh);
	return $msg;
}
