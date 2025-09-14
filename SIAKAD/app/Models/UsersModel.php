<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersModel extends Model
{
	/**
	 * Table and primary key configuration
	 */
	protected $table = 'users';
	protected $primaryKey = 'user_id';
	public $incrementing = true;
	protected $keyType = 'int';

	/**
	 * Mass assignable attributes
	 */
	protected $fillable = [
		'username',
		'password',
		'role',
		'full_name',
		'email',
		'phone_number',
		'status',
		'last_login',
	];

	/**
	 * Casts
	 */
	protected $casts = [
		'last_login' => 'datetime',
	];

	/**
	 * Relations
	 */
	public function student(): HasOne
	{
		return $this->hasOne(StudentsModel::class, 'student_id', 'user_id');
	}
}
