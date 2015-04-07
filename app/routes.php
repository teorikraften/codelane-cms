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
Route::get('decode', ['as' => 'decode-test', 'uses' => 'TestController@showDecodePage']);
Route::post('decode', ['as' => 'post-decode-test', 'uses' => 'TestController@decode']);
Route::get('encode', ['as' => 'encode-test', 'uses' => 'TestController@showEncodePage']);
Route::post('encode', ['as' => 'post-encode-test', 'uses' => 'TestController@encode']);

Route::get('/', ['as' => 'index', 'uses' => 'MainController@showIndex']);
Route::get('/test/importera', ['as' => 'test-importera', 'uses' => 'TestController@showImportPage']);
Route::get('/keywords', ['as' => 'search-autocomplete', 'uses' => 'SearchController@searchAutocomplete']);
Route::get('/personer', ['as' => 'persons-autocomplete', 'uses' => 'UserController@personsAutocomplete']);
Route::get('/roller', ['as' => 'roles-autocomplete', 'uses' => 'RoleController@rolesAutocomplete']);
Route::post('/spara-kommentar', ['as' => 'save-comment', 'uses' => 'PMController@saveComment'])
	->before('csrf');
Route::post('/pm-filter', ['as' => 'pm-filter', 'uses' => 'PMController@postFilter'])
	;//->before('csrf');


Route::get('/taggar', ['as' => 'tags-autocomplete', 'uses' => 'TagController@tagsAutocomplete']);
Route::get('/glomt-losenordet', ['as' => 'recover-password', 'uses' => 'RemindersController@getRemind']);
Route::post('/glomt-losenordet', ['as' => 'post-recover-password', 'uses' => 'RemindersController@postRemind']);
Route::get('/aterstall-losenordet/{token}', ['as' => 'reset-password', 'uses' => 'RemindersController@getReset']);
Route::post('/aterstall-losenordet', ['as' => 'post-reset-password', 'uses' => 'RemindersController@postReset']);
Route::get('/skapa-losenord/{token}', ['as' => 'create-password', 'uses' => 'UserController@showCreatePasswordPage']);
Route::post('/skapa-losenord', ['as' => 'post-create-password', 'uses' => 'UserController@createPassword']);


Route::get('/person/uppgifter', ['as' => 'to-do', 'uses' => 'UserController@getTodo']);

/*
|
| Signed out user related routes like sign in and sign up.
|
*/
Route::post('/logga-in', ['as' => 'post-sign-in', 'uses' => 'GuestController@postSignIn'])
	->before('guest');
Route::get('/logga-ut', ['as' => 'sign-out', 'uses' => 'GuestController@getSignOut'])
	->before('auth');
Route::get('/registrera', ['as' => 'sign-up', 'uses' => 'GuestController@getSignUp'])
	->before('guest');
Route::post('/registrera', ['as' => 'post-sign-up', 'uses' => 'GuestController@postSignUp'])
	->before('/guest');


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


/*
|
| Signed in admin functionality.
|
*/
/*
| Admin tags.
*/
Route::get('/admin/taggar', ['as' => 'admin-tags', 'uses' => 'TagController@showTagsListPage'])
	->before('auth.admin');
Route::get('/admin/tagg/{token}', ['as' => 'admin-tag-show', 'uses' => 'TagController@showTagWithToken'])
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

/*
| Admin categories.
*/
Route::get('/admin/kategorier', ['as' => 'admin-categories', 'uses' => 'CategoryController@showCategoriesListPage'])
	->before('auth.admin');
Route::get('/admin/kategorier/ny', ['as' => 'admin-categories-new', 'uses' => 'CategoryController@showAddCategoryPage'])
	->before('auth.admin');
Route::post('/admin/kategorier/ny', ['as' => 'post-admin-categories-new', 'uses' => 'CategoryController@addCategory'])
	->before('auth.admin');
Route::get('/admin/kategorier/ta-bort/{token}', ['as' => 'admin-categories-delete', 'uses' => 'CategoryController@showDeleteCategoryPage'])
	->before('auth.admin');
Route::post('/admin/kategorier/ta-bort', ['as' => 'post-admin-categories-delete', 'uses' => 'CategoryController@deleteCategory'])
	->before('auth.admin');
Route::get('/admin/kategorier/andra/{token}', ['as' => 'admin-categories-edit', 'uses' => 'CategoryController@showEditCategoryPage'])
	->before('auth.admin');
Route::post('/admin/kategorier/andra', ['as' => 'post-admin-categories-edit', 'uses' => 'CategoryController@editCategory'])
	->before('auth.admin');

/*
| Admin roles.
*/
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

/*
| Admin users.
*/
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

/*
| Admin pms.
*/
Route::get('/admin/pm', ['as' => 'admin-pm', 'uses' => 'PMController@showPMListPage'])
	->before('auth.admin');
Route::get('/admin/pm/ta-bort/{token}', ['as' => 'admin-pm-delete', 'uses' => 'PMController@showDeletePMPage'])
	->before('auth.admin');
Route::post('/admin/pm/ta-bort', ['as' => 'post-admin-pms-delete', 'uses' => 'PMController@deletePM'])
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
	->where('page', '[0-9]*')
	->where('order', '(alphabetical)|(score)|(view_count)|(expiration_date)|(revision_date)');


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

Route::get('/pm/{token}/ladda-ner', ['as' => 'pm-download', 'uses' => 'PMController@download'])
	->where('token', '.+');
Route::get('/pm/{token}/andra', ['as' => 'pm-edit', 'uses' => 'PMController@showEditPMPage'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/andra', ['as' => 'post-pm-edit', 'uses' => 'PMController@editPM'])
	->before('auth.verified');

Route::get('/pm/{token}/granska', ['as' => 'pm-review', 'uses' => 'PMController@showReviewPMPage'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/granska', ['as' => 'post-save-review', 'uses' => 'PMController@reviewPM'])
	->before('auth.verified');

Route::get('/pm/{token}/andra-personer', ['as' => 'pm-edit-assignments', 'uses' => 'PMController@showEditPMAssignmentsPage'])
	->where('token', '.+')
	->before('auth.verified');
Route::post('/pm/andra-personer', ['as' => 'post-pm-edit-assignments', 'uses' => 'PMController@editPMAssignments'])
	->before('auth.verified');

Route::get('/pm/{token}/ny-tagg', ['as' => 'pm-add-tag', 'uses' => 'PMController@showAddTagPage'])
	->where('token', '.+')
	->before('auth.verified');
Route::get('/pm/{token}/verifiera', ['as' => 'pm-verify', 'uses' => 'PMController@showVerifyPage'])
	->where('token', '.+')
	->before('auth.verified'); // TODO
Route::get('/pm/{token}', ['as' => 'pm-show', 'uses' => 'PMController@showPMPage'])
	->where('token', '.+');


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
| Category routes.
|
*/
Route::get('/kategori', ['as' => 'category-show-all', 'uses' => 'CategoryController@showAllCategories'])
	->before('auth');
Route::get('/kategori/{token}', ['as' => 'category-show', 'uses' => 'CategoryController@showCategory'])
	->before('auth');
Route::get('/kategori/top/{order?}/{page?}', ['as' => 'category-show-all-sorted', 'uses' => 'CategoryController@showAllCategories'])
	->before('auth')
	->where('order', '(alphabetical)|(score)|(view_count)|(expiration_date)|(revision_date)')
	->where('page', '[0-9]*');
Route::get('/kategori/{token}/{order?}/{page?}', ['as' => 'category-show', 'uses' => 'CategoryController@showCategory'])
	->before('auth')
	->where('order', '(alphabetical)|(score)|(view_count)|(expiration_date)|(revision_date)')
	->where('page', '[0-9]*');

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




