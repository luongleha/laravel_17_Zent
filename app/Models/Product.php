<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		'name', 'origin_price', 'sale_price', 'content', 'status',
	];

    protected $table = 'products';

	public function category() {
		return $this->belongsTo('App\Models\Category');
	}

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function images() {
		return $this->hasMany('App\Models\Image');
	}
}