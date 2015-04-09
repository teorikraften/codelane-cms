<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * The mass assignable fields for the model.
	 *
	 * @var array(string)
	 */
	protected $fillable = ['name', 'token', 'parent'];

	/**
	 * The deleted_at is protected.
	 *
	 * @var array(string)
	 */
	protected $dates = ['deleted_at'];


	
	/**
	 * Defines relation to PM.
	 *
	 * @return Relation
	 */
	public function pms() {
		return $this->belongsToMany('PM', 'pm_categories', 'category', 'pm');
	}

	/**
	 * Defines relation to children categories.
	 *
	 * @return Relation
	 */
	public function children() {
		return $this->hasMany('Category', 'parent', 'id');
	}

	/**
	 * Defines relation to parent categories.
	 *
	 * @return Relation
	 */
	public function parent() {
		return $this->belongsTo('Category', 'parent');
	}

	/**
	 * Finds all categories that are below this category in the hierarcy.
	 * Wrapper to recChildren
	 *
	 * @return a flat list of all children of the category and its children and so on
	 */
	public function getAllChildren() {
		return $this->recChildren(array());
	}

	/**
	 * Finds all children and glues together with all their children.
	 * 
	 * @param list the list to build on
	 * @return array of children, and their children, added to $list
	 */
	private function recChildren($list) {
		$children = $this->children;

		foreach ($children as $key => $value) {
			$list[] = $value;
			$list = $value->recChildren($list);
		}

		return $list;
	}

	/**
	 * Finds all parents to the current category.
	 * Wrapper to recParents.
	 *
	 * @return all parents in a flat list to the category
	 */
	public function allParents() {
		return array_reverse($this->recParents(array()));
	}

	/**
	 * Finds the parent and adds to list.
	 * 
	 * @param list the list to build on
	 * @return array of parents, and their parnts, added to $list
	 */
	private function recParents($list) {
		$parent = $this->getParent;
		if (!is_null($parent)) {
			array_push($list, $parent);
			$list = $parent->recParents($list);
		}
		return $list;
	}
}