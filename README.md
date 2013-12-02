php-rwhois
==========

PHP rWhois API that syncs with the ARIN rWhois server.

## rWhois Server

This API is not the actual rWhois server just an API to manage it. For the server itself check out the documenation here: http://projects.arin.net/rwhois/

You will need to build/compile the server yourself from sources.

## Installation

* Clone/Fork this repository
* `cp config.dist.php config.php`
* Update defaults in `config.php` and setup a secret code.
* Configure your webserver to point at the root folder of this repository.

In my instance I had the rwhoisd server at `/usr/local/rwhoisd` and my php-rwhois located at `/usr/local/rwhoisd/www`

## API Reference

The API for using this service is pretty simple.

### Add Block

`server/addblock.php?<request>`

The following parameters can be passed to the block request and can be POST or GET.

```php
$data = array(
        'user' => '', //api auth username (required)
        'password' => '', //api auth password (required)
        'company' => '',
        'auth_area' => '', //master ip block (required)
        'net_block' => '', //acutal ip block (required)
        'org_name' => '',
        'city' => '',
        'state' => '',
        'zip' => '',
        'country' => '',
        'phone' => '',
        'tech_contact' => '',
        'admin_contact' => '',
        'hostmaster' => ''
);
```
The array will be merged against the defaults in the `config.php` file.

Check out `addblock.php` for the templates used to setup the rwhois file structure.

### Delete Block

`//server/delblock.php?<request>`

This API request is used to delete a netblock from the server it is definitely a good idea to keep track of what netblocks have been added since there is lacking support for querying the server for information through the API. For that purpose the rwhois protocol should be used and query the server directly.

Pass a request similar to below. POST or GET will work.

```php
$data = array(
        'user' => '', //api auth (required)
        'password' => '', //api auth (required)
        'auth_area' => '', //parent net block
        'net_block' => '', //net block to be deleted
);
```

