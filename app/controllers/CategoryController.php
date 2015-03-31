<?php 

class CategoryController extends BaseController {

	/**
	 * Display all categories
	 */
	public function showAllCategories() 
	{
		$head = Category::where('parent',  '=', 0)->get();

		$list = array();
		foreach ($head as $key => $value) {
			$list[$value->id] = $value->allChilds();
		}

		return View::make('category.show')
			->with('category', $list)
			->with('categories', $head);
	}

	/**
	 * Show the category with id parentID and all childs.
	 */ 
	public function showCategory($token) 
	{
		$head = Category::where('token',  '=', $token)->get();

		// get pm connected to the category
		$pms = $head[0]->allPms();//->where('verified', '=' , 1)->whereNotNull('deleted_at')->where('expiration_date', '<' , 'NOW()');


		$categories[$head[0]->id] = $head[0]->allChilds();


		return View::make('category.show')->with('category', $categories)->with('token', $token)->with('pms', $pms)->with('categories', $head);
	}
}