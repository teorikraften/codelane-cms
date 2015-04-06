<?php 

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends BaseController {

	/**
	 * Creates $num colors between red and green
	 * @param num, the number of colors
	 * @return the colors as an array of strings (array('000', 'fb0', 'fff'))
	 */
	public function createColors($num) {
		if ($num <= 0) {
			return array();
		}
		// Start value
		$r = 0xb; $g = 4; $b = 0;

		// Calculate the step
		$step = 7 / $num;

		$color = array();
		for ($i = 0; $i < intval($num); $i++) {
			$r -= $step; $g += $step; // Update var
			$color[$i] = dechex(intval($r)) . dechex(intval($g)) . dechex(intval($b)); // The actual color
		}

		return $color;
	}

	/**
	 * Recursive function that creates a breadcrumb text over categories.
	 * @param category, the category where we are now
	 * @return the breadcrumb to the actual category
	 */
	public function createBreadcrumb($category) {
		if ($category->parent == 0) {
			return '<a href="' . URL::route('category-show-all') . '">Start</a> &gt; ' . 
				'<a href="' . URL::route('category-show', $category->token) . '">' . 
					$category->name . 
				'</a> ';
		}

		$parent = Category::where('id', '=', $category->parent)->firstOrFail();
		return $this->createBreadcrumb($parent) . 
			' &gt; <a href="' . URL::route('category-show', $category->token) . '">' . 
				$category->name . 
			'</a> ';
	}

	/**
	 * Display all categories
	 * @param order, the sorting order, alphabetical is default
	 * @param page, the result page, default is 1
	 * @return response, the view with category page
	 */
	public function showAllCategories($order = 'alphabetical', $page = 1) {
		// TODO Funkar det här? Behövs try-catch?
		$page = intval($page);

		// Get first level of categories
		$children = Category::where('parent',  '=', 0)->get();

		// Create background colors
		$colors = $this->createColors($children->count());

		// Init search and find PMs
		$search = new Search('ALL');
		$search->findAllPms();
		$search->sortSearchResult($order);
		$searchResult = $search->getPage($page);

		// Return the view with correct values
		return View::make('category.show')
			->with('color', $colors)
			->with('token', NULL)
			->with('pms', $searchResult)
			->with('children', $children)
			->with('order', $order)
			->with('page', $page);
	}

	/**
	 * Show the category with token $token and all children.
	 * @param token, the token of the category to show
	 * @param order, the sorting order of the pms on the page, alphabetical is default
	 * @param page, the result page, default is 1
	 * @return response, the view with the category page
	 */ 
	public function showCategory($token, $order = 'alphabetical', $page = 1) {
		// TODO try-catch istället?
		$page = intval($page);

		// Find the PM we want
		try {
			$category = Category::where('token',  '=', $token)->firstOrFail();
		} catch (ModelNotFoundException $e) {
			// On fail, redirect user to show-all page with message
			return Redirect::route('category-show-all')->with('message', 'Kategorin du försökte nå finns inte.');
		}

		// Get the children of the category
		$children = Category::where('parent', '=', $category->id)->get();

		// Create background colors
		$colors = $this->createColors($children->count());

		// Init search and get result
		$search = new Search('category');
		$search->categorySearch($category);
		$search->sortSearchResult($order);
		$searchResult = $search->getPage($page);

		return View::make('category.show')
			->with('color', $colors)
			->with('breadcrumb', $this->createBreadcrumb($category))
			->with('token', $token)
			->with('children', $children)
			->with('pms', $searchResult)
			->with('order', $order)
			->with('page', $page);
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