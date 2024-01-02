<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = ['id'];

    public function subjects()
    {
        return $this->belongsToMany(Subjects::class, 'students_subjects', 'students_id', 'subjects_id');
    }

    public function enrolledSubjects()
    {
        return $this->belongsToMany(Subjects::class, 'students_subjects', 'students_id', 'subjects_id')
            ->with('lecturers');
    }
}
