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

	public function allPms() {

		$listofPms = $this->pms->toArray();

		foreach ($this->childs as $value) {
			foreach ($value->pms->toArray() as $pm) {
				array_push($listofPms, $pm);
			}
		}

		return $listofPms;
	}
}