<?php

namespace App\Models;

use App\Models\User;
use App\Models\DetalBill;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model {

	protected $table = 'userinfo';

	public function user() {
		return $this->belongsTo(User::class);
		//return $this->belongsTo('App\User');
	}

	public function detailbill() {
		return $this->hasMany(DetalBill::class);
	}

}