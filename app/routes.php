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
Route::get('/test/importera', ['as' => 'test-importera', 'uses' => 'TestController@showImportPage']);
Route::get('/keywords/', ['as' => 'search-autocomplete', 'uses' => 'SearchController@searchAutocomplete']);
Route::get('/personer/', ['as' => 'persons-autocomplete', 'uses' => 'UserController@personsAutocomplete']);

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
Route::get('/person', ['as' => 'user', 'uses' => 'UserController@showProfilePage'])
	->before('auth');

Route::get('/person/andra', ['as' => 'user-edit', 'uses' => 'UserController@showEditProfilePage'])
	->before('auth');

Route::post('/person/andra', ['as' => 'post-user-edit', 'uses' => 'UserController@editProfile'])
	->before('auth');

Route::post('/person/andra-losenord', ['as' => 'post-change-password', 'uses' => 'UserController@changePassword'])
	->before('auth');
	
Route::get('/person/{id}/favoriter', ['as' => 'user-favourites', 'uses' => 'UserController@showFavouritesPage'])
	->before('auth');


/*
|
| Signed in admin functionality.
|
*/
Route::get('/person/personer', ['as' => 'admin-persons', 'uses' => 'AdminController@showPersonListPage'])
	->before('auth.admin');
Route::get('/person/pm', ['as' => 'admin-pms', 'uses' => 'AdminController@showPMListPage'])
	->before('auth.admin');
Route::get('/person/roller', ['as' => 'admin-roles', 'uses' => 'AdminController@showRolesListPage'])
	->before('auth.admin');


Route::get('/admin/taggar', ['as' => 'admin-tags', 'uses' => 'TagController@showTagsListPage'])
	->before('auth.admin');
Route::get('/admin/taggar/ny', ['as' => 'admin-tags-new', 'uses' => 'TagController@showAddTagPage'])
	->before('auth.admin');
Route::post('/admin/taggar/ny', ['as' => 'post-admin-tags-new', 'uses' => 'TagController@addTag'])
	->before('auth.admin');
Route::get('/admin/taggar/ta-bort/{token}', ['as' => 'admin-tags-delete', 'uses' => 'TagController@showDeleteTagPage'])
	->before('auth.admin');
Route::post('/admin/taggar/ta-bort', ['as' => 'post-admin-tags-delete', 'uses' => 'TagController@deleteTag'])
	->before('auth.admin');
Route::get('/admin/taggar/andra/{token}', ['as' => 'admin-tags-edit', 'uses' => 'TagController@showEditTagPage'])
	->before('auth.admin');
Route::post('/admin/taggar/andra', ['as' => 'post-admin-tags-edit', 'uses' => 'TagController@editTag'])
	->before('auth.admin');


Route::get('/admin/roller', ['as' => 'admin-roles', 'uses' => 'RoleController@showRolesListPage'])
	->before('auth.admin');
Route::get('/admin/roller/ny', ['as' => 'admin-roles-new', 'uses' => 'RoleController@showAddRolePage'])
	->before('auth.admin');
Route::post('/admin/roller/ny', ['as' => 'post-admin-roles-new', 'uses' => 'RoleController@addRole'])
	->before('auth.admin');
Route::get('/admin/roller/ta-bort/{id}', ['as' => 'admin-roles-delete', 'uses' => 'RoleController@showDeleteRolePage'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::post('/admin/roller/ta-bort', ['as' => 'post-admin-roles-delete', 'uses' => 'RoleController@deleteRole'])
	->before('auth.admin');
Route::get('/admin/roller/andra/{id}', ['as' => 'admin-roles-edit', 'uses' => 'RoleController@showEditRolePage'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::post('/admin/roller/andra', ['as' => 'post-admin-roles-edit', 'uses' => 'RoleController@editRole'])
	->before('auth.admin');


Route::get('/admin/personer', ['as' => 'admin-users', 'uses' => 'UserAdminController@showUsersListPage'])
	->before('auth.admin');
Route::get('/admin/personer/ny', ['as' => 'admin-users-new', 'uses' => 'UserAdminController@showAddUserPage'])
	->before('auth.admin');
Route::post('/admin/personer/ny', ['as' => 'post-admin-users-new', 'uses' => 'UserAdminController@addUser'])
	->before('auth.admin');
Route::get('/admin/personer/ta-bort/{id}', ['as' => 'admin-users-delete', 'uses' => 'UserAdminController@showDeleteUserPage'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::post('/admin/personer/ta-bort', ['as' => 'post-admin-users-delete', 'uses' => 'UserAdminController@deleteUser'])
	->before('auth.admin');
Route::get('/admin/personer/andra/{id}', ['as' => 'admin-users-edit', 'uses' => 'UserAdminController@showEditUserPage'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::get('/admin/personer/verifiera/{id}', ['as' => 'admin-users-verify', 'uses' => 'UserAdminController@showVerifyUserPage'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::post('/admin/personer/verifiera', ['as' => 'post-admin-users-verify', 'uses' => 'UserAdminController@verifyUser'])
	->before('auth.admin');
Route::post('/admin/personer/andra', ['as' => 'post-admin-users-edit', 'uses' => 'UserAdminController@editUser'])
	->before('auth.admin');


Route::get('/admin/pm', ['as' => 'admin-pm', 'uses' => 'PMController@showPMListPage'])
	->before('auth.admin');
Route::get('/admin/pm/ta-bort', ['as' => 'admin-pm-delete', 'uses' => 'PMController@showDeletePMPage'])
	->before('auth.admin');
Route::get('/admin/pm/tilldela', ['as' => 'pm-add-assign', 'uses' => 'PMController@showAssignPMPage'])
	->before('auth.verified');
Route::post('/admin/pm/tilldela', ['as' => 'post-pm-add-assign', 'uses' => 'PMController@assignPM'])
	->before('auth.verified');


/*
|
| Search functionality.
|
*/
Route::get('/sok', ['as' => 'search-form', function() {
	return Redirect::route('search-result', 'Easter Eggs');
}]);
Route::post('/sok', ['as' => 'post-search', 'uses' => 'SearchController@search']);
Route::get('/sok/{searchQuery}/{order?}/{page?}', ['as' => 'search-result', 'uses' => 'SearchController@showSearchResultPage'])
	->where('page', '[0-9]*');


/*
|
| Functionality directly connected to PM read/write/edit.
| TODO Check permissions
|
*/
Route::get('/pm', ['as' => 'pm', function() {
	return Redirect::route('pm-add');
}]);
Route::get('/pm/nytt', ['as' => 'pm-add', 'uses' => 'PMController@showAddPMPage'])
	->before('auth.verified');

Route::get('/admin/importera', ['as' => 'pm-import', 'uses' => 'PMController@showImportPage'])
	->before('auth.verified');

Route::post('/admin/importera', ['as' => 'post-pm-import', 'uses' => 'PMController@import'])
	->before('auth.verified');

Route::any('/admin/importera/verifiera', ['as' => 'pm-import-verify', 'uses' => 'PMController@importVerify'])
	->before('auth.verified');

Route::get('/pm/{token}', ['as' => 'pm-show', 'uses' => 'PMController@showPMPage'])
	->where('token', '.+');
Route::get('/pm/{token}/original', ['as' => 'pm-download', 'uses' => 'PMController@showDownloadPage'])
	->where('token', '.+');
Route::get('/pm/{token}/andra', ['as' => 'pm-edit', 'uses' => 'PMController@showEditPMPage'])
	->where('token', '.+')
	->before('auth.verified');
Route::get('/pm/{token}/ny-tagg', ['as' => 'pm-add-tag', 'uses' => 'PMController@showAddTagPage'])
	->where('token', '.+')
	->before('auth.verified');
Route::get('/pm/{token}/verifiera', ['as' => 'pm-verify', 'uses' => 'PMController@showVerifyPage'])
	->where('token', '.+')
	->before('auth.verified'); // TODO


/*
|
| Functionality directly connected to tags.
|
*/
Route::get('/tagg/{tag}/{page?}', ['as' => 'tag-show', 'uses' => 'TagController@showTagPMListPage'])
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




