<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBill extends Model
{
    protected $table = 'detail_bill';

	public function bill() {
		return $this->belongsTo('App\Models\Category');
	}

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function product() {
		return $this->belongsTo('App\Models\Product');
	}
}
