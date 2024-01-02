<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturers extends Model
{
    protected $table = 'lecturers';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = ['id'];

    public function subjects()
    {
        return $this->hasOne(Subjects::class, 'lecturers_id');
    }
}
