<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', function()
{
	return View::make('index');
}]);

/*
|
| Signed out user related routes like sign in and sign up.
|
*/
Route::get('/logga-in', ['as' => 'sign-in', function()
{
	return View::make('sign-in.sign-in');
}]);

Route::get('/registrera', ['as' => 'sign-up', function()
{
	return View::make('sign-in.sign-up');
}]);

Route::get('/glomt-losenord', ['as' => 'reset-password', function()
{
	return View::make('sign-in.reset-password');
}]);


/*
|
| Signed in user related routes like profile page.
|
*/
Route::get('/person/{id}', ['as' => 'user', function($id)
{
	return View::make('user.profile')->with('user_id', $id);
}])->where('id', '[0-9]+');

Route::get('/person/{id}/andra', ['as' => 'user-edit', function($id)
{
	return View::make('user.edit-profile')->with('user_id', $id);
}])->where('id', '[0-9]+');

Route::get('/person/{id}/favoriter', ['as' => 'user-favourites', function($id)
{
	return View::make('user.favourites')->with('user_id', $id);
}])->where('id', '[0-9]+');


/*
|
| Signed in admin functionality.
|
*/
Route::get('/person/{id}/personer', ['as' => 'admin-persons', function($id)
{
	return View::make('user.admin.persons')->with('user_id', $id);
}])->where('id', '[0-9]+');

Route::get('/person/{id}/pm', ['as' => 'admin-pms', function($id)
{
	return View::make('user.admin.pms')->with('user_id', $id);
}])->where('id', '[0-9]+');

Route::get('/person/{id}/roller', ['as' => 'admin-roles', function($id)
{
	return View::make('user.admin.roles')->with('user_id', $id);
}])->where('id', '[0-9]+');

Route::get('/person/{id}/taggar', ['as' => 'admin-tags', function($id)
{
	return View::make('user.admin.tags')->with('user_id', $id);
}])->where('id', '[0-9]+');


/*
|
| Search functionality.
|
*/
Route::get('/sok', ['as' => 'search-form', function()
{
	return View::make('search.index');
}]);

Route::get('/sok/{searchQuery}/{order?}/{page?}', ['as' => 'search-result', function($searchQuery, $order = '', $page = 1) // TODO
{
	return View::make('search.result')->with('searchQuery', $searchQuery)->with('order', $order)->with('page', $page);
}])->where('page', '[0-9]*');


/*
|
| Functionality directly connected to PM read/write/edit.
|
*/
Route::get('/pm/{token}', ['as' => 'pm-show', function($token)
{
	return View::make('pm.show')->with('token', $token);
}]);

Route::get('/pm/{token}/original', ['as' => 'pm-download', function($token)
{
	return View::make('pm.download')->with('token', $token);
}]);

Route::get('/pm/{token}/andra', ['as' => 'pm-edit', function($token)
{
	return View::make('pm.edit')->with('token', $token);
}]);

Route::get('/pm/{token}/ny-tagg', ['as' => 'pm-add-tag', function($token)
{
	return View::make('pm.add-tag')->with('token', $token);
}]);

Route::get('/pm/{token}/verifiera', ['as' => 'pm-verify', function($token)
{
	return View::make('pm.verify')->with('token', $token);
}]);

Route::get('/pm/nytt', ['as' => 'pm-add', function()
{
	return View::make('pm.add');
}]);


/*
|
| Functionality directly connected to tagging.
|
*/
Route::get('/tagg/{tag}/{page?}', ['as' => 'tag-show', function($tag, $page = 1)
{
	return View::make('tag.show')->with('tag', $tag)->with('page', $page);
}])->where('page', '[0-9]+');


/*
|
| Functionality directly connected to statistics.
|
*/
Route::get('/statistik', ['as' => 'statistics-index', function()
{
	return View::make('statistics.index');
}]);

Route::get('/statistik/historik', ['as' => 'statistics-history', function()
{
	return View::make('statistics.history');
}]);

Route::get('/statistik/pm/{token}', ['as' => 'statistics-pm', function($token)
{
	return View::make('statistics.pm')->with('token', $token);
}]);


/*
|
| Help routes.
|
*/
Route::get('/hjalp', ['as' => 'help-index', function()
{
	return View::make('help.index');
}]);

// TODO Add more help pages


/*
|
| About routes.
|
*/
Route::get('/om', ['as' => 'about-index', function()
{
	return View::make('about.index');
}]);











