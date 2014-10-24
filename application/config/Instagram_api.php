<?php

/*
|--------------------------------------------------------------------------
| Instagram
|--------------------------------------------------------------------------
|
| Instagram client details
|
*/

$config['instagram_client_name']	= 'Photostream';
$config['instagram_client_id']		= '89ab40a699b44c759888a5beff2548d6';
$config['instagram_client_secret']	= '007535361aca4d05acf1bbfd7680d0df';
$config['instagram_callback_url']	= 'http://www.photostream.com/instagram';
$config['instagram_website']		= 'http://www.photostream.com/instagram';
$config['instagram_description']	= 'Manage your media';

// There was issues with some servers not being able to retrieve the data through https
// If you have this problem set the following to FALSE 
// See https://github.com/ianckc/CodeIgniter-Instagram-Library/issues/5 for a discussion on this
$config['instagram_ssl_verify']		= TRUE;