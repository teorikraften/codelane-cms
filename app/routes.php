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
Route::get('/', ['as' => 'index', 'uses' => 'MainController@showIndex']);

/*
|
| Signed out user related routes like sign in and sign up.
|
*/
Route::get('/logga-in', ['as' => 'sign-in', 'uses' => 'GuestController@showSignInPage'])
	->before('guest');
Route::post('/logga-in', ['as' => 'post-sign-in', 'uses' => 'GuestController@signIn'])
	->before('guest');
Route::get('/logga-ut', ['as' => 'sign-out', 'uses' => 'GuestController@showSignOutPage'])
	->before('auth');
Route::get('/registrera', ['as' => 'sign-up', 'uses' => 'GuestController@showSignUpPage'])
	->before('guest');
Route::post('/registrera', ['as' => 'post-sign-up', 'uses' => 'GuestController@signUp'])
	->before('/guest');
Route::get('/glomt-losenord', ['as' => 'reset-password', 'uses' => 'GuestController@showResetPasswordPage'])
	->before('guest');


/*
|
| Signed in user related routes, like profile page.
|
*/
Route::get('/person/{id}', ['as' => 'user', 'uses' => 'UserController@showProfilePage'])
	->before('auth')
	->where('id', '[0-9]+');

Route::get('/person/{id}/andra', ['as' => 'user-edit', 'uses' => 'UserController@showEditProfilePage'])
	->before('auth')
	->where('id', '[0-9]+');

Route::post('/person/{id}/andra', ['as' => 'post-user-edit', 'uses' => 'UserController@editProfile'])
	->before('auth')
	->where('id', '[0-9]+');

Route::post('/person/{id}/andra-losenord', ['as' => 'post-change-password', 'uses' => 'UserController@changePassword'])
	->before('auth')
	->where('id', '[0-9]+');
	
Route::get('/person/{id}/favoriter', ['as' => 'user-favourites', 'uses' => 'UserController@showFavouritesPage'])
	//->before('auth')
	->where('id', '[0-9]+');


/*
|
| Signed in admin functionality.
|
*/
Route::get('/person/{id}/personer', ['as' => 'admin-persons', 'uses' => 'AdminController@showPersonListPage'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::get('/person/{id}/pm', ['as' => 'admin-pms', 'uses' => 'AdminController@showPMListPage'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::get('/person/{id}/roller', ['as' => 'admin-roles', 'uses' => 'AdminController@showRolesListPage'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::get('/person/{id}/taggar', ['as' => 'admin-tags', 'uses' => 'AdminController@showTagsListPage'])
	->before('auth.admin')
	->where('id', '[0-9]+');


/*
|
| Search functionality.
|
*/
Route::get('/sok', ['as' => 'search-form', 'uses' => 'SearchController@showSearchPage']);
Route::get('/sok/{searchQuery}/{order?}/{page?}', ['as' => 'search-result', 'uses' => 'SearchController@showSearchResultPage'])
	->where('page', '[0-9]*');


/*
|
| Functionality directly connected to PM read/write/edit.
| TODO Check permissions
|
*/
Route::get('/pm/nytt', ['as' => 'pm-add', 'uses' => 'PMController@showAddPMPage'])
	->before('auth.verified');
Route::get('/pm/{token}', ['as' => 'pm-show', 'uses' => 'PMController@showPMPage']);
Route::get('/pm/{token}/original', ['as' => 'pm-download', 'uses' => 'PMController@showDownloadPage']);
Route::get('/pm/{token}/andra', ['as' => 'pm-edit', 'uses' => 'PMController@showEditPMPage'])
	->before('auth.verified');
Route::get('/pm/{token}/ny-tagg', ['as' => 'pm-add-tag', 'uses' => 'PMController@showAddTagPage'])
	->before('auth.verified');
Route::get('/pm/{token}/verifiera', ['as' => 'pm-verify', 'uses' => 'PMController@showVerifyPage'])
	->before('auth.verified'); // TODO


/*
|
| Functionality directly connected to tags.
|
*/
Route::get('/tagg/{tag}/{page?}', ['as' => 'tag-show', 'uses' => 'showTagPMListPage'])
	->where('page', '[0-9]+');


/*
|
| Functionality directly connected to statistics.
|
*/
Route::get('/statistik', ['as' => 'statistics-index', 'uses' => 'StatisticsController@showStatisticsIndexPage'])
	->before('auth.admin');
Route::get('/statistik/historik', ['as' => 'statistics-history', 'uses' => 'StatisticsController@showStatisticsHistoryPage'])
	->before('auth.admin');
Route::get('/statistik/pm/{token}', ['as' => 'statistics-pm', 'uses' => 'StatisticsController@showStatisticsPMPage'])
	->before('auth.admin');


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




