<?php

$config['root'] = '/usr/local/rwhoisd';
$config['log'] = '/var/log/rwhois-sync';

$config['defaults']['company'] = 'company-handle';
$config['defaults']['org'] = 'FULL COMPANY NAME';
$config['defaults']['street'] = '123 W 4th St';
$config['defaults']['city'] = 'City';
$config['defaults']['state'] = 'CA';
$config['defaults']['zip'] = '123456';
$config['defaults']['phone'] = '(888) 888-8888';
$config['defaults']['hostmaster'] = 'hostmaster@my-domain.org';
$config['defaults']['tech_contact'] = 'ARIN-HANDLE';
$config['defaults']['admin_contact'] = 'ARIN-HANDLE';

$config['user']['rwhois'] = 'your-secret-here';
