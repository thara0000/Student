<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Student extends Model
{
    use HasFactory;
    protected $table = "students";
    //id, name, image, age, status, created_at, updated_at
    protected $fillable = ['name', 'image', 'age', 'status'];

    protected function Imagename(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('uploads/'.$value),
        );
    }
}
