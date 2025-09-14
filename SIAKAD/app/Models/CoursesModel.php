<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoursesModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'course_name',
        'course_code',
        'credits',
        'semester_offered',
        'description',
        'room',
        'lecturer',
    ];

    public function takes(): HasMany
    {
        return $this->hasMany(TakesModel::class, 'course_id', 'course_id');
    }
}


