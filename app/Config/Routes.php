<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->post('auth/register', 'Auth::register');
$routes->group('admin', ['filter' => 'AdminAuth'], function ($routes) {
	$routes->post("badge", 'Badge::create');
	$routes->post('emote', 'Emote::create');
	$routes->post('user', 'User::create');

	$routes->put("badge/(:num)", 'Badge::update/$1');
	$routes->put('emote/(:num)', 'Emote::update/$1');

	$routes->delete("badge/(:num)", 'Badge::delete/$1');
	$routes->delete('emote/(:num)', 'Emote::delete/$1');
});

$routes->group('front', function ($routes) {
	$routes->get('topic', 'Front::getTopic'); // Get info for all topics
	$routes->get('topic/(:num)', 'Front::getTopic/$1'); // Get info for one topic
});

$routes->options('auth', 'Auth::options');
$routes->post('auth', 'Auth::login');

$routes->resource('badge', ["only" => ["index", "show"]]);

$routes->resource('user', ["only" => ['index', "list", "show"], 'placeholder' => '(:segment)']);
$routes->put('user/(:num)', 'User::update/$1', ['filter' => 'UserAuth']);
$routes->delete('user/(:num)', 'User::delete/$1', ['filter' => 'UserAuth']);
$routes->get('user/(:num)/badges', 'User::getUserBadges/$1');

$routes->resource('topic', ["only" => ["index", "list", "show", 'create'], 'placeholder' => '(:num)']);
$routes->put('topic/(:num)', 'Topic::update/$1', ['filter' => 'TopicAuth']);
$routes->delete('topic/(:num)', 'Topic::delete/$1', ['filter' => 'TopicAuth']);
$routes->get('topic/(:num)/messages', 'Topic::getMessages/$1');

$routes->resource('topicTag', ['except' => ['delete'], 'placeholder' => '(:num)']);
$routes->post('topic/(:num)/tag/(:num)', 'TopicTag::create/$1/$1', ['filter' => 'TopicTagAuth']);
$routes->get('topic/(:num)/tag', 'TopicTag::getTagsFromTopic/$1');
$routes->delete('topic/(:num)/tag/(:num)', 'TopicTag::delete/$1/$2', ['filter' => 'TopicTagAuth']);

$routes->resource('message', ["only" => ["index", "list", "show", "create"], 'placeholder' => '(:num)']);
$routes->put('message/(:num)', 'Message::update/$1', ['filter' => 'MessageAuth']);
$routes->post('message/(:num)/react/(:num)', 'Message::addReaction/$1/$2');
$routes->get('message/(:num)/reactions', 'Message::getReactions/$1');
$routes->delete('message/(:num)', 'Message::delete/$1', ['filter' => 'MessageAuth']);

$routes->resource('emote', ["only" => ['index', 'list', 'show']]);
$routes->resource('tag', ["except" => ['delete', 'update'], 'placeholder' => '(:num)']);

$routes->resource('reaction', ["except" => ['update', 'edit', 'delete']]);
$routes->delete('reaction/(:num)', 'Reaction::delete/$1', ['filter' => 'ReactionAuth']);

$routes->add('helper/route', 'RouteDisplay::getRoutes');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
