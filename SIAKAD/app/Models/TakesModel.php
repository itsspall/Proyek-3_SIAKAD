<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TakesModel extends Model
{
    protected $table = 'takes';
    protected $primaryKey = null;
    public $incrementing = false; 
    public $timestamps = true; 

    protected $fillable = [
        'student_id',
        'course_id',
        'enroll_date',
        'grade',
        'status',
        'attendance',
    ];

    protected $casts = [
        'enroll_date' => 'date',
        'attendance' => 'decimal:2',
    ];

    public static $allowedStatus = ['ongoing', 'completed', 'dropped'];

    public function setStatusAttribute($value)
    {
        if (!in_array($value, self::$allowedStatus)) {
            throw new \InvalidArgumentException("Invalid status value: $value");
        }
        $this->attributes['status'] = $value;
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentsModel::class, 'student_id', 'student_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(CoursesModel::class, 'course_id', 'course_id');
    }
}
