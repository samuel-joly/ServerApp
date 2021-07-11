<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'cors' => \Fluent\Cors\Filters\CorsFilter::class,
		'csrf'      => \CodeIgniter\Filters\CSRF::class,
		'toolbar'   => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot'  => \CodeIgniter\Filters\Honeypot::class,
		'JWTAuth'		=> \App\Filters\JWTAuth::class,
		'MessageAuth'	=> \App\Filters\MessageAuth::class,
		'UserAuth'	=> \App\Filters\UserAuth::class,
		'AdminAuth'	=> \App\Filters\AdminAuth::class,
		'TopicAuth'	=> \App\Filters\TopicAuth::class,
		'TopicTagAuth'	=> \App\Filters\TopicTagAuth::class,
	];

	// Always applied before every request
	public $globals = [
		'before' => [
			// 'honeypot'
			// 'csrf',
			'JWTAuth' => ['except' => ['/', 'auth', 'auth/*']],
		],
		'after'  => [
			//' honeypot'
		],
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [];
}
