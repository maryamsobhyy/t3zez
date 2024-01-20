<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['id','name_ar','name_en','description_ar','description_en'];

    public function courses()
    {
        return $this->belongsToMany(Courses::class,'course_categories','category_id','course_id');
    }
   

}
