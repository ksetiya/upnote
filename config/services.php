<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],
	
	'facebook' => [
		'client_id' => '1596876927212366',
		'client_secret' => '7fd11b8f149cfe1459c1172bfc650922',
		'redirect' => 'http://dev.upnote.io/auth/facebook',
	],
	
	'google' => [
		'client_id' => '380508909270-33ufvdm99io0oi7u1gugujj2pm54nemg.apps.googleusercontent.com',
		'client_secret' => 'lPTZZNiKqsy1RkAvLArDRC51',
		'redirect' => 'http://dev.upnote.io/auth/google',
	],

];
