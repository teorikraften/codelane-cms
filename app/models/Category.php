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

	protected $fillable = array('name', 'token', 'parent');

	protected $dates = ['deleted_at'];

	/**
	 * All pms with the tag.
	 */
	public function pms() 
	{
		return $this->belongsToMany('Pm', 'pm_categories', 'category', 'pm');
	}

	public function childs() 
	{
		return $this->hasMany('Category', 'parent', 'id');
	}

	public function parent() 
	{
		return $this->belongsTo('Category', 'parent');
	}


	/**
	 * @return a flat list of all childs for this category
	 */
	public function getAllChilds() 
	{
		return $this->recChilds(array());
	}

	private function recChilds($list) {
		$children = $this->childs;

		foreach ($children as $key => $value) {
			$list[] = $value;
			$list = $value->recChilds($list);
		}

		return $list;
	}

	/**
	 * @deprecated
	 * TODO JOHAN DET HETER CHILDREN!!!! :D <3
	 */
	public function allChilds() 
	{
		$children = array();
		foreach ($this->childs as $key => $value) {
			$children[$value->id] = $value->allChilds();
		}
		
		$list = array();
		$list[$this->id]['category'] = $this;
		$list[$this->id]['children'] = $children;

		return $list;
	}

	/**
	 * Find all parents to the current category
	 */
	public function allParents() {
		return array_reverse($this->recParents(array()));
	}

	private function recParents($list) {
		$parent = $this->getParent;
		if (!is_null($parent)) {
			array_push($list, $parent);
			$list = $parent->recParents($list);
		}
		return $list;
	}
}