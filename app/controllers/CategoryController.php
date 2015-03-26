<?php 

class CategoryController extends BaseController {

	/**
	 * Display all categories
	 */
	public function showAllCategories() 
	{
		$head = Category::where('id',  '=', 0)->get();

		return View::make('category.show')->with('pm', $head);
	}

	/**
	 * Show the category with id parentID and all childs.
	 */ 
	public function showCategory($token) 
	{
		$head = Category::where('token',  '=', $token)->get();

		// get pm connected to the category
		$pms = $head[0]->pm->where('verified', '=' , 1)->whereNotNull('deleted_at')->where('expiration_date', '<' , 'NOW()');
		//$pms = $head[0];

		return View::make('category.show')->with('pm', $pms)->with('token', $token);
	}
}