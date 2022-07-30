<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable  = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'phone_number',
        'class',
        'gender'
    ];

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function homework()
    {
        return $this->belongsToMany(Homework::class);
    }
}
