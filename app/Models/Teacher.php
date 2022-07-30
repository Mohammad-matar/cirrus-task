<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable  = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'phone_number',
        'gender'
    ];
    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function homework()
    {
        return $this->belongsToMany(Homework::class);
    }
}
