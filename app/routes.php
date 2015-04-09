<?php

/*
|--------------------------------------------------------------------------
| Autocomplete and filter routes
|--------------------------------------------------------------------------
|
| All autocomplete and ajax routes.
|
*/
Route::get('/keywords', ['as' => 'search-autocomplete', 'uses' => 'SearchController@getSearchAutocomplete']);
Route::get('/personer', ['as' => 'persons-autocomplete', 'uses' => 'UserController@getPersonsAutocomplete']);
Route::get('/roller', ['as' => 'roles-autocomplete', 'uses' => 'RoleController@getRolesAutocomplete']);
Route::get('/taggar', ['as' => 'tags-autocomplete', 'uses' => 'TagController@getTagsAutocomplete']);

Route::post('/pm-filter', ['as' => 'pm-filter', 'uses' => 'PMController@postFilter']);//->before('csrf');
Route::post('/user-filter', ['as' => 'user-filter', 'uses' => 'UserAdminController@postFilter']);//->before('csrf');
Route::post('/role-filter', ['as' => 'role-filter', 'uses' => 'RoleController@postFilter']);//->before('csrf');
Route::post('/tag-filter', ['as' => 'tag-filter', 'uses' => 'TagController@postFilter']);//->before('csrf');

Route::post('/spara-kommentar', ['as' => 'save-comment', 'uses' => 'PMController@postSaveComment'])
	->before('csrf');


/*
|--------------------------------------------------------------------------
| Recover, reset and create password routes
|--------------------------------------------------------------------------
|
| All routes connected to logged out, password changes.
|
*/
Route::get('/glomt-losenordet', ['as' => 'recover-password', 'uses' => 'RemindersController@getRemind']);
Route::post('/glomt-losenordet', ['as' => 'post-recover-password', 'uses' => 'RemindersController@postRemind']);

Route::get('/aterstall-losenordet/{token}', ['as' => 'reset-password', 'uses' => 'RemindersController@getReset']);
Route::post('/aterstall-losenordet', ['as' => 'post-reset-password', 'uses' => 'RemindersController@postReset']);
Route::get('/skapa-losenord/{token}', ['as' => 'create-password', 'uses' => 'UserController@getCreatePassword']);
Route::post('/skapa-losenord', ['as' => 'post-create-password', 'uses' => 'UserController@postCreatePassword']);

Route::get('/person/uppgifter', ['as' => 'to-do', 'uses' => 'UserController@getTodo']);


/*
|--------------------------------------------------------------------------
| Signed out routes
|--------------------------------------------------------------------------
|
| Signed out user related routes like sign in and sign up.
|
*/
Route::get('/', ['as' => 'index', 'uses' => 'BaseController@getIndex']);
Route::post('/logga-in', ['as' => 'post-sign-in', 'uses' => 'GuestController@postSignIn'])
	->before('guest');
Route::get('/logga-ut', ['as' => 'sign-out', 'uses' => 'GuestController@getSignOut'])
	->before('auth');
Route::get('/registrera', ['as' => 'sign-up', 'uses' => 'GuestController@getSignUp'])
	->before('guest');
Route::post('/registrera', ['as' => 'post-sign-up', 'uses' => 'GuestController@postSignUp'])
	->before('/guest');


/*
|--------------------------------------------------------------------------
| Signed in routes
|--------------------------------------------------------------------------
|
| Signed in user related routes, like profile page, and edit profile page.
|
*/
Route::get('/person', ['as' => 'user', 'uses' => 'UserController@getProfile'])
	->before('auth');
Route::get('/person/andra', ['as' => 'user-edit', 'uses' => 'UserController@getEditProfile'])
	->before('auth');
Route::post('/person/andra', ['as' => 'post-user-edit', 'uses' => 'UserController@postEditProfile'])
	->before('auth');
Route::post('/person/andra-losenord', ['as' => 'post-change-password', 'uses' => 'UserController@postChangePassword'])
	->before('auth');

/*
| Favorite PM
*/
Route::get('/person/favoriter', ['as' => 'favourites-show', 'uses' => 'PMController@showFavourites'])
	->before('auth.verified');
Route::get('/person/favoriter/andra/{token}/{goto}', ['as' => 'get-favourite-edit', 'uses' => 'PMController@favouritePM'])
	->before('auth.verified');
Route::post('/person/favoriter/andra', ['as' => 'post-favourite-edit', 'uses' => 'PMController@favouritePM'])
	->before('auth.verified');

/*
|--------------------------------------------------------------------------
| Administrator routes.
|--------------------------------------------------------------------------
|
| Signed in admin functionality.
|
| Tags functionality
*/
Route::get('/admin/taggar', ['as' => 'admin-tags', 'uses' => 'TagController@getList'])
	->before('auth.admin');
Route::get('/admin/tagg/{token}', ['as' => 'admin-tag-show', 'uses' => 'TagController@getShow'])
	->before('auth.admin');
Route::get('/admin/taggar/ny', ['as' => 'admin-tags-new', 'uses' => 'TagController@getAdd'])
	->before('auth.admin');
Route::post('/admin/taggar/ny', ['as' => 'post-admin-tags-new', 'uses' => 'TagController@postAdd'])
	->before('auth.admin');
Route::get('/admin/taggar/ta-bort/{token}', ['as' => 'admin-tags-delete', 'uses' => 'TagController@getDelete'])
	->before('auth.admin');
Route::post('/admin/taggar/ta-bort', ['as' => 'post-admin-tags-delete', 'uses' => 'TagController@postDelete'])
	->before('auth.admin');
Route::get('/admin/taggar/andra/{token}', ['as' => 'admin-tags-edit', 'uses' => 'TagController@getEdit'])
	->before('auth.admin');
Route::post('/admin/taggar/andra', ['as' => 'post-admin-tags-edit', 'uses' => 'TagController@postEdit'])
	->before('auth.admin');

/*
| Category functionality
*/
Route::get('/admin/kategorier', ['as' => 'admin-categories', 'uses' => 'CategoryController@getList'])
	->before('auth.admin');
Route::get('/admin/kategorier/ny', ['as' => 'admin-categories-new', 'uses' => 'CategoryController@getAdd'])
	->before('auth.admin');
Route::post('/admin/kategorier/ny', ['as' => 'post-admin-categories-new', 'uses' => 'CategoryController@postAdd'])
	->before('auth.admin');
Route::get('/admin/kategorier/ta-bort/{token}', ['as' => 'admin-categories-delete', 'uses' => 'CategoryController@getDelete'])
	->before('auth.admin');
Route::post('/admin/kategorier/ta-bort', ['as' => 'post-admin-categories-delete', 'uses' => 'CategoryController@postDelete'])
	->before('auth.admin');
Route::get('/admin/kategorier/andra/{token}', ['as' => 'admin-categories-edit', 'uses' => 'CategoryController@getEdit'])
	->before('auth.admin');
Route::post('/admin/kategorier/andra', ['as' => 'post-admin-categories-edit', 'uses' => 'CategoryController@postEdit'])
	->before('auth.admin');

/*
| Roles functionality
*/
Route::get('/admin/roller', ['as' => 'admin-roles', 'uses' => 'RoleController@getList'])
	->before('auth.admin');
Route::get('/admin/roller/ny', ['as' => 'admin-roles-new', 'uses' => 'RoleController@getAdd'])
	->before('auth.admin');
Route::post('/admin/roller/ny', ['as' => 'post-admin-roles-new', 'uses' => 'RoleController@postAdd'])
	->before('auth.admin');
Route::get('/admin/roller/ta-bort/{id}', ['as' => 'admin-roles-delete', 'uses' => 'RoleController@getDelete'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::post('/admin/roller/ta-bort', ['as' => 'post-admin-roles-delete', 'uses' => 'RoleController@postDelete'])
	->before('auth.admin');
Route::get('/admin/roller/andra/{id}', ['as' => 'admin-roles-edit', 'uses' => 'RoleController@getEdit'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::post('/admin/roller/andra', ['as' => 'post-admin-roles-edit', 'uses' => 'RoleController@postEdit'])
	->before('auth.admin');

/*
| User functionality
*/
Route::get('/admin/personer', ['as' => 'admin-users', 'uses' => 'UserAdminController@getList'])
	->before('auth.admin');
Route::get('/admin/personer/ny', ['as' => 'admin-users-new', 'uses' => 'UserAdminController@getAdd'])
	->before('auth.admin');
Route::post('/admin/personer/ny', ['as' => 'post-admin-users-new', 'uses' => 'UserAdminController@postAdd'])
	->before('auth.admin');
Route::get('/admin/personer/ta-bort/{id}', ['as' => 'admin-users-delete', 'uses' => 'UserAdminController@getDelete'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::post('/admin/personer/ta-bort', ['as' => 'post-admin-users-delete', 'uses' => 'UserAdminController@postDelete'])
	->before('auth.admin');
Route::get('/admin/personer/andra/{id}', ['as' => 'admin-users-edit', 'uses' => 'UserAdminController@getEdit'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::get('/admin/personer/verifiera/{id}', ['as' => 'admin-users-verify', 'uses' => 'UserAdminController@getVerify'])
	->before('auth.admin')
	->where('id', '[0-9]+');
Route::post('/admin/personer/verifiera', ['as' => 'post-admin-users-verify', 'uses' => 'UserAdminController@postVerify'])
	->before('auth.admin');
Route::post('/admin/personer/andra', ['as' => 'post-admin-users-edit', 'uses' => 'UserAdminController@postEdit'])
	->before('auth.admin');

/*
| PM functionality
*/
Route::get('/admin/pm', ['as' => 'admin-pm', 'uses' => 'PMController@getList'])
	->before('auth.admin');
Route::get('/admin/pm/ta-bort/{token}', ['as' => 'admin-pm-delete', 'uses' => 'PMController@getDelete'])
	->before('auth.admin');
Route::post('/admin/pm/ta-bort', ['as' => 'post-admin-pms-delete', 'uses' => 'PMController@postDelete'])
	->before('auth.admin');
Route::get('/admin/pm/tilldela', ['as' => 'pm-add-assign', 'uses' => 'PMController@getAssign'])
	->before('auth.verified');
Route::post('/admin/pm/tilldela', ['as' => 'post-pm-add-assign', 'uses' => 'PMController@postAssign'])
	->before('auth.verified');
Route::get('/admin/pm/information/{token}', ['as' => 'pm-info', 'uses' => 'PMController@getInfo'])
	->where('token', '.+');


/*
|--------------------------------------------------------------------------
| Search functionality
|--------------------------------------------------------------------------
|
| Routes connected to search.
|
*/
Route::post('/sok', ['as' => 'post-search', 'uses' => 'SearchController@postSearch']);
Route::get('/sok/{searchQuery}/{order?}/{page?}/{options?}', ['as' => 'search-result', 'uses' => 'SearchController@getResult'])
	->where('page', '[0-9]*')
	->where('order', '(alphabetical)|(score)|(view_count)|(expiration_date)|(revision_date)');

/*
|--------------------------------------------------------------------------
| PM functionality
|--------------------------------------------------------------------------
|
| Functionality directly connected to PM read/write/edit.
|
*/
Route::get('/pm/nytt', ['as' => 'pm-add', 'uses' => 'PMController@getAdd'])
	->before('auth.verified');
Route::get('/pm/{token}/ladda-ner', ['as' => 'pm-download', 'uses' => 'PMController@getDownload'])
	->where('token', '.+');

Route::get('/pm/{token}/andra', ['as' => 'pm-edit', 'uses' => 'PMController@getEdit'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/andra', ['as' => 'post-pm-edit', 'uses' => 'PMController@postEdit'])
	->before('auth.verified');

Route::get('/pm/{token}/granska', ['as' => 'pm-review', 'uses' => 'PMController@getReview'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/granska', ['as' => 'post-save-review', 'uses' => 'PMController@postReview'])
	->before('auth.verified');

Route::get('/pm/{token}/slutgranska', ['as' => 'pm-end-review', 'uses' => 'PMController@getEndReview'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/slutgranska', ['as' => 'post-save-end-review', 'uses' => 'PMController@postEndReview'])
	->before('auth.verified');

Route::get('/pm/{token}/faststall', ['as' => 'pm-settle', 'uses' => 'PMController@getSettle'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/faststall', ['as' => 'post-settle', 'uses' => 'PMController@postSettle'])
	->before('auth.verified');

Route::get('/pm/{token}/andra-personer', ['as' => 'pm-edit-assignments', 'uses' => 'PMController@getEditAssignments'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/andra-personer', ['as' => 'post-pm-edit-assignments', 'uses' => 'PMController@postEditAssignments'])
	->before('auth.verified');

Route::get('/pm/{token}/revidera', ['as' => 'pm-revise', 'uses' => 'PMController@getRevise'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/revidera', ['as' => 'post-revise', 'uses' => 'PMController@postRevise'])
	->before('auth.verified');

Route::get('/pm/{token}/ny-tagg', ['as' => 'pm-add-tag', 'uses' => 'PMController@getAddTag'])
	->where('token', '.+')
	->before('auth.verified');
Route::get('/pm/{token}/verifiera', ['as' => 'pm-verify', 'uses' => 'PMController@getVerify'])
	->where('token', '.+')
	->before('auth.verified'); // TODO
Route::get('/pm/{token}', ['as' => 'pm-show', 'uses' => 'PMController@getShow'])
	->where('token', '.+');

Route::get('/pm/senaste', ['as' => 'latest-show', 'uses' => 'SearchController@getLatest'])
	->before('auth.verified');
/*
|--------------------------------------------------------------------------
| Tag functionality
|--------------------------------------------------------------------------
|
| Functionality directly connected to tags.
|
*/
Route::get('/tagg/{tag}/{page?}', ['as' => 'tag-show', 'uses' => 'TagController@getPMList'])
	->where('page', '[0-9]+');


/*
|--------------------------------------------------------------------------
| Category functionality
|--------------------------------------------------------------------------
|
| Category routes. TODO
|
*/
Route::get('/kategori', ['as' => 'category-show-all', 'uses' => 'CategoryController@getShowAll'])
	->before('auth');
Route::get('/kategori/top/{order?}/{page?}', ['as' => 'category-show-all-sorted', 'uses' => 'CategoryController@getShow'])
	->before('auth')
	->where('order', '(alphabetical)|(score)|(view_count)|(expiration_date)|(revision_date)')
	->where('page', '[0-9]*');
Route::get('/kategori/{token}/{order?}/{page?}', ['as' => 'category-show', 'uses' => 'CategoryController@getShowCategory'])
	->before('auth')
	->where('order', '(alphabetical)|(score)|(view_count)|(expiration_date)|(revision_date)')
	->where('page', '[0-9]*');

/*
|--------------------------------------------------------------------------
| Help functionality
|--------------------------------------------------------------------------
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
|--------------------------------------------------------------------------
| About functionality
|--------------------------------------------------------------------------
|
| About routes.
|
*/
Route::get('/om', ['as' => 'about-index', function()
{
	return View::make('about.index');
}]);




/*
|--------------------------------------------------------------------------
| Test routes
|--------------------------------------------------------------------------
|
| All test routes.
|
*/
Route::get('decode', ['as' => 'decode-test', 'uses' => 'TestController@showDecodePage']);
Route::post('decode', ['as' => 'post-decode-test', 'uses' => 'TestController@decode']);
Route::get('encode', ['as' => 'encode-test', 'uses' => 'TestController@showEncodePage']);
Route::post('encode', ['as' => 'post-encode-test', 'uses' => 'TestController@encode']);
Route::get('/test/importera', ['as' => 'test-importera', 'uses' => 'TestController@showImportPage']);
Route::get('/admin/importera', ['as' => 'pm-import', 'uses' => 'PMController@getImport'])
	->before('auth.verified');
Route::post('/admin/importera', ['as' => 'post-pm-import', 'uses' => 'PMController@postImport'])
	->before('auth.verified');
Route::any('/admin/importera/verifiera', ['as' => 'pm-import-verify', 'uses' => 'PMController@getImportVerify'])
	->before('auth.verified');

