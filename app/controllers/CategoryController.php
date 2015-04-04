<?php 

class CategoryController extends BaseController {

	/**
	 * Display all categories
	 */
	public function showAllCategories() 
	{
		$head = Category::where('parent',  '=', 0)->get();

		$list = array();
		$pms = array();
		foreach ($head as $key => $value) {
			$list[$value->id] = $value->allChilds();
			$pms = array_merge($pms, $head[$key]->allPms());
		}

		return View::make('category.show')
			->with('category', $list)
			->with('categories', $head)
			->with('pms', $pms);
	}

	/**
	 * Show the category with id parentID and all children.
	 */ 
	public function showCategory($token) 
	{
		$head = Category::where('token',  '=', $token)->get();

		// get pm connected to the category
		$pms = $head[0]->allPms();//->where('verified', '=' , 1)->whereNotNull('deleted_at')->where('expiration_date', '<' , 'NOW()');


		$categories[$head[0]->id] = $head[0]->allChilds();

		return View::make('category.show')
			->with('category', $categories)
			->with('token', $token)
			->with('pms', $pms)
			->with('categories', $head);
	}

	/**
	 * Displays the categories for admin.	 
	 */
	public function showCategoriesListPage() {
		return View::make('user.admin.categories.index')
			->with('categories', Category::take(100)->get()); // TODO Inte bara 100
	}

	/**
	 * Displays a page to add category for admin.
	 */
	public function showAddCategoryPage() {
		// TODO Move to function
		$parents[0] = 'Ingen förälder';
		$parents += $this->getChildrenList(0, NULL);

		return View::make('user.admin.categories.new')
			->with('parentSelect', $parents);
	}

	/**
	 * Handles a post request of add category.
	 */
	public function addCategory() {
		$name = Input::get('name', '');
		if (!(strlen($name) > 0))
			return Redirect::back()
				->withInput()
				->with('error', 'Du måste ange kategorins namn.');

		if (Category::where('name', '=', $name)->count() > 0)
			return Redirect::route('admin-categories')
				->withInput()
				->with('error', 'Kategorin fanns redan och lades därför inte till.');

		$category = new Category;
		$category->parent = intval(Input::get('parent', '0'));
		$category->name = $name;
		$category->token = $this->generateToken($name); // TODO Move generateToken to separate class
		$category->save();

		return Redirect::route('admin-categories')
			->with('success', 'Kategorin skapades.');
	}

	/**
	 * Displays a page to add category for admin.
	 */
	public function showDeleteCategoryPage($token) {
		try {
			$category = Category::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-categories')
		    	->with('error', 'Kategorin som skulle tas bort hittades inte.');
		}
		
		return View::make('user.admin.categories.delete')->with('category', $category);
	}

	/**
	 * Handles a post request of delete category.
	 */
	public function deleteCategory() {
		// TODO Delete all children upon delete

		// Check which button was pressed, only 'yes' should continue
		if (!Input::get('yes'))
			return Redirect::route('admin-categories')
				->with('warning', 'Kategorin togs inte bort.');

		$token = Input::get('category-token');
		Category::where('token', '=', $token)->delete();

		return Redirect::route('admin-categories')
			->with('success', 'Kategorin togs bort.');
	}

	/**
	 * Displays a page to edit category for admin.
	 */
	public function showEditCategoryPage($token) {
		try {
			$category = Category::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::route('admin-categories')
		    	->with('error', 'Kategorin som skulle ändras hittades inte.');
		}

		// TODO Move to function
		$parents[0] = 'Ingen förälder';
		$parents += $this->getChildrenList(0, $category->id);

		return View::make('user.admin.categories.edit')
			->with('category', $category)
			->with('parentSelect', $parents);
	}

	/**
	 * Handles a post request of edit category.
	 */
	public function editCategory() {
		$token = Input::get('token');
		try {
			$category = Category::where('token', '=', $token)->firstOrFail();
		} catch(ModelNotFoundException $e) {
		    return Redirect::back() // TODO Inte back
		    	->withInput()
		    	->with('error', 'Kategorin som skulle ändras hittades inte.');
		}

		if (!(strlen(Input::get('name', '')) > 0))
			return Redirect::back() // TODO Fix
				->withInput()
				->with('error', 'Du måste ange kategorins namn.');

		$category->name = Input::get('name');
		if (intval(Input::get('parent', '0')) != $category->id)
			$category->parent = intval(Input::get('parent', '0'));
		$category->token = $this->generateToken(Input::get('name')); // TODO Move function to own class
		$category->save();

		return Redirect::route('admin-categories')
			->with('success', 'Kategorin uppdaterades.');
	}

	/**
     * Generates a valid token.
     * @param name the name of the original name
     * @param delimiter the character to replace bad chars with, default is '-'
	 */
	private function generateToken($name, $delimiter = '-') {
		// TODO Move
		setlocale(LC_ALL, 'en_US.UTF8');
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		$n = Tag::where('token', '=', $clean)->count();
		if ($n > 0) {
			$clean = $this->generateToken($clean . '-' . rand(0, 9), $delimiter);
		}

		return $clean;
	}

	private function getChildrenList($parent, $not, $prefix = '___') {
		// TODO Do in mysql rather than many requests
		$children = Category::where('parent', '=', $parent)->get();
		$res = array();
		foreach ($children as $child) {
			if ($child->id != $not) {
				$res[$child->id] = $prefix . $child->name;
				$res += $this->getChildrenList($child->id, $not, '___' . $prefix);
			}
		}
		return $res;
	}
}