<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentsModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing = false; 
    protected $keyType = 'int';

    protected $fillable = [
        'student_id',
        'entry_year',
        'major',
        'semester',
        'dob',
        'gender',
        'user_id',
    ];

    protected $casts = [
        'dob' => 'date',
        'entry_year' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UsersModel::class, 'student_id', 'user_id');
    }

    public function takes(): HasMany
    {
        return $this->hasMany(TakesModel::class, 'student_id', 'student_id');
    }
}


