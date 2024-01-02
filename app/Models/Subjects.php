<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = ['id'];

    public function lecturers()
    {
        return $this->belongsTo(Lecturers::class, 'lecturers_id');
    }

    public function students()
    {
        return $this->belongsToMany(Students::class, 'students_subjects', 'subjects_id', 'students_id');
    }
}
