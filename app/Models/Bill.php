<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
	protected $fillable = 'bills';

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function UserInfor() {
		return $this->belongsTo('App\Models\UserInfor');
	}
}
